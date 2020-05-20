<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Attr_option;
use Illuminate\Http\Request;

class AttrOptionController extends Controller
{
	public function index($value='')
	{
		$this->authorize('attribute_option_access');
		$attr_options = Attr_option::paginate();
		return view('admin/attributes/attr_options')->with('attr_options', $attr_options);
	}

	public function create()
	{
		$this->authorize('attribute_option_create');
		$attributes = Attribute::get()->all();
		return view('admin/attributes/attr_option_create')->with('attributes', $attributes);
	}

	public function store(Request $request)
	{
		$this->authorize('attribute_option_create');
		$request->validate([
			'attribute_id'	=>	'required|numeric',
			'attr_option'	=>	'required'
		]);

		$slug = str_replace(' ', '-', strtolower(trim($request->post('attr_option'))));
		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

		Attr_option::create([
			'attribute_id'	=>	$request->post('attribute_id'),
			'attr_option'	=>	$request->post('attr_option'),
			'slug'			=>	$slug
		]);

		return redirect('admin/attr_options')->withErrors('CREATED !! New option '.$request->post('attr_option').' is successfully created');
	}

	public function edit($id)
	{
		$this->authorize('attribute_option_update');
		$attributes = Attribute::get()->all();
		$attr_option = Attr_option::find($id);

		return view('admin/attributes/attr_option_edit')
						->with('attributes', $attributes)
						->with('attr_option', $attr_option);
	}

	public function update(Request $request)
	{
		$this->authorize('attribute_option_update');
		$request->validate([
			'attribute_id'	=>	'required|numeric',
			'attr_option'	=>	'required'
		]);

		$slug = str_replace(' ', '-', strtolower(trim($request->post('attr_option'))));
		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

		Attr_option::where('id', $request->post('attr_option_id'))
					->update([
						'attribute_id'	=>	$request->post('attribute_id'),
						'attr_option'	=>	$request->post('attr_option'),
						'slug'			=>	$slug
					]);

		return redirect('admin/attr_options')->withErrors('UPDATED !! Option '.$request->post('attr_option').' is successfully updated');
	}

	public function destroy($id)
	{
		$this->authorize('attribute_option_delete');
		Attr_option::where('id', $id)->delete();
		return redirect('admin/attr_options')->withErrors('DELETED !! Option is successfully deleted');
	}
    
}
