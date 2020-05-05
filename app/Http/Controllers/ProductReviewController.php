<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_review;

class ProductReviewController extends Controller
{
    public function index()
    {
    	$product_reviews = Product_review::orderBy('id', 'DESC')->paginate(25);
    	return view('admin/product_reviews/product_reviews')
    							->with('product_reviews', $product_reviews);
    }

    public function show($id)
    {
    	$product_review = Product_review::find($id);
    	return view('admin/product_reviews/product_review_show')
    							->with('product_review', $product_review);
    }

    public function destroy($id)
    {
    	Product_review::find($id)->delete();
    	return redirect('admin/product_reviews')->withErrors('DELETED !! Product Review is successfully deleted');
    }
}
