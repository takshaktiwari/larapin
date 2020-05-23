<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\User;
use App\User_address;
use App\Product;
use App\Product_option;
use App\Order;
use App\Order_product;
use App\Order_product_attr;
use App\Shipping_slot;
use Illuminate\Http\Request;

use App\Traits\ShippingTrait;
use App\Traits\CartTrait;

class CheckoutController extends Controller
{
    use ShippingTrait;
    use CartTrait;

    public function checkout(Request $request)
    {
        # still cart is empty after checking DB then go to cart page
    	if (empty(session('cart', array()))) {
    		return redirect('cart');
    	}

        $shipping_charge = $this->shipping_charge();
        $countries = \App\Country::orderBy('country', 'ASC')->get()->all();
        $view = view('checkout')->with('shipping_charge', $shipping_charge)
                                ->with('countries', $countries);

        if(get_setting('shipping_slot') == 'enable'){
            $shipping_slots = Shipping_slot::where('time_from', '>', date('H:i:s'))
                                            ->orWhere('time_to', '<', date('H:i:s'))
                                            ->get()->all();
            $view->with('shipping_slots', $shipping_slots);
        }

        return $view;
    }

    public function checkout_do(Request $request)
    {
        $request->validate([
            'order_note'        =>  'nullable|max:500',
            'payment_method'    =>  'required'
        ]);

        
        if(Auth::check()){
            $user = Auth::user();

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

                $user_address = User_address::create([
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
            }else{
                $user_address = User_address::find($request->input('shipping_addr'));
            }
        }else{
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

            $user = User::where('email', $request->input('addr_email'))
                            ->orWhere('mobile', $request->input('addr_mobile'))
                            ->first();

            if(!$user){
                $user = User::create([
                    'name'  =>  $request->input('addr_name'),
                    'email'  =>  $request->input('addr_email'),
                    'password'  =>  \Hash::make(rand()),
                    'api_token' =>  \Str::random(80)
                ]);

                \App\User_detail::create([
                    'user_id'   =>  $user->id,
                    'mobile'    =>  $request->input('addr_mobile')
                ]);
            }

            User_address::where('user_id', $user->id)->update(['default_addr' => false]);
            $user_address = User_address::create([
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

        #   add to subscriber list
        if (!empty($user->email)) {
            \App\Subscriber::updateOrCreate(
                ['email'    =>  $user->email],
                ['name'     =>  $user->name,
                'mobile'    =>  $user->mobile]
            );
        }
        

        if (!$user_address) {
            return redirect()->back()->withErros('ERROR !! No shipping address is provided. Please give a valid shipping address for delivery');
        }

        $subtotal_price = 0;
        $discount_price = 0;
        $shipping_charge = $this->shipping_charge();
        $coupon_id = null;

        $country    = \App\Country::find($user_address->country_id);
        $state      = \App\State::find($user_address->state_id);
        $district   = \App\District::find($user_address->district_id);
        $pincode    = \App\Pincode::find($user_address->pincode_id);
        $location   = \App\Location::find($user_address->location_id);

        $query = Cart::with('product');
        $query->where('user_ip', $request->ip());
        if (!empty(\Auth::user()->id)) {
            $query->orWhere('user_id', \Auth::user()->id);
        }
        $carts = $query->get()->all();
        $cart_ids = array();
        foreach ($carts as $cart) {
            array_push($cart_ids, $cart->id);
            $subtotal_price += $cart->product_price * $cart->quantity;
        }

        if(!empty(session('coupon', array()))) {
            if(Auth::check()){
                $coupon_use = User::where('id', Auth::user()->id)
                                    ->whereHas('coupons', function($query){
                                        $query->where('coupons.id', session('coupon')['id']);
                                    })->first();

                if(!$coupon_use){
                    $coupon_id = session('coupon')['id'];
                    $discount_price = session('coupon')['amount'];
                    if(empty($discount_price)){
                        $discount_price = $subtotal_price * (session('coupon')['percent'] / 100);
                    }

                    $user->coupons()->attach(session('coupon')['id']);
                }
            }
        }


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


        foreach ($carts as $cart) {
            Product::find($cart->product->id)->decrement('base_stock', $cart->quantity);
            $order_product = Order_product::create([
                'order_id'      =>  $order->id,
                'product_id'    =>  $cart->product->id,
                'product_name'  =>  $cart->product->product_name,
                'image_sm'      =>  $cart->product->primary_img->image_sm,
                'slug'          =>  $cart->product->slug,
                'quantity'      =>  $cart->quantity,
                'product_price' =>  $cart->product_price,
                'attr_prices'   =>  $cart->cart_attributes->sum('attr_price'),
                'product_options'=>  $cart->cart_attributes->toJson(),
            ]);

            foreach ($cart->cart_attributes as $cart_attr) {
                Product_option::where('product_id', $order_product->id)
                                ->where('attr_option_id', $cart_attr->attr_option_id)
                                ->decrement('stock', $cart->quantity);
                Order_product_attr::create([
                    'order_id'          =>  $order->id,
                    'order_product_id'  =>  $order_product->id,
                    'product_id'        =>  $order_product->product_id,
                    'attribute_id'      =>  $cart_attr->attribute_id,
                    'attribute'         =>  $cart_attr->attribute,
                    'attr_option_id'    =>  $cart_attr->attr_option_id,
                    'attr_option'       =>  $cart_attr->attr_option,
                    'attr_price'        =>  $cart_attr->attr_price,
                ]);
            }
        }

        Cart::whereIn('id', $cart_ids)->delete();
        \App\Cart_attribute::whereIn('cart_id', $cart_ids)->delete();

        session(['cart' => array()]);
        session(['coupon' => array()]);

        return redirect('order/confirmation/'.$order->id);
    }


}
