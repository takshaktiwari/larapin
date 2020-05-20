<?php

namespace App\Traits;

use Auth;
use App\Wishlist;

trait WishlistTrait {

    public function set_session_wishlist($request) {
        
        if (!empty(Auth::user()->id)) {
            $query = Wishlist::with('product')
                            ->where('user_id', Auth::user()->id);

            $carts = $query->get()->all();

            $session_wishlist = array();
            foreach ($carts as $cart) {
                $session_wishlist[$cart->id] = $cart->toArray();
            }
            session(['wishlist' => $session_wishlist]);
        }
    }

}