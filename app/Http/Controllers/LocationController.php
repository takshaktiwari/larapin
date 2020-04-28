<?php

namespace App\Http\Controllers;

use App\State;
use App\Country;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
    	$locations = Location::paginate(25);
    	return view('admin/locations/locations')->with('locations', $locations);
    }

    public function create($value='')
    {
    	$countries = Country::get()->all();
    	return view('admin/locations/location_create')->with('countries', $countries);
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'country_id'=>	'required|numeric',
    		'state_id'	=>	'required|numeric',
    		'location'	=>	'required',
    		'pin_code'	=>	'required|numeric|digits:6|unique:locations,pincode'
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('location'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	Location::create([
    		'country_id'=>	$request->post('country_id'),
    		'state_id'	=>	$request->post('state_id'),
    		'location'	=>	$request->post('location'),
    		'pincode'	=>	$request->post('pin_code'),
    		'slug'		=>	$slug
    	]);

    	return redirect('admin/locations')->withErrors('CREATED !! New location is successfully created');
    }

    public function edit($id)
    {
    	$location = Location::find($id);
    	$countries = Country::get()->all();
    	$states = State::where('country_id', $location->country_id)->get()->all();

    	return view('admin/locations/location_edit')
    									->with('location', $location)
    									->with('countries', $countries)
    									->with('states', $states);
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'country_id'=>	'required|numeric',
    		'state_id'	=>	'required|numeric',
    		'location'	=>	'required',
    		'pin_code'	=>	'required|numeric|digits:6'
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('location'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	Location::where('id', $request->post('location_id'))
			    	->update([
			    		'country_id'=>	$request->post('country_id'),
			    		'state_id'	=>	$request->post('state_id'),
			    		'location'	=>	$request->post('location'),
			    		'pincode'	=>	$request->post('pin_code'),
			    		'slug'		=>	$slug
			    	]);

    	return redirect('admin/locations')->withErrors('UPDATED !! New location is successfully updated');
    }

}
