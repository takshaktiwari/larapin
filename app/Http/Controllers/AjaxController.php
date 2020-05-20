<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get_country_states(Request $request)
    {
    	return \App\State::where('country_id', $request->post('country_id'))
    							->get()->all();
    }

    public function get_state_districts(Request $request)
    {
        return \App\District::where('state_id', $request->post('state_id'))
                                ->get()->all();
    }

    public function get_district_pincodes(Request $request)
    {
    	return \App\Pincode::where('district_id', $request->post('district_id'))
    							->get()->all();
    }

    public function get_pincode_locations(Request $request)
    {
        return \App\Location::where('pincode_id', $request->post('pincode_id'))
                                ->get()->all();
    }

    public function product_add_attr_price(Request $request)
    {
        if ($request->input('pr_option_id')) {
            $pr_option = \App\Product_option::find($request->input('pr_option_id'));
            if ($pr_option) {

                return $request->input('base_price') + (int)$pr_option->price;
            }
        }
    }


}
