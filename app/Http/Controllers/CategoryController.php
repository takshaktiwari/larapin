<?php

namespace App\Http\Controllers;

use Image;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($value='')
    {
    	$categories = Category::with('parent_category')->paginate(25);
    	return view('admin/categories/categories')->with('categories', $categories);
    }

    public function create()
    {
    	$categories  = Category::get()->all();
    	return view('admin/categories/category_create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
    	$data = $request->all();

    	if (!isset($data['category_id'])) {
    		$request->validate([
    			'category'	=>	'required|unique:categories,category'
    		]);
    	}

    	$slug = str_replace(' ', '-', strtolower(trim($data['category'])));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	$object = [	'category'		=>	$data['category'],
    				'slug'			=>	$slug,
    				'parent'		=>	$data['parent'],
    				'm_title'		=>	$data['m_title'],
    				'm_keywords'	=>	$data['m_keywords'],
    				'm_description'	=>	$data['m_description'],
    				'featured'		=>	$data['featured'],
    				'status'		=>	$data['status'],
    			];

    	if ($_FILES['image_file']['tmp_name'] != '') {
			$image_lg = '/app/category/'.$slug.'.jpg';
		    $img = Image::make($_FILES['image_file']['tmp_name']);
		    $img->resize(1000, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_lg, 80, 'jpg');

	    	$image_md = '/app/category/md/'.$slug.'.jpg';
	        $img = Image::make($_FILES['image_file']['tmp_name']);
	        $img->resize(500, null, function ($constraint) { 
	            $constraint->aspectRatio();
	        });
	        $img->save(storage_path().$image_md, 80, 'jpg');

	        $image_sm = '/app/category/sm/'.$slug.'.jpg';
		    $img = Image::make($_FILES['image_file']['tmp_name']);
		    $img->resize(200, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_sm, 80, 'jpg');

		    $arr = ['image_lg'	=>	$image_lg,
					'image_md'	=>	$image_md,
					'image_sm'	=>	$image_sm];
			$object = array_merge($object, $arr);
    	}

    	if (isset($data['category_id'])) {
    		Category::where('id', $data['category_id'])->update($object);
    		$msg = 'SUCCESS !! Category is successfully updated';
    	}else{
    		Category::create($object);
    		$msg = 'SUCCESS !! Category is successfully updated';
    	}

        return redirect('admin/categories')->withErrors($msg);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::with('parent_category')->get()->all();
        return view('admin/categories/category_edit')
                                ->with('category', $category)
                                ->with('categories', $categories);
    }

    public function locations($id)
    {
        $countries = \App\Country::withCount('locations')
                                ->with(['states' => function($query){
                                    $query->withCount('locations');
                                    $query->with('locations');
                                }])
                                ->get()->all();
        $category = Category::with('locations')->find($id);

        return view('admin/categories/category_locations')
                                ->with('countries', $countries)
                                ->with('category', $category);
    }

    public function locations_update(Request $request)
    {
        $category = Category::find($request->post('category_id'));
        $category->locations()->sync($request->post('location'));
        return redirect('admin/categories')->withErrors('UPDATED !! Category Locations are successfully updated');
    }

    public function attributes($id)
    {
        $attributes = \App\Attribute::withCount('attr_options')
                                    ->with('attr_options')
                                    ->get()->all();
        $category   = Category::with('attributes')->with('attr_options')->find($id);
        return view('admin/categories/category_attributes')
                                ->with('attributes', $attributes)
                                ->with('category', $category);
    }

    public function attributes_update(Request $request)
    {
        $category = Category::find($request->post('category_id'));
        $category->attributes()->sync($request->post('attributes'));
        $category->attr_options()->sync($request->post('attr_options'));
        return redirect('admin/categories')->withErrors('UPDATED !! Category Attributes are successfully updated');
    }



}
