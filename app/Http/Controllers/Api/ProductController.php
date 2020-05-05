<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ProductsResource;
use App\Http\Resources\ProductResource;

use App\Product;


class ProductController extends Controller
{
    public function products(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'featured'	    =>	'nullable|numeric',
			    		'category_id'	=>	'nullable|numeric',
                        'limit'         =>  'nullable|numeric',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$query = Product::with('reviews')->where('status', '1');
    		if($request->input('featured') != ''){
    			$query = $query->where('featured', $request->input('featured'));
    		}
    		if ($request->input('category_id')) {
    			$category_id = $request->input('category_id');
    			$query->whereHas('categories', function($query) use ($category_id){
    				$query->where('categories.id', $category_id);
    			});
    		}
            if ($request->input('latest') == '1') {
                $query->orderBy('id', 'DESC');
            }
            if ($request->input('limit')) {
                $products = $query->paginate($request->input('limit'));
            }else{
                $products = $query->paginate(25);
            }
    		
    		return ProductsResource::collection($products);
    	}
    }

    public function product(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'product_id'	=>	'required|numeric',
                        'limit'         =>  'nullable|numeric',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
    		$product = Product::with('reviews')
                        ->find($request->input('product_id'));

    		return new ProductResource($product);
    	}
    }

    
}
