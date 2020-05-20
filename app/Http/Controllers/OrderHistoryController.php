<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\Order_history;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{

	public function front_order_cancel(Request $request)
	{
	    $request->validate([
	        'order_id'      =>  'required|numeric',
	        'description'   =>  'required|max:500'
	    ]);

	    $order = Order::where('user_id', Auth::user()->id)
	                    ->where('id', $request->input('order_id'))->first();

	    if ($order) {
	        $order->update(['order_status' => 'cancelled']);

	        Order_history::create([
	            'order_id'		=>	$request->input('order_id'),
        		'user_id'		=>	Auth::user()->id,
        		'order_status'	=>	'cancelled',
        		'payment_status'=>	$order->payment_status,
        		'description'	=>	$request->input('description'),
        		'updated_by'	=>	'user'
	        ]);

	        return redirect()->back()->withErrors('CANCELLED !! Your order is successfully cancelled');
	    }else{	
	        return redirect()->back()->withErrors('ERROR !! This order doesn\'t belongs to you Or there might be some error' );
	    }
	}



    public function store(Request $request)
    {
        $this->authorize('order_status_update');
    	$request->validate([
    		'order_status'	=>	'required',
    		'payment_status'=>	'required',
    		'description'	=>	'nullable|max:500',
    		'order_id'		=>	'required|numeric'
    	]);

    	Order::find($request->input('order_id'))->update([
    		'order_status'	=>	$request->input('order_status'),
    		'payment_status'=>	$request->input('payment_status')
    	]);

    	Order_history::create([
    		'order_id'		=>	$request->input('order_id'),
    		'user_id'		=>	Auth::user()->id,
    		'order_status'	=>	$request->input('order_status'),
    		'payment_status'=>	$request->input('payment_status'),
    		'description'	=>	$request->input('description'),
    		'updated_by'	=>	'admin'
    	]);

    	return redirect()->back()
    					->withErrors('UPDATED !! Order status is successfully updated');
    }
}
