<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\Order;
use App\Order_product;
use App\Order_product_attr;
use App\Shipping_global;
use App\Product;
use App\Product_option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\CouponResource;
use App\Http\Resources\ShippingSlotResource;
use App\Http\Resources\OrdersResource;

class CheckoutController extends Controller
{
    public function coupon_verify(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'coupon_code'	=>	'required',
			    		'subtotal'		=>	'required',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{

    		if(get_setting('coupon') != 'enable'){
    			$msg = 'ERROR !! Invalid Coupon Code.';
    			return response()->json(['data' => ['msg' => $msg]]);
    		}

	        #   check is use already have used (own) thi coupon code
	        $coupon_use = User::where('id', Auth::user()->id)
	                            ->whereHas('coupons', function($query){
	                                $query->where('coupons.id', session('coupon')['id']);
	                            })->first();

	        if ($coupon_use) {
	            $msg = 'ERROR !! You have already used this offer. Please try another valid Coupon Code';
	            return response()->json(['data' => ['msg' => $msg]]);
	        }else{
	        	$coupon = \App\Coupon::where('coupon', trim($request->input('coupon_code')))->first();

	        	if ($coupon) {
	        	    if ($coupon->min_purchase > '0') {

	        	        $subtotals = $request->input('subtotal');

	        	        if ($subtotals >= $coupon->min_purchase) {
	        	        	return new CouponResource($coupon);
	        	        }else{
	        	        	$msg = 'Unable to apply coupon. This coupon requires a minimum purchase of Rs. '.number_format($coupon->min_purchase,2).' to apply ';

	        	        	if ($coupon->percent > '0') {
	        	        		$msg .= 'discount of '.$coupon->percent.'%  on your total cart.';
	        	        	}else{
	        	        		$msg .= 'discount of  Rs. '.$coupon->amount.' on your total cart.';
	        	        	}
	        	        	return response()->json(['data' => ['msg' => $msg]]);
	        	        }
	        	    }else{
	        	    	return new CouponResource($coupon);
	        	    }
	        	    
	        	}else{
	        	    $msg = 'ERROR !! Invalid Coupon Code.';
	        	    return response()->json(['data' => ['msg' => $msg]]);
	        	}
	        }
		}
    }

    public function shipping_slots(Request $request)
    {
    	if(get_setting('shipping_slot') == 'enable'){
    	    $shipping_slots = \App\Shipping_slot::where('time_from', '>', date('H:i:s'))
    	                                    ->orWhere('time_to', '<', date('H:i:s'))
    	                                    ->get()->all();

    	    return ShippingSlotResource::collection($shipping_slots);
    	}else{
    		return response()->json(['data' => ['msg' => 'No shipping slots are required']]);
    	}
    }

