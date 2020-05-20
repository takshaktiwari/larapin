<?php

namespace App\Http\Controllers;

use App\Pincode;
use Illuminate\Http\Request;

class PincodeController extends Controller
{
    public function index()
    {
        $this->authorize('pincode_access');
    	$pincodes = Pincode::paginate(25);
    	return view('admin/pincodes/pincodes')->with('pincodes', $pincodes);
    }

    public function create()
    {
        $this->authorize('pincode_create');
    	$countries = \App\Country::orderBy('country', 'ASC')->get()->all();
    	return view('admin/pincodes/pincode_create')->with('countries', $countries);
    }

    public function store(Request $request)
    {
        $this->authorize('pincode_create');
    	$request->validate([
    		'country_id'=>	'required|numeric',
    		'state_id'	=>	'required|numeric',
            'district_id'  =>  'required|numeric',
    		'pincode'	=>	'required|numeric|digits:6|unique:pincodes',
    	]);

    	Pincode::create([
    		'country_id'=>	$request->input('country_id'),
    		'state_id'	=>	$request->input('state_id'),
            'district_id'  =>  $request->input('district_id'),
    		'pincode'	=>	$request->input('pincode'),
    	]);

    	return redirect('admin/pincodes')->withErrors('CREATED !! New pincode is created');
    }

    public function edit($id)
    {
        $this->authorize('pincode_update');
    	$pincode = Pincode::find($id);
    	$countries = \App\Country::orderBy('country', 'ASC')->get()->all();
    	$states = \App\State::where('country_id', $pincode->country_id)
    							->orderBy('state', 'ASC')
    							->get()->all();
        $districts = \App\District::where('state_id', $pincode->state_id)
                                ->orderBy('district', 'ASC')
                                ->get()->all();
    	return view('admin/pincodes/pincode_edit')
    					->with('countries', $countries)
    					->with('states', $states)
                        ->with('districts', $districts)
    					->with('pincode', $pincode);
    }

    public function update(Request $request)
    {
        $this->authorize('pincode_update');
    	$request->validate([
    		'country_id'=>	'required|numeric',
    		'state_id'	=>	'required|numeric',
            'district_id'  =>  'required|numeric',
    		'pincode'	=>	'required|numeric|digits:6',
    	]);

    	Pincode::where('id', $request->input('pincode_id'))
		    	->update([
		    		'country_id'=>	$request->input('country_id'),
		    		'state_id'	=>	$request->input('state_id'),
                    'district_id'  =>  $request->input('district_id'),
		    		'pincode'	=>	$request->input('pincode'),
		    	]);

    	return redirect('admin/pincodes')->withErrors('UPDATED !! Pincode is successfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('pincode_delete');
    	Pincode::where('id', $id)->delete();
    	return redirect('admin/pincodes')->withErrors('DELETED !! Pincode is successfully deleted');
    }
}
