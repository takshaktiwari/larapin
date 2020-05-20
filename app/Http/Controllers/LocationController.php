<?php

namespace App\Http\Controllers;

use App\State;
use App\Country;
use App\District;
use App\Pincode;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $this->authorize('location_access');
    	$locations = Location::paginate(25);
    	return view('admin/locations/locations')->with('locations', $locations);
    }

    public function create($value='')
    {
        $this->authorize('location_create');
    	$countries = Country::get()->all();
    	return view('admin/locations/location_create')->with('countries', $countries);
    }

    public function store(Request $request)
    {
        $this->authorize('location_create');
    	$request->validate([
    		'country_id'=>	'required|numeric',
    		'state_id'	=>	'required|numeric',
            'district_id'  =>  'required|numeric',
            'pincode_id'  =>  'required|numeric',
    		'location'	=>	'required|unique:locations',
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('location'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	Location::create([
    		'country_id'=>	$request->post('country_id'),
    		'state_id'	=>	$request->post('state_id'),
    		'district_id'	=>	$request->post('district_id'),
            'pincode_id'   =>  $request->post('pincode_id'),
    		'location'	=>	$request->post('location'),
    		'slug'		=>	$slug
    	]);

    	return redirect('admin/locations')->withErrors('CREATED !! New location is successfully created');
    }

    public function edit($id)
    {
        $this->authorize('location_update');
    	$location  = Location::find($id);
    	$countries = Country::get()->all();
    	$states    = State::where('country_id', $location->country_id)->get()->all();
        $districts = District::where('state_id', $location->state_id)->get()->all();
        $pincodes  = Pincode::where('district_id', $location->district_id)->get()->all();

    	return view('admin/locations/location_edit')
    									->with('location', $location)
    									->with('countries', $countries)
    									->with('states', $states)
                                        ->with('districts', $districts)
                                        ->with('pincodes', $pincodes);
    }

    public function update(Request $request)
    {
        $this->authorize('location_update');
    	$request->validate([
    		'country_id'=>	'required|numeric',
    		'state_id'	=>	'required|numeric',
    		'district_id'  =>  'required|numeric',
            'pincode_id'  =>  'required|numeric',
    		'location'	=>	'required',
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('location'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	Location::where('id', $request->post('location_id'))
			    	->update([
			    		'country_id'=>	$request->post('country_id'),
			    		'state_id'	=>	$request->post('state_id'),
			    		'district_id'  =>  $request->post('district_id'),
                        'pincode_id'   =>  $request->post('pincode_id'),
                        'location'  =>  $request->post('location'),
			    		'slug'		=>	$slug
			    	]);

    	return redirect('admin/locations')->withErrors('UPDATED !! New location is successfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('location_delete');
        Location::where('id', $id)->delete();
        return redirect('admin/locations')->withErrors('DELETED !! Location is successfully DELETED');
    }

}