    public function shipping_charge(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'product_ids'	=>	'required|json',
			    		'subtotal'		=>	'required',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
	    	$total_shipping_charge = 0;
	    	$product_ids = json_decode($request->input('product_ids'), true);
	    	$total_price = $request->input('subtotal');
	    	
	    	$shipp_type = \App\Shipping_type::firstOrCreate(
						    		['id' 	=> '1'],
						    		['type'	=>	'1']
						    	);

	    	if ($shipp_type->type == '1') {

	    		$upper_limit = Shipping_global::orderBy('min_value', 'DESC')->first();

	    		if ($upper_limit) {

		    		if ($total_price >= $upper_limit->min_value) {
		    			$total_shipping_charge = $upper_limit->charge;
		    		}else{
		    			$nearest_charge = Shipping_global::where('max_value', '>=', $total_price)
														->where('min_value', '<=', $total_price)
														->first();

		    			$total_shipping_charge = $nearest_charge->charge;
		    		}
	    		}
	    	}elseif ($shipp_type->type == '2') {

	    		$pr_shipping_total = \App\Product_detail::whereIn('product_id', $product_ids)
	    								->select('ship_charge')
	    								->get()->sum('ship_charge');

	    		if ($pr_shipping_total < $shipp_type->min_charge) {
	    			$total_shipping_charge = $shipp_type->min_charge;
	    		}

	    		if ($pr_shipping_total > $shipp_type->max_charge){
	    			$total_shipping_charge = $shipp_type->max_charge;
	    		}
	    	}
	    	
	    	return response()->json(['data' => ['shipping_charge' => $total_shipping_charge]]);
    	}
    }

    public function checkout(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'shipping_addr'		=>	'required',
			    		'order_note'		=>	'nullable',
			    		'subtotal_price'	=>	'required|numeric',
			    		'shipping_charge'	=>	'nullable|numeric',
			    		'coupon_id'			=>	'nullable|numeric',
			    		'payment_method' 	=>	'required',
			    		'shipping_slot_id'	=>	'nullable|numeric',
			    		'product_json'			=>	'required|json'
			    	]);

    	$user = Auth::user();

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		if ($request->input('shipping_addr') == 'new') {
    			$request->validate([
    			    'addr_name'         =>  'required|max:200',
    			    'addr_mobile'       =>  'required|digits:10',
    			    'addr_email'        =>  'nullable|email|max:200',
    			    'addr_landmark'     =>  'required|max:255',
    			    'addr_line1'        =>  'required|max:255',
    			    'addr_line2'        =>  'nullable|max:255',
    			    'addr_country_id'   =>  'required|numeric',
    			    'addr_state_id'     =>  'required|numeric',
    			    'addr_district_id'  =>  'required|numeric',
    			    'addr_pincode_id'   =>  'required|numeric',
    			    'addr_location_id'  =>  'required|numeric',
    			]);
    			if ($validation->fails()) {
		    		return $validation->errors();
		    	}else{
		    		$user_address = \App\User_address::create([
						    		    'user_id'       =>  $user->id,
						    		    'name'          =>  $request->input('addr_name'),
						    		    'email'         =>  $request->input('addr_email'),
						    		    'mobile'        =>  $request->input('addr_mobile'),
						    		    'landmark'      =>  $request->input('addr_landmark'),
						    		    'line1'         =>  $request->input('addr_line1'),
						    		    'line2'         =>  $request->input('addr_line2'),
						    		    'location_id'   =>  $request->input('addr_location_id'),
						    		    'pincode_id'    =>  $request->input('addr_pincode_id'),
						    		    'district_id'   =>  $request->input('addr_district_id'),
						    		    'state_id'      =>  $request->input('addr_state_id'),
						    		    'country_id'    =>  $request->input('addr_country_id'),
						    		    'default_addr'  =>  true
						    		]);
		    	}
    		}else{
    			$user_address = User_address::find($request->input('shipping_addr'));
    		}

    		if (!$user_address) {
    		    return response()->json(['data' => ['msg' => 'ERROR !! No shipping address is provided. Please give a valid shipping address for delivery']]);
    		}


    		$subtotal_price 	= $request->input('subtotal_price');
    		$shipping_charge 	= $request->input('shipping_charge');
    		$coupon_id 			= $request->input('coupon_id');
    		$discount_price 	= 0;

    		session(['coupon_id' => $coupon_id]);

    		if(!empty($coupon_id)) {
		        $coupon_use = User::where('id', Auth::user()->id)
		        					->whereHas('coupons', function($query) use ($coupon_id){
		        						$query->where('coupons.id', $coupon_id);
		        					})
                                    ->first();


		        if(!$coupon_use){
		        	$coupon = \App\Coupon::find($coupon_id);
		        	if ($coupon) {
		        		$discount_price = $coupon->amount;
		        		if(empty($discount_price)){
		        		    $discount_price = $subtotal_price * ($coupon->percent / 100);
		        		}
		        		$user->coupons()->attach($coupon_id);
		        	}
		        }else{
		        	$coupon_id = null;
		        }
    		}

    		$country    = \App\Country::find($user_address->country_id);
    		$state      = \App\State::find($user_address->state_id);
    		$district   = \App\District::find($user_address->district_id);
    		$pincode    = \App\Pincode::find($user_address->pincode_id);
    		$location   = \App\Location::find($user_address->location_id);

    		$order = Order::create([
    		    'user_id'           =>  $user->id,
    		    'user_address_id'   =>  $user_address->id,
    		    'subtotal_price'    =>  $subtotal_price,
    		    'discount_price'    =>  $discount_price,
    		    'shipping_charge'   =>  $shipping_charge,
    		    'shipping_slot_id'  =>  $request->input('shipping_slot_id'),
    		    'coupon_id'         =>  $coupon_id,
    		    'order_note'        =>  $request->input('order_note'),
    		    'payment_method'    =>  $request->input('payment_method'),
    		    'payment_status'    =>  false,
    		    'order_status'      =>  'pending',
    		    'addr_name'         =>  $user_address->name,
    		    'addr_email'        =>  $user_address->email,
    		    'addr_mobile'       =>  $user_address->mobile,
    		    'addr_landmark'     =>  $user_address->landmark,
    		    'addr_line1'        =>  $user_address->line1,
    		    'addr_line2'        =>  $user_address->line2,
    		    'addr_country'      =>  $country->country,
    		    'addr_state'        =>  $state->state,
    		    'addr_district'     =>  $district->district,
    		    'addr_pincode'      =>  $pincode->pincode,
    		    'addr_location'     =>  $location->location,
    		    'pincode_id'        =>  $pincode->id,
    		]);


    		$products = json_decode($request->input('product_json'), true);


    		foreach ($products as $product) {
    		    $db_product = Product::find($product['product_id']);
    		    $db_product->decrement('base_stock', $product['quantity']);

    		    $attrs_price = Product_option::where('product_id', $db_product->id)
    		    										->whereIn('id', $product['product_options'])
    		    										->sum('price');

    		    $order_product = Order_product::create([
    		        'order_id'      =>  $order->id,
    		        'product_id'    =>  $db_product->id,
    		        'product_name'  =>  $db_product->product_name,
    		        'image_sm'      =>  $db_product->primary_img->image_sm,
    		        'slug'          =>  $db_product->slug,
    		        'quantity'      =>  $product['quantity'],
    		        'product_price' =>  $db_product->base_price + $attrs_price,
    		        'attr_prices'   =>  $attrs_price,
    		        'product_options'=>  null,
    		    ]);

    		    foreach ($product['product_options'] as $product_option) {
    		    	$product_option = Product_option::find($product_option);
                    if ($product_option) {
                        $product_option->decrement('stock', $product['quantity']);

                        Order_product_attr::create([
                            'order_id'          =>  $order->id,
                            'order_product_id'  =>  $order_product->id,
                            'product_id'        =>  $db_product->id,
                            'attribute_id'      =>  $product_option->attribute_id,
                            'attribute'         =>  $product_option->attribute->attribute,
                            'attr_option_id'    =>  $product_option->attr_option_id,
                            'attr_option'       =>  $product_option->attr_option->attr_option,
                            'attr_price'        =>  $product_option->price,
                        ]);
                    }
    		    }
    		}

    		return new OrdersResource($order);

    	} // validation check block end
    } // function block end


    
}
