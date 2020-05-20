<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $this->authorize('coupon_access');
    	$coupons = Coupon::orderBy('id', 'DESC')->paginate(25);
    	return view('admin/coupons/coupons')->with('coupons', $coupons);
    }

    public function create()
    {
        $this->authorize('coupon_create');
    	return view('admin/coupons/coupon_create');
    }

    public function store(Request $request)
    {
        $this->authorize('coupon_create');
    	$request->validate([
    		'coupon'	=>	'required',
    		'percent'	=>	'required_without:amount|max:100',
    		'amount'	=>	'required_without:percent',
    		'min_purchase'	=>	'nullable',
    	]);

    	Coupon::create([
    		'coupon'	=>	$request->post('coupon'),
    		'percent'	=>	$request->post('percent'),
    		'amount'	=>	$request->post('amount'),
    		'min_purchase'	=>	$request->post('min_purchase'),
    		'expires_at'	=>	$request->post('expires_at')
    	]);

    	return redirect('admin/coupons')
    					->withErrors('CREATED !! New Coupon is successfully created');
    }

    public function show($id)
    {
        $this->authorize('coupon_show');
        $coupon = Coupon::find($id);
        return view('admin/coupons/coupon_show')->with('coupon', $coupon);
    }

    public function edit($id)
    {
        $this->authorize('coupon_update');
    	$coupon = Coupon::find($id);
    	return view('admin/coupons/coupon_edit')->with('coupon', $coupon);
    }

    public function update(Request $request)
    {
        $this->authorize('coupon_update');
    	$request->validate([
    		'coupon'	=>	'required',
    		'percent'	=>	'required_without:amount|max:100',
    		'amount'	=>	'required_without:percent',
    		'min_purchase'	=>	'nullable',
    	]);

    	Coupon::find($request->post('coupon_id'))
		    	->update([
		    		'coupon'	=>	strtoupper($request->post('coupon')),
		    		'percent'	=>	$request->post('percent'),
		    		'amount'	=>	$request->post('amount'),
		    		'min_purchase'	=>	$request->post('min_purchase'),
		    		'expires_at'	=>	$request->post('expires_at')
		    	]);

    	return redirect('admin/coupons')->withErrors('UPDATED !! Coupon is successfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('coupon_delete');
    	Coupon::find($id)->delete();
    	return redirect()->back()->withErrors('UPDATED !! Coupon is successfully updated');
    }

}
