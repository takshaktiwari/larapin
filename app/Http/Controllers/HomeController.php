<?php

namespace App\Http\Controllers;

use Agent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
    	$in_offers = \App\Product::where('status', '1')
    							->where('in_offer', '1')
                                ->whereHas('primary_img', function($query){
                                    $query->whereNotNull('primary_img');
                                })
    							->inRandomOrder()
    							->limit(12)
    							->get()->all();
    	$slider = \App\Slider::where('status', '1')->orderBy('set_order', 'ASC')->get()->all();
        return view('home')->with('slider', $slider)->with('in_offers', $in_offers);
    }

}
