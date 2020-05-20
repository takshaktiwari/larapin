<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\User_address;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function front_addresses($value='')
    {
        return view('user/addresses');
    }

    public function front_create()
    {
        $countries = \App\Country::orderBy('country', 'ASC')->get()->all();
        return view('user/address_create')->with('countries', $countries);
    }

    public function front_edit($addr_id)
    {
        $address = User_address::find($addr_id);
        $countries = \App\Country::orderBy('country', 'ASC')->get()->all();

        $states = \App\State::where('country_id', 'like', $address->country_id)
                            ->orderBy('state', 'ASC')->get()->all();

        $districts = \App\District::where('state_id', $address->state_id)
                            ->orderBy('district', 'ASC')->get()->all();

        $pincodes = \App\Pincode::where('district_id', $address->district_id)
                            ->orderBy('pincode', 'ASC')->get()->all();

        $locations = \App\Location::where('pincode_id', $address->pincode_id)
                            ->orderBy('location', 'ASC')->get()->all();

        return view('user/address_edit')->with('address', $address)
                                        ->with('countries', $countries)
                                        ->with('states', $states)
                                        ->with('districts', $districts)
                                        ->with('pincodes', $pincodes)
                                        ->with('locations', $locations);
    }



    public function index($user_id='')
    {
        $this->authorize('user_address_access');
    	if (empty($user_id)) {
    		$user_id = Auth::user()->id;
    	}

    	$user = User::find($user_id);
    	$addresses = User_address::where('user_id', $user_id)
    								->get()->all();
    	return view('admin/users/addresses')->with('user', $user)
    										->with('addresses', $addresses);
    }

    public function create($user_id='')
    {
        $this->authorize('user_address_create');
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
    		'pincode_id'	=>	'required|numeric',
    		'district_id'	=>	'required|numeric',
            'state_id'      =>  'required|numeric',
    		'country_id'	=>	'required|numeric',
    	]);
    	
    	$user_id = $request->post('user_id');
    	if (empty($user_id)) {
    		$user_id = Auth::user()->id;
    	}
    	
    	$data = $request->all();
		User_address::create([
			'user_id'		=>	$user_id,
			'name'			=>	$data['name'],
			'email'			=>	$data['email'],
			'mobile'		=>	$data['mobile'],
			'landmark'		=>	$data['landmark'],
			'line1'			=>	$data['line1'],
			'line2'			=>	$data['line2'],
			'location_id'	=>	$data['location_id'],
			'pincode_id'	=>	$data['pincode_id'],
            'district_id'   =>  $data['district_id'],
			'state_id'		=>	$data['state_id'],
			'country_id'	=>	$data['country_id'],
			'default_addr'		=>	true
		]);
    	

    	return redirect()->back()
    				->withErrors('CREATED !! Addresses are successfully created');
    }

    public function primary_addr($addr_id)
    {
    	$address = User_address::find($addr_id);

    	User_address::where('user_id', $address->user_id)
    				->update(['default_addr' => false]);

    	$address->update(['default_addr' => true]);
    	return redirect()->back()
    				->withErrors('SUCCESS !! Address is successfully set to default');
    }

    public function edit($addr_id)
    {
        $this->authorize('user_address_edit');
    	$address = User_address::first();
    	$countries = \App\Country::orderBy('country', 'ASC')->get()->all();

    	$states = \App\State::where('country_id', 'like', $address->country_id)
    						->orderBy('state', 'ASC')->get()->all();

        $districts = \App\District::where('state_id', $address->state_id)
                            ->orderBy('district', 'ASC')->get()->all();

        $pincodes = \App\Pincode::where('district_id', $address->district_id)
                            ->orderBy('pincode', 'ASC')->get()->all();

    	$locations = \App\Location::where('pincode_id', $address->pincode_id)
    						->orderBy('location', 'ASC')->get()->all();

    	return view('admin/users/address_edit')->with('address', $address)
    											->with('countries', $countries)
    											->with('states', $states)
                                                ->with('districts', $districts)
                                                ->with('pincodes', $pincodes)
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
    		'pincode_id'    =>  'required|numeric',
            'district_id'   =>  'required|numeric',
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
			    		'pincode_id'    =>  $data['pincode_id'],
                        'district_id'   =>  $data['district_id'],
			    		'state_id'		=>	$data['state_id'],
			    		'country_id'	=>	$data['country_id'],
			    	]);

		return redirect()->back()
					->withErrors('UPDATED !! Address is successfully updated');
    }

    public function destroy($id)
    {
        User_address::where('id', $id)->delete();
        return redirect()->back()
                    ->withErrors('DELETED !! Address is successfully deleted');
    }
}
