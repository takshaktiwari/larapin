<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\SliderResource;
use App\Slider;

class SliderController extends Controller
{
    public function index()
    {
    	$slider = Slider::where('status', '1')
    					->orderBy('set_order', 'ASC')
    					->get()->all();

    	return SliderResource::collection($slider);
    }
}
