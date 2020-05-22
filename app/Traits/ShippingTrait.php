<?php

namespace App\Traits;

use App\Product_detail;
use App\Shipping_type;
use App\Shipping_global;

trait ShippingTrait {

    public function shipping_charge() {
        
        if (!empty(session('cart', array()))) {

        	$product_ids = array();
        	$total_price = 0;
        	foreach (session('cart', array()) as $cart) {
        		$total_price += $cart['quantity'] * $cart['product_price'];
        		array_push($product_ids, $cart['product_id']);
        	}

        	$shipp_type = Shipping_type::firstOrCreate(
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
        		}else{
        			$total_shipping_charge = 0;
        		}
        	}elseif ($shipp_type->type == '2') {

        		$pr_shipping_total = Product_detail::whereIn('product_id', $product_ids)
        								->select('ship_charge')
        								->get()->sum('ship_charge');

        		if ($pr_shipping_total < $shipp_type->min_charge) {
        			$total_shipping_charge = $shipp_type->min_charge;
        		}

        		if ($pr_shipping_total > $shipp_type->max_charge){
        			$total_shipping_charge = $shipp_type->max_charge;
        		}
        	}
        	
        	return  $total_shipping_charge;
        }else{
        	return false;
        }
    }



}