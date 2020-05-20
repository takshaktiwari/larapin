<?php

namespace App\Http\Controllers;

use App\Shipping_slot;
use Illuminate\Http\Request;

class ShippingSlotController extends Controller
{
    public function index()
    {
    	$shipping_slots = Shipping_slot::get()->all();
    	return view('admin/shipping/shipping_slots')
    					->with('shipping_slots', $shipping_slots);
    }

    public function create()
    {
    	return view('admin/shipping/shipping_slot_create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'time_from'		=>	'required',
    		'time_to'		=>	'required'
    	]);

    	Shipping_slot::create([
    		'time_from'		=>	$request->input('time_from'),
    		'time_to'		=>	$request->input('time_to'),
    		'time_period'	=>	$request->input('time_period'),
    	]);

    	return redirect('admin/shipping_slots')
    						->withErrors('CREATED !! New shipping slot is created');
    }

    public function edit($id)
    {
    	$slot = Shipping_slot::find($id);
    	return view('admin/shipping/shipping_slot_edit')->with('slot', $slot);
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'time_from'		=>	'required',
    		'time_to'		=>	'required'
    	]);

    	Shipping_slot::find($request->input('slot_id'))
				    	->update([
				    		'time_from'		=>	$request->input('time_from'),
				    		'time_to'		=>	$request->input('time_to'),
				    		'time_period'	=>	$request->input('time_period'),
				    	]);

		return redirect('admin/shipping_slots')
							->withErrors('Updated !! Shipping slot is updated');
    }

    public function destroy($id)
    {
    	Shipping_slot::where('id', $id)->delete();
    	return redirect('admin/shipping_slots')
    						->withErrors('CREATED !! New shipping slot is created');
    }

}
