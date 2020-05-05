<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ProductReviewResource;

use App\Product_review;

class ReviewsController extends Controller
{
    public function reviews(Request $request)
    {
        $validation = validator($request->all(), [
                        'product_id'    =>  'required_without:user_id|nullable|numeric',
                        'user_id'    	=>  'required_without:product_id|nullable|numeric',
                    ]);

        if ($validation->fails()) {
            return $validation->errors();
        }else{
            $query = Product_review::with('user');

            if ($request->input('product_id')) {
                $query = $query->where('product_id', $request->input('product_id'));
            }

            if ($request->input('user_id')) {
                $query = $query->where('user_id', $request->input('user_id'));
            }

            if ($request->input('limit')) {
                $reviews = $query->paginate($request->input('limit'));
            }else{
                $reviews = $query->paginate(25);
            }

            return ProductReviewResource::collection($reviews);
        }
    }

    public function review_single(Request $request)
    {
    	$validation = validator($request->all(), [
    	                'review_id'    =>  'required|numeric',
    	            ]);

    	if ($validation->fails()) {
    	    return $validation->errors();
    	}else{
    		$review = Product_review::with('user')->find($request->input('review_id'));

    		return new ProductReviewResource($review);
    	}
    }
}
