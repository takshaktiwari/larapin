<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    public function index()
    {
    	$brands = Brand::paginate(25);
    	return view('admin/brands/brands')->with('brands', $brands);
    }

    public function create()
    {
    	return view('admin/brands/brand_create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'brand'			=>	'required|unique:brands,brand',
    		'm_title'		=> 'nullable|max:250',
    		'm_keywords' 	=> 'nullable|max:250',
    		'm_description' => 'nullable|max:250',
    	]);
    	$slug = str_replace(' ', '-', strtolower(trim($request->post('brand'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	$brand = Brand::create([
    		'brand'			=>	$request->post('brand'),
    		'slug'			=>	$slug,
    		'm_title'		=>	$request->post('m_title'),
    		'm_keywords'	=>	$request->post('m_keywords'),
    		'm_description'	=>	$request->post('m_description'),
    	]);

    	return redirect('admin/brands')->withErrors('CREATED !! Brand is successfully created');
    }

    public function edit($id)
    {
    	$brand = Brand::find($id);
    	return view('admin/brands/brand_edit')->with('brand', $brand);
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'brand'			=>	'required',
    		'm_title'		=> 	'nullable|max:250',
    		'm_keywords' 	=> 	'nullable|max:250',
    		'm_description' => 	'nullable|max:250',
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('brand'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	Brand::find($request->post('brand_id'))
		    	->update([
		    		'brand'			=>	$request->post('brand'),
		    		'slug'			=>	$slug,
		    		'm_title'		=>	$request->post('m_title'),
		    		'm_keywords'	=>	$request->post('m_keywords'),
		    		'm_description'	=>	$request->post('m_description'),
		    	]);
		return redirect('admin/brands')->withErrors('UPDATED !! Brand is successfully updated');
    }

    public function destroy($id)
    {
    	Brand::find($id)->delete();
    	return redirect()->back()->withErrors('DELETED !! Brand is successfully deleted');
    }
}
