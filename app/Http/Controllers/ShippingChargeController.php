<?php

namespace App\Http\Controllers;

use App\Shipping_type;
use App\Shipping_global;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function index()
    {
    	$shipping_type = Shipping_type::firstOrCreate(
				    		['id' 	=> '1'],
				    		['type'	=>	'1']
				    	);
    	$shipping_global = Shipping_global::orderBy('id', 'DESC')->get()->all();
    	return view('admin/shipping/shipping_charge')
    							->with('shipping_type', $shipping_type)
    							->with('shipping_global', $shipping_global);
    }

    public function shipping_type_update(Request $request)
    {
    	Shipping_type::updateOrCreate(
    		['id' => '1'],
    		['type'	=>	$request->input('shipping_type')]
    	);

    	return redirect()->back()->withErrors('UPDATED !! Shipping type is updated');
    }

    public function shipping_global_update(Request $request)
    {
    	foreach ($request->input('shipping_global') as $segment) {
    		if ($segment['min_value'] != '' || $segment['max_value'] != '' ) {
    			Shipping_global::updateOrCreate(
    				['min_value'	=>	$segment['min_value'],
    				 'max_value'	=>	$segment['max_value']],

    				['title'		=>	$segment['title'],
    				 'charge'		=>	$segment['charge']]
    			);
    		}
    		
    	}

    	return redirect()->back()->withErrors('UPDATED !! Global Shipping charges are updated');
    }

    public function shipping_global_destroy($id)
    {
    	Shipping_global::where('id', $id)->delete();
    	return redirect()->back()->withErrors('DELETED !! Global Shipping charges are updated');
    }
}
