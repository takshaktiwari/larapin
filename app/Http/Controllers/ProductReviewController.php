<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Product_review;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{

    public function front_reviews($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $reviews = Product_review::where('product_id', $product->id)->paginate(15);
            return view('reviews')->with('product', $product)->with('reviews', $reviews);
        }else{
            return redirect('shop')->withErrors('ERROR !! Product not found Or you may have entered wrong URL');
        }
    }

    public function front_store(Request $request)
    {
        $request->validate([
            'rating'    =>  'required|numeric|max:5',
            'title'     =>  'required|max:254',
            'review'    =>  'required|max:500',
            'product_id'=>  'required|numeric'
        ]);

        $order = \App\Order::where('user_id', Auth::user()->id)
                            ->whereHas('order_products', function($query) use ($request){
                                $query->where('product_id', $request->input('product_id'));
                            })->count();

        if ($order) {
            Product_review::create([
                'product_id'=>  $request->input('product_id'),
                'user_id'   =>  Auth::user()->id,
                'rating'    =>  $request->input('rating'),
                'title'     =>  $request->input('title'),
                'review'    =>  $request->input('review'),
                'user_ip'   =>  $request->ip(),
            ]);

            return redirect()->back()->withErrors('SUCCESS !! Thank you for writing a review. You review is successfully published');
        }else{
            return redirect()->back()->withErrors('NOT ALLOWED !! You the to purchase and try the product, Only then you will be able to write a review for this product');
        }
    }

    public function index()
    {
        $this->authorize('product_review_access');
    	$product_reviews = Product_review::orderBy('id', 'DESC')->paginate(25);
    	return view('admin/product_reviews/product_reviews')
    							->with('product_reviews', $product_reviews);
    }

    public function show($id)
    {
        $this->authorize('product_review_show');
    	$product_review = Product_review::find($id);
    	return view('admin/product_reviews/product_review_show')
    							->with('product_review', $product_review);
    }

    public function destroy($id)
    {
        $this->authorize('product_review_delete');
    	Product_review::find($id)->delete();
    	return redirect('admin/product_reviews')->withErrors('DELETED !! Product Review is successfully deleted');
    }
}
