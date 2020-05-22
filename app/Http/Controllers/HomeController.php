<?php

namespace App\Http\Controllers;

use Agent;
use Exception;
use App\Mail\ContactFormSend;
use Illuminate\Support\Facades\Mail;
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

    public function contact()
    {
        return view('contact');
    }

    public function contact_us(Request $request)
    {
        $request->validate([
            'name'      =>  'required',
            'email'     =>  'required',
            'phone'     =>  'required|digits:10',
            'subject'   =>  'required',
            'message'   =>  'required'
        ]);

        try {
            Mail::to('exaple@gmail.com')->send(new ContactFormSend($request->all()));
            return redirect('contact')->withErrors('SUCCESS !! Your message has been successfully delivered.');
        } catch (Exception $e) {
            return redirect('contact')->withErrors('ERROR !! Something went wrong. Unable to send your message. Please try again later');
        }
    }

}
