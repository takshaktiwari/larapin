<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Country;
use App\State;
use App\Location;
use App\User_address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\LocationResource;
use App\Http\Resources\AddressResource;

class AddressConroller extends Controller
{
    public function countries()
    {
    	$countries = Country::orderBy('country', 'ASC')->get()->all();
    	return CountryResource::collection($countries);
    }

    public function country(Request $request)
    {
        $validation = validator($request->all(), [
                        'country_id'    =>  'required|numeric',
                    ]);
        if ($validation->fails()) {
            return $validation->errors();
        }else{
            $country = Country::find($request->input('country_id'));
            if (!empty($country)) {
                return new CountryResource($country);
            }
        }
    }

    public function states(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'country_id'	=>	'required|numeric',
			    	]);
    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$states = State::where('country_id', $request->input('country_id'))
    						->orderBy('state', 'ASC')
    						->get()->all();
    		return StateResource::collection($states);
    	}
    }

    public function state(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'state_id'	=>	'required|numeric',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$state = State::find($request->input('state_id'));
    		if (!empty($state)) {
    			return new StateResource($state);
    		}
    	}
    }

    public function locations(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'state_id'	=>	'required|numeric',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$locations = Location::where('state_id', $request->input('state_id'))
    							->orderBy('location', 'ASC')
    							->get()->all();
    		return LocationResource::collection($locations);
    	}
    }

    public function location(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'location_id'	=>	'required|numeric',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$location = Location::find($request->input('location_id'));
    		if (!empty($location)) {
    			return new LocationResource($location);
    		}
    	}
    }

    public function address(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'address_id'	=>	'required|numeric',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$address = User_address::find($request->input('address_id'));
            if($address){
                return new AddressResource($address);
            }else{
                return response()->json('Address not found');
            }
    	}
    }

    public function addresses(Request $request)
    {
    	$query = User_address::where('user_id', Auth::user()->id);
		if ($request->input('shipping_billing')) {
			$query->where('shipping_billing', $request->input('shipping_billing'));
		}
		if ($request->input('default_addr')) {
			$query->where('default_addr', $request->input('default_addr'));
		}
		$addresses = $query->get()->all();
		return AddressResource::collection($addresses);
    }

    public function address_create(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'name'			=>	'required|max:150',
    		    		'email'			=>	'nullable|email|max:150',
    		    		'mobile'		=>	'required|digits:10',
    		    		'landmark'		=>	'nullable|max:255',
    		    		'line1'			=>	'required|max:255',
    		    		'line2'			=>	'nullable|max:255',
    		    		'location_id'	=>	'required|numeric',
    		    		'pincode'		=>	'required|numeric|digits:6',
    		    		'state_id'		=>	'required|numeric',
    		    		'country_id'	=>	'required|numeric',
    		    		'default_addr'	=>	'required|boolean',
    		    		'shipping_billing'	=>	'required|numeric',
			    	]);
    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$user_id = Auth::user()->id;

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
    			$address = User_address::create([
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

    		return new AddressResource($address);
    	}
    }

    public function address_update(Request $request)
    {
    	$validation = validator($request->all(), [
    					'address_id'	=>	'required|numeric',
			    		'name'			=>	'required|max:150',
    		    		'email'			=>	'nullable|email|max:150',
    		    		'mobile'		=>	'required|digits:10',
    		    		'landmark'		=>	'nullable|max:255',
    		    		'line1'			=>	'required|max:255',
    		    		'line2'			=>	'nullable|max:255',
    		    		'location_id'	=>	'required|numeric',
    		    		'pincode'		=>	'required|numeric|digits:6',
    		    		'state_id'		=>	'required|numeric',
    		    		'country_id'	=>	'required|numeric',
    		    		'shipping_billing'	=>	'required|numeric',
			    	]);
    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$data = $request->all();
	    	$addr = User_address::where('id', $data['address_id'])
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
			if ($addr) {
				$address = User_address::find($data['address_id']);
				return new AddressResource($address);
			}
    	}
    }



}
