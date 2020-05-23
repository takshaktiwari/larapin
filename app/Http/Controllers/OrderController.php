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

    


    public function orders(Request $request)
    {
        $this->authorize('order_access');
        $query = Order::where('id', '>', '0');

        # searching and filter
        if ($request->get('search')) {
            $search = $request->get('search');
            $query->where(function($query) use($search){
                $query->where('id', 'like', '%'.$search.'%');
                $query->orWhere('order_note', 'like', '%'.$search.'%');
                $query->orWhere('addr_name', 'like', '%'.$search.'%');
                $query->orWhere('addr_mobile', 'like', '%'.$search.'%');
                $query->orWhere('addr_email', 'like', '%'.$search.'%');
                $query->orWhere('addr_landmark', 'like', '%'.$search.'%');
                $query->orWhere('addr_line1', 'like', '%'.$search.'%');
                $query->orWhere('addr_line2', 'like', '%'.$search.'%');
                $query->orWhere('addr_country', 'like', '%'.$search.'%');
                $query->orWhere('addr_state', 'like', '%'.$search.'%');
                $query->orWhere('addr_district', 'like', '%'.$search.'%');
                $query->orWhere('addr_location', 'like', '%'.$search.'%');
            });
        }

        if ($request->get('order_status')) {
            $query->where('order_status', $request->get('order_status'));
        }
        if ($request->get('payment_status')) {
            $query->where('payment_status', $request->get('payment_status'));
        }
        if ($request->get('payment_method')) {
            $query->where('payment_method', $request->get('payment_method'));
        }
        if ($request->get('min_amount')) {
            $min_amount = $request->get('min_amount');
            $query->whereRaw("(subtotal_price+shipping_charge-discount_price) >= $min_amount");
        }
        if ($request->get('max_amount')) {
            $max_amount = $request->get('max_amount');
            $query->whereRaw("(subtotal_price+shipping_charge-discount_price) <= $max_amount");
        }
        if ($request->get('min_discount')) {
            $query->where('discount_price', '>=', $request->get('min_discount'));
        }
        if ($request->get('max_discount')) {
            $query->where('discount_price', '<=', $request->get('max_discount'));
        }
        if ($request->get('min_products')) {
            $min_products = $request->get('min_products');
            $query->whereHas('order_products', function($query) use($min_products){
                $query->havingRaw("COUNT(*) >= $min_products");
            });
        }
        if ($request->get('max_products')) {
            $max_products = $request->get('max_products');
            $query->whereHas('order_products', function($query) use($max_products){
                $query->havingRaw("COUNT(*) <= $max_products");
            });
        }
        if ($request->get('pincode')) {
            $query->where('addr_pincode', $request->get('pincode'));
        }


        $orders = $query->orderBy('id', 'DESC')->paginate(25);
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
