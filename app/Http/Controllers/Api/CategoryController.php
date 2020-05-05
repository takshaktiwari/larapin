<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function categories(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'featured'	=>	'nullable|numeric',
			    		'pincode'	=>	'nullable|digits:6',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$query = Category::where('status', '1')->whereNull('parent');

    		if ($request->input('featured') != '') {
    			$query = $query->where('featured', $request->input('featured'));
    		}
    		if ($request->input('pincode') != '') {
    			$pincode = $request->input('pincode');
    			$query = $query->whereHas('locations', function($query) use ($pincode){
		    				$query->where('pincode', $pincode);
		    			});
    		}
            if ($request->input('latest') == '1') {
                $query->orderBy('id', 'DESC');
            }
            if ($request->input('limit')) {
                $query->limit($request->input('limit'));
            }

    		$categories = $query->get()->all();

    		return CategoryResource::collection($categories);
    	}
    }

    public function category(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'category_id'	=>	'required|numeric'
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$category = Category::where('id', $request->input('category_id'))
    								->where('status', '1')
    								->first();

    		return new CategoryResource($category);
    	}
    }
}
