<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Cart_attribute;
use App\Product;
use Illuminate\Http\Request;

use App\Traits\ShippingTrait;
use App\Traits\CartTrait;

class CartController extends Controller
{
    use ShippingTrait;
    use CartTrait;

	public function cart(Request $request)
	{
		if (empty(session('cart', array()))) {
			$this->set_session_cart($request);
		}

        $shipping_charge = $this->shipping_charge();
		return view('cart')->with('shipping_charge', $shipping_charge);
	}

    public function store(Request $request)
    {
    	$request->validate([
    		'product_id'	=>	'required|numeric',
    		'quantity'		=>	'required|numeric|min:1'
    	]);

    	$attribute_ids = array();
    	$attr_option_ids = array();
    	if ($request->input('pr_attribute')) {
	    	foreach ($request->input('pr_attribute') as $attribute) {
	    		array_push($attribute_ids, $attribute['attribute_id']);
	    		array_push($attr_option_ids, $attribute['pr_option']['attr_option_id']);
	    	}
    	}

    	$product = Product::with(['product_options' => function($query) use ($attr_option_ids){
					    		$query->whereIn('attr_option_id', $attr_option_ids);
					    		$query->where('stock', '>', '0');
					    		$query->with(['attr_option' => function($query){
					    			$query->with('attribute');
					    		}]);
					    	}])
    						->with('primary_img')
    						->where('status', '1')
    						->where('base_stock', '>=', $request->input('quantity'))
    						->find($request->input('product_id'));

    	if ($product) {
    		$product_price = product_sale_price($product);

    		foreach ($product->product_options as $product_option) {
    			$product_price += (int)$product_option->price;
    		}

	    	$user_id = null;
	    	if (!empty(Auth::user()->id)) {
	    		$user_id = Auth::user()->id;
	    	}

	    	$cart = Cart::create([
			    		'product_id'	=>	$product->id,
			    		'image_sm'	=>	$product->primary_img->image_sm,
			    		'quantity'		=>	$request->input('quantity'),
			    		'product_price'	=>	$product_price,
			    		'user_id'		=>	$user_id,
			    		'user_ip'		=>	$request->ip()
			    	]);

	    	foreach ($product->product_options as $product_option) {
	    		Cart_attribute::create([
	    			'cart_id'		=>	$cart->id,
	    			'attribute_id'	=>	$product_option->attr_option->attribute->id,
	    			'attribute'		=>	$product_option->attr_option->attribute->attribute,
	    			'attr_option_id'=>	$product_option->attr_option->id,
	    			'attr_option'	=>	$product_option->attr_option->attr_option,
	    			'attr_price'	=>	$product_option->price,
	    		]);
	    	}

	    	if ($request->session()->has('cart')) {
	    		$session_cart = session('cart');
	    	}else{
	    		$session_cart = session('cart', array());
	    	}

	    	$session_cart[$cart->id] = Cart::with('product')
    										->with('coupon')
    										->with('cart_attributes')
    										->find($cart->id)
    										->toArray();

	    	session(['cart' => $session_cart]);
	    	$msg = 'SUCCESS !! Product is added to your cart. Please checkout';
    	}else{
    		$msg = 'ERROR !! Product not found or Something went wrong';
    	}

    	return redirect()->back()->withErrors($msg);
    }

    public function update(Request $request)
    {
    	foreach ($request->input('cart_items') as $cart) {
    		Cart::where('id', $cart['cart_id'])
    				->update(['quantity' => $cart['quantity']]);
    	}

    	$this->set_session_cart($request);
		
    	return redirect('cart')->withErrors('UPDATED !! Your cart is updated');
    }

    public function remove($cart_id)
    {
    	Cart::where('id', $cart_id)->delete();
    	Cart_attribute::where('cart_id', $cart_id)->delete();

    	$session_cart = session('cart');
    	unset($session_cart[$cart_id]);
    	session(['cart' => $session_cart]);

    	return redirect()->back()->withErrors('REMOVED !! Product is successfully removed from you cart');
    }

    public function coupon_apply(Request $request)
    {
    	if ($request->input('coupon_code') != '') {

            #   only allow if user is logged in
            if(!Auth::check()){
                return redirect()->back()->withErrors('ERROR !! Please register with us to avail these amazing offers and price.');
            }

            #   check is use already have used (own) thi coupon code
            $coupon_use = User::where('id', Auth::user()->id)
                                ->whereHas('coupons', function($query){
                                    $query->where('coupons.id', session('coupon')['id']);
                                })->first();

            if ($coupon_use) {
                return redirect()->back()->withErrors('ERROR !! You have already used this offer. Please try another valid Coupon Code');
            }

    	    $coupon = \App\Coupon::where('coupon', trim($request->input('coupon_code')))->first();
    	    if ($coupon) {
    	        if ($coupon->min_purchase > '0') {
    	            $query = Cart::where('id', '>', '0')
    	                           ->select(\DB::raw('(quantity * product_price) as subtotal'));

    	            $query->where('user_ip', $request->ip());
    	            if (Auth::check()) {
    	                $query->orWhere('user_id', Auth::user()->id);
    	            }

    	            $subtotals = $query->get()->sum('subtotal');

    	            if ($subtotals >= $coupon->min_purchase) {
    	            	session(['coupon' => $coupon->toArray()]);

    	            	$msg = 'SUCCESS !! Coupon code is applied. You got ';
    	            	if ($coupon->percent > '0') {
    	            		$msg .= 'discount of '.$coupon->percent.'%  on your total cart';
    	            	}else{
    	            		$msg .= 'discount of  Rs. '.$coupon->amount.' on your total cart';
    	            	}
    	            }else{
    	            	$msg = 'Unable to apply coupon. 
    	            			This coupon requires a minimum purchase of Rs. '.
    	            			number_format($coupon->min_purchase,2).
    	            			' to apply ';

    	            	if ($coupon->percent > '0') {
    	            		$msg .= 'discount of '.$coupon->percent.'%  on your total cart.';
    	            	}else{
    	            		$msg .= 'discount of  Rs. '.$coupon->amount.' on your total cart.';
    	            	}
    	            }
    	        }else{
    	        	session(['coupon' => $coupon->toArray()]);
    	        	$msg = 'SUCCESS !! Coupon code is applied. You got ';
    	        	if ($coupon->percent > '0') {
    	        		$msg .= 'discount of '.$coupon->percent.'%  on your total cart.';
    	        	}else{
    	        		$msg .= 'discount of  Rs. '.$coupon->amount.' on your total cart.';
    	        	}
    	        }
    	        
    	    }else{
    	        $msg = 'ERROR !! Invalid Coupon Code.';
    	    }
    	    
    	}else{
    	    $msg = 'ERROR !! Invalid Coupon Code.';
    	}
    	
    	return redirect('cart')->withErrors($msg);
    }

}
