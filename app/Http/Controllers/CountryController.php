<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $this->authorize('country_access');
    	$countries = Country::paginate(25);
    	return view('admin/countries/countries')->with('countries', $countries);
    }

    public function create()
    {
        $this->authorize('country_create');
    	return view('admin/countries/country_create');
    }

    public function store(Request $request)
    {
        $this->authorize('country_create');
    	$request->validate(['country' => 'required|unique:countries']);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('country'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    	$country =  Country::create([
			    		'country' 	=>	ucfirst($request->post('country')),
			    		'slug'		=>	$slug
			    	]);

    	return redirect('admin/countries')->withErrors('CREATED !! New country '.$request->post('country').' is successfully created');
    }

    public function edit($id)
    {
        $this->authorize('country_update');
    	$country = Country::find($id);
    	return view('admin/countries/country_edit')->with('country', $country);
    }

    public function update(Request $request)
    {
        $this->authorize('country_update');
    	$slug = str_replace(' ', '-', strtolower(trim($request->post('country'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    	
    	Country::where('id', $request->post('country_id'))
				->update([
			    		'country' 	=>	ucfirst($request->post('country')),
			    		'slug'		=>	$slug
			    	]);

    	return redirect('admin/countries')->withErrors('UPDATED !! New country '.$request->post('country').' is successfully created');
    }

    public function destroy($id)
    {
        $this->authorize('country_delete');
    	Country::where('id', $id)->delete();
    	return redirect('admin/countries')->withErrors('DELETED !! New country is successfully deleted');
    }
}
