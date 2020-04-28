<?php

namespace App\Http\Controllers;

use App\State;
use App\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index($value='')
    {
    	$states = State::with('country')->paginate(25);
    	return view('admin/states/states')->with('states', $states);
    }

    public function create()
    {
    	$countries = Country::orderBy('country', 'ASC')->get()->all();
    	return view('admin/states/state_create')->with('countries', $countries);
    }

    public function store(Request $request)
    {
    	$request->validate([
    			'country_id' => 'required|numeric', 
    			'state' => 'required|unique:states'
    		]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('state'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	$state = State::create([
    					'country_id'=>	$request->post('country_id'),
    					'state'		=>	ucfirst($request->post('state')),
    					'slug'		=>	$slug
    			]);

    	return redirect('admin/states')->withErrors('CREATED !! New state '.ucfirst($request->post('state')).' is successfully created');
    }

    public function edit($id)
    {
    	$state = State::with('country')->find($id);
    	$countries = Country::orderBy('country', 'ASC')->get()->all();
    	return view('admin/states/state_edit')->with('state', $state)
    										->with('countries', $countries);
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'country_id'	=>	'required',
    		'state'			=>	'required'
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('state'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	State::where('id', $request->post('state_id'))
    			->update([
    				'country_id'	=>	$request->post('country_id'),
    				'state'			=>	$request->post('state'),
    				'slug'			=>	$slug,
    			]);

    	return redirect('admin/states')
    				->withErrors('UPDATED !! State is successfully updated');
    }

    public function destroy($id)
    {
    	State::where('id', $id)->delete();
    	return redirect('admin/states')
    				->withErrors('DELETED !! State is successfully deleted');
    }
}
