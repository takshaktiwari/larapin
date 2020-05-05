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

    public function get_state_locations(Request $request)
    {
    	return \App\Location::where('state_id', $request->post('state_id'))
    							->get()->all();
    }

    public function get_location_pincode(Request $request)
    {
    	return \App\Location::find($request->post('location_id'));
    }

    public function tinymce_image_upload(Request $request)
    {
        echo "<pre>";
        print_r ($request->all());
        echo "</pre>";
    }
}
