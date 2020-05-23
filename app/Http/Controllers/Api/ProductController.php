<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ProductsResource;
use App\Http\Resources\ProductResource;

use Auth;
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
    		$query = Product::where('status', '1');

            #   if user has added particular product to wishlist then add a column
            if ($request->input('api_token')) {
                $user = \App\User::where('api_token', trim($request->input('api_token')))->first();
                if ($user) {
                    $query->with(['wishlists' => function($query) use($user){
                        $query->where('user_id', $user->id);
                    }]);
                }
            }

            $query->with(['discount' => function($query){
                    $query->where('expires_at', '>', date('Y-m-d H:i:s'));
                    $query->orWhere('expires_at', null);
                }]);

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
    		$product = Product::with(['discount' => function($query){
                                    $query->where('expires_at', '>', date('Y-m-d H:i:s'));
                                    $query->orWhere('expires_at', null);
                                }])
                                ->with('reviews')
                                ->find($request->input('product_id'));
            
    		return new ProductResource($product);
    	}
    }

    
}
