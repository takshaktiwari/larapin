<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Country;
use App\State;
use App\District;
use App\Pincode;
use App\Location;
use App\User_address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\PincodeResource;
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

    public function districts(Request $request)
    {
        $validation = validator($request->all(), [
                        'state_id'  =>  'required|numeric',
                    ]);

        if ($validation->fails()) {
            return $validation->errors();
        }else{
            $query = District::where('state_id', $request->input('state_id'));
            if (empty($request->input('limit'))) {
                $districts = $query->paginate(25);
            }else{
                $districts = $query->paginate($request->input('limit'));
            }
            return DistrictResource::collection($districts);
        }
    }

    public function district(Request $request)
    {
        $validation = validator($request->all(), [
                        'district_id'  =>  'required|numeric',
                    ]);

        if ($validation->fails()) {
            return $validation->errors();
        }else{
            $district = District::find($request->input('district_id'));
            return new DistrictResource($district);
        }
    }

    public function pincodes(Request $request)
    {
        $validation = validator($request->all(), [
                        'district_id'  =>  'required|numeric',
                    ]);

        if ($validation->fails()) {
            return $validation->errors();
        }else{
            $query = Pincode::where('district_id', $request->input('district_id'));

            if (empty($request->input('limit'))) {
                $pincodes = $query->paginate(25);
            }else{
                $pincodes = $query->paginate($request->input('limit'));
            }

            return PincodeResource::collection($pincodes);
        }
    }

    public function pincode(Request $request)
    {
        $validation = validator($request->all(), [
                        'pincode_id'  =>  'required|numeric',
                    ]);

        if ($validation->fails()) {
            return $validation->errors();
        }else{
            $pincode = Pincode::find($request->input('pincode_id'));
            return new PincodeResource($pincode);
        }
    }

    public function locations(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'pincode_id'	=>	'required|numeric',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$locations = Location::where('pincode_id', $request->input('pincode_id'))
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
                return response()->json(['data' => ['msg' => 'Address not found']]);
            }
    	}
    }

    public function addresses(Request $request)
    {
    	$query = User_address::where('user_id', Auth::user()->id);
		if ($request->input('default_addr') != '') {
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
    		    		'pincode_id'    =>	'required|numeric',
                        'district_id'   =>  'required|numeric',
    		    		'state_id'		=>	'required|numeric',
    		    		'country_id'	=>	'required|numeric',
    		    		'default_addr'	=>	'required|boolean',
			    	]);
    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
            User_address::where('user_id', Auth::user()->id)
                            ->update(['default_addr' => false]);

    		$data = $request->all();
			$address = User_address::create([
		    				'user_id'		=>	Auth::user()->id,
		    				'name'			=>	$data['name'],
		    				'email'			=>	$data['email'],
		    				'mobile'		=>	$data['mobile'],
		    				'landmark'		=>	$data['landmark'],
		    				'line1'			=>	$data['line1'],
		    				'line2'			=>	$data['line2'],
		    				'location_id'	=>	$data['location_id'],
		    				'pincode_id'    =>	$data['pincode_id'],
                            'district_id'   =>  $data['district_id'],
		    				'state_id'		=>	$data['state_id'],
		    				'country_id'	=>	$data['country_id'],
		    				'default_addr'	=>	1
		    			]);
    		

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
    		    		'location_id'   =>  'required|numeric',
                        'pincode_id'    =>  'required|numeric',
                        'district_id'   =>  'required|numeric',
                        'state_id'      =>  'required|numeric',
                        'country_id'    =>  'required|numeric',
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
					    		'location_id'   =>  $data['location_id'],
                                'pincode_id'    =>  $data['pincode_id'],
                                'district_id'   =>  $data['district_id'],
                                'state_id'      =>  $data['state_id'],
                                'country_id'    =>  $data['country_id'],
					    	]);
			if ($addr) {
				$address = User_address::find($data['address_id']);
				return new AddressResource($address);
			}else{
                return response()->json(['data' => ['msg' => 'Address not updated']]);
            }
    	}
    }



}
