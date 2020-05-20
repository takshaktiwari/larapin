<?php

namespace App\Http\Controllers;

use App\State;
use App\Country;
use App\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $this->authorize('district_access');
    	$districts = District::orderBY('district', 'ASC')->paginate(25);
    	return view('admin/districts/districts')->with('districts', $districts);
    }

    public function create($value='')
    {
        $this->authorize('district_create');
    	$countries = Country::get()->all();
    	return view('admin/districts/district_create')->with('countries', $countries);
    }

    public function store(Request $request)
    {
        $this->authorize('district_create');
    	$request->validate([
    		'country_id'=>	'required|numeric',
    		'state_id'	=>	'required|numeric',
    		'district'	=>	'required|unique:districts',
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('district'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	District::create([
    		'country_id'=>	$request->post('country_id'),
    		'state_id'	=>	$request->post('state_id'),
    		'district'	=>	$request->post('district'),
    		'slug'		=>	$slug
    	]);

    	return redirect('admin/districts')->withErrors('CREATED !! New location is successfully created');
    }

    public function edit($id)
    {
        $this->authorize('district_update');
    	$district = District::find($id);
    	$countries = Country::get()->all();
    	$states = State::where('country_id', $district->country_id)->get()->all();

    	return view('admin/districts/district_edit')
    									->with('district', $district)
    									->with('countries', $countries)
    									->with('states', $states);
    }

    public function update(Request $request)
    {
        $this->authorize('district_update');
    	$request->validate([
    		'country_id'=>	'required|numeric',
    		'state_id'	=>	'required|numeric',
    		'district'	=>	'required',
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('district'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	District::where('id', $request->post('district_id'))
			    	->update([
			    		'country_id'=>	$request->post('country_id'),
			    		'state_id'	=>	$request->post('state_id'),
			    		'district'	=>	$request->post('district'),
			    		'slug'		=>	$slug
			    	]);

    	return redirect('admin/districts')->withErrors('UPDATED !! District is successfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('district_delete');
        District::where('id', $id)->delete();
        return redirect('admin/districts')->withErrors('DELETED !! District is successfully DELETED');
    }
}
