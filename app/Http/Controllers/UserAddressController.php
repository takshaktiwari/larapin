<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\User_address;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{

    public function index($user_id='')
    {
    	if (empty($user_id)) {
    		$user_id = Auth::user()->id;
    	}

    	$user = User::find($user_id);
    	$shipping_addrs = User_address::where('user_id', $user_id)
    									->where('shipping_billing', '1')
    									->get()->all();
    	$billing_addrs = User_address::where('user_id', $user_id)
    									->where('shipping_billing', '2')
    									->get()->all();
    	return view('admin/users/addresses')->with('user', $user)
    										->with('shipping_addrs', $shipping_addrs)
    										->with('billing_addrs', $billing_addrs);
    }

    public function create($user_id='')
    {
    	if (empty($user_id)) {
    		$user_id = Auth::user()->id;
    	}

    	$user = User::find($user_id);
    	$countries = \App\Country::orderBy('country', 'ASC')->get()->all();
    	return view('admin/users/address_create')->with('user', $user)
    											->with('countries', $countries);
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'name'			=>	'required|max:150',
    		'email'			=>	'nullable|max:150',
    		'mobile'		=>	'required|digits:10',
    		'landmark'		=>	'nullable|max:255',
    		'line1'			=>	'required|max:255',
    		'line2'			=>	'nullable|max:255',
    		'location_id'	=>	'required|numeric',
    		'pincode'		=>	'required|numeric|digits:6',
    		'state_id'		=>	'required|numeric',
    		'country_id'	=>	'required|numeric',
    	]);
    	
    	$user_id = $request->post('user_id');
    	if (empty($user_id)) {
    		$user_id = Auth::user()->id;
    	}
    	
    	$data = $request->all();
    	$addrs = [];
    	if ($data['shipping_billing'] == '1') {
    		$addrs = ['1'];
    		User_address::where('user_id', $user_id)
    					->where('shipping_billing', '1')
    					->update(['default_addr' => false]);
    	}elseif ($data['shipping_billing'] == '2') {
    		$addrs = ['2'];
    		User_address::where('user_id', $user_id)
    					->where('shipping_billing', '2')
    					->update(['default_addr' => false]);
    	}elseif ($data['shipping_billing'] == '3') {
    		User_address::where('user_id', $user_id)
    					->update(['default_addr' => false]);
    		$addrs = ['1','2'];
    	}

    	foreach ($addrs as $shipping_billing) {
    		User_address::create([
    			'user_id'		=>	$user_id,
    			'name'			=>	$data['name'],
    			'email'			=>	$data['email'],
    			'mobile'		=>	$data['mobile'],
    			'landmark'		=>	$data['landmark'],
    			'line1'			=>	$data['line1'],
    			'line2'			=>	$data['line2'],
    			'location_id'	=>	$data['location_id'],
    			'pincode'		=>	$data['pincode'],
    			'state_id'		=>	$data['state_id'],
    			'country_id'	=>	$data['country_id'],
    			'shipping_billing'	=>	$shipping_billing,
    			'default_addr'		=>	true
    		]);
    	}

    	return redirect()->back()
    				->withErrors('CREATED !! Addresses are successfully created');
    }

    public function primary_addr($addr_id)
    {
    	$address = User_address::find($addr_id);

    	User_address::where('user_id', $address->user_id)
    				->where('shipping_billing', $address->shipping_billing)
    				->update(['default_addr' => false]);

    	$address->update(['default_addr' => true]);
    	return redirect()->back()
    				->withErrors('SUCCESS !! Address is successfully set to default');
    }

    public function destroy($addr_id)
    {
    	$address = User_address::find($addr_id);
    	$address->delete();

    	return redirect()->back()
    				->withErrors('SUCCESS !! Address is successfully set to default');
    }

    public function edit($addr_id)
    {
    	$address = User_address::first();
    	$countries = \App\Country::orderBy('country', 'ASC')->get()->all();

    	$states = \App\State::where('country_id', 'like', $address->country_id)
    						->orderBy('state', 'ASC')->get()->all();

    	$locations = \App\Location::where('state_id', 'like', $address->state_id)
    						->orderBy('location', 'ASC')->get()->all();

    	return view('admin/users/address_edit')->with('address', $address)
    											->with('countries', $countries)
    											->with('states', $states)
    											->with('locations', $locations);
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'name'			=>	'required|max:150',
    		'email'			=>	'nullable|max:150',
    		'mobile'		=>	'required|digits:10',
    		'landmark'		=>	'nullable|max:255',
    		'line1'			=>	'required|max:255',
    		'line2'			=>	'nullable|max:255',
    		'location_id'	=>	'required|numeric',
    		'pincode'		=>	'required|numeric|digits:6',
    		'state_id'		=>	'required|numeric',
    		'country_id'	=>	'required|numeric',
    	]);

    	$data = $request->all();
    	User_address::where('id', $data['address_id'])
			    	->update([
			    		'name'			=>	$data['name'],
			    		'email'			=>	$data['email'],
			    		'mobile'		=>	$data['mobile'],
			    		'landmark'		=>	$data['landmark'],
			    		'line1'			=>	$data['line1'],
			    		'line2'			=>	$data['line2'],
			    		'location_id'	=>	$data['location_id'],
			    		'pincode'		=>	$data['pincode'],
			    		'state_id'		=>	$data['state_id'],
			    		'country_id'	=>	$data['country_id'],
			    		'shipping_billing'	=>	$data['shipping_billing']
			    	]);

		return redirect()->back()
					->withErrors('UPDATED !! Address is successfully updated');
    }
}
