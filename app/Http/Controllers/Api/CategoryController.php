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
    		$query = Category::with(['discount_category' => function($query){
                                    $query->where('expires_at', '>', date('Y-m-d H:i:s'));
                                    $query->orWhere('expires_at', null);
                                }])
                                ->where('status', '1')->whereNull('parent');

    		if ($request->input('featured') != '') {
    			$query = $query->where('featured', $request->input('featured'));
    		}
    		if ($request->input('pincode') != '') {
    			$pincode = $request->input('pincode');
    			$query   = $query->whereHas('pincodes', function($query) use ($pincode){
		    				$query->where('pincode', $pincode);
		    			});
    		}
            if ($request->input('latest') == '1') {
                $query->orderBy('id', 'DESC');
            }

            if (empty($request->input('limit'))) {
                $categories = $query->paginate('25');
            }else{
                $categories = $query->paginate($request->input('limit'));
            }

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
    		$category = Category::with(['discount_category' => function($query){
                                    $query->where('expires_at', '>', date('Y-m-d H:i:s'));
                                    $query->orWhere('expires_at', null);
                                }])
                                ->where('id', $request->input('category_id'))
								->where('status', '1')
								->first();

    		return new CategoryResource($category);
    	}
    }
}
