<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{

	public function unsubscribe($email)
	{
		$subscriber = Subscriber::where('email', trim($email))->first();
		if ($subscriber) {
			$subscriber->update(['status' => false]);
		}
		return redirect('/')->withErrors('You have successfully un unsubscribed to us.');
	}

    public function subscribe(Request $request)
    {
    	$request->validate([
    		'email'	=> 'required|email'
    	]);
    	Subscriber::firstOrCreate(['email' => $request->input('email')]);

    	return redirect()->back()->withErrors('SUBSCRIBED !! You are successfully subscribed to us');
    }

}
