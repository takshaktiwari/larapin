<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\OrdersResource;
use App\Http\Resources\OrderDetailResource;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
    	$orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get()->all();
    	return OrdersResource::collection($orders);
    }

    public function order_detail(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'order_id'	=>	'required|numeric',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$order = Order::find($request->input('order_id'));

    		return new OrderDetailResource($order);
    	}
    }
}
