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
}
