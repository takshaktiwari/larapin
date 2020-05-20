<?php

namespace App\Traits;

use Auth;
use App\Cart;
use App\Product;

use App\Traits\ShippingTrait;

trait CartTrait {

    public function set_session_cart($request) {
        
        $query = Cart::with('product')
                        ->with('coupon')
                        ->with('cart_attributes');

        $query->where('user_ip', $request->ip());
        if (Auth::check()) {
            $query->orWhere('user_id', Auth::user()->id);
        }

        $carts = $query->get()->all();

        $session_cart = array();
        foreach ($carts as $cart) {
            $session_cart[$cart->id] = $cart->toArray();
        }
        session(['cart' => $session_cart]);
        		
    }

}