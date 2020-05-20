<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $this->authorize('attribute_access');
    	$attributes = Attribute::paginate(25);
    	return view('admin/attributes/attributes')->with('attributes', $attributes);
    }

    public function create()
    {
        $this->authorize('attribute_create');
    	return view('admin/attributes/attribute_create');
    }

    public function store(Request $request)
    {
        $this->authorize('attribute_create');
    	$request->validate(['attribute' => 'required|unique:attributes']);
    	$slug = str_replace(' ', '-', strtolower(trim($request->post('attribute'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    	Attribute::create([
    		'attribute'	=>	$request->post('attribute'),
    		'slug'		=>	$slug
    	]);

    	return redirect('admin/attributes')->withErrors('CREATED !! New attribute '.$request->post('attribute').' is successfully created');
    }

    public function edit($id)
    {
        $this->authorize('attribute_update');
    	$attribute = Attribute::find($id);
    	return view('admin/attributes/attribute_edit')->with('attribute', $attribute);
    }

    public function update(Request $request)
    {
        $this->authorize('attribute_update');
    	$request->validate(['attribute' => 'required|unique:attributes']);
    	$slug = str_replace(' ', '-', strtolower(trim($request->post('attribute'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    	Attribute::where('id', $request->post('attribute_id'))
			    	->update([
			    		'attribute'	=>	$request->post('attribute'),
			    		'slug'		=>	$slug
			    	]);

    	return redirect('admin/attributes')->withErrors('UPDATED !! Attribute '.$request->post('attribute').' is successfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('attribute_delete');
    	Attribute::where('id', $id)->delete();
    	return redirect('admin/attributes')->withErrors('DELETED !! Attribute is successfully deleted');
    }
}
