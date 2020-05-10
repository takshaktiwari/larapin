<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
    	$products = Product::where('status', '1')->paginate(21);
    	return view('shop')->with('products', $products);
    }

    public function product($slug)
    {
    	$product = Product::where('slug', $slug)->first();
    	
    	$related = Product::with('categories')
    						->whereHas('categories', function($query) use ($product){
    							$categories = $product->categories->pluck('id')->toArray();
    							$query->whereIn('categories.id', $categories);
    						})
    						->inRandomOrder()
    						->limit('10')->get()->all();
    	return view('product')->with('product', $product)->with('related', $related);
    }
}
