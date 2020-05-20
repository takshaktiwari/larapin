<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function front_orders()
	{
		$orders = Order::where('user_id', Auth::user()->id)
                        ->orderBy('id', 'DESC')->paginate(10);
		return view('user/orders')->with('orders', $orders);
	}
    public function confirmation($order_id)
    {
    	$order = Order::find($order_id);
    	return view('order_confirmation')->with('order', $order);
    }

    public function front_order_detail($id)
    {
    	$order = Order::find($id);
    	return view('user/order_detail')->with('order', $order);
    }

    


    public function orders()
    {
        $this->authorize('order_access');
        $orders = Order::orderBy('id', 'DESC')->paginate(25);
        return view('admin/orders/orders')->with('orders', $orders);
    }

    public function detail($id)
    {
        $this->authorize('order_show');
        $order = Order::find($id);
        return view('admin/orders/order_detail')->with('order', $order);
    }

    public function destroy($id)
    {
        $this->authorize('order_delete');
        Order::where('id', $id)->delete();
        \App\Order_product::where('order_id', $id)->delete();
        \App\Order_product_attr::where('order_id', $id)->delete();

        return redirect()->back()->withErrors('DELETED !! Order is successfully deleted');
    }


}
