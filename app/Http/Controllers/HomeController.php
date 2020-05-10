<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
    	$slider = \App\Slider::where('status', '1')->orderBy('set_order', 'ASC')->get()->all();
        return view('home')->with('slider', $slider);
    }

}
