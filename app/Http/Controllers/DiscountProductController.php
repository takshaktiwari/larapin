<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Discount_product;

class DiscountProductController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('discount_product_access');
    	$query = Product::where('id', '>', '0');

        # searching and filter
        if ($request->get('search')) {
            $search = $request->get('search');
            $query->where(function($query) use($search){
                $query->where('product_name', 'like', '%'.$search.'%');
                $query->orWhere('slug', 'like', '%'.$search.'%');
                $query->orWhere('subtitle', 'like', '%'.$search.'%');
                $query->orWhere('short_description', 'like', '%'.$search.'%');
                $query->orWhere('product_tags', 'like', '%'.$search.'%');
            });
        }

        if ($request->get('category')) {
            $query->whereHas('categories', function($query) use($request){
                $query->where('categories.id', $request->get('category'));
            });
        }

        if ($request->get('status')) {
            $query->where('status', $request->get('status'));
        }
        if ($request->get('featured')) {
            $query->where('featured', $request->get('featured'));
        }
        if ($request->get('in_offer')) {
            $query->where('in_offer', $request->get('in_offer'));
        }
        if ($request->get('min_price')) {
            $query->where('base_price', '>=', $request->get('min_price'));
        }
        if ($request->get('max_price')) {
            $query->where('base_price', '<=', $request->get('max_price'));
        }
        if ($request->get('min_stock')) {
            $query->where('base_stock', '>=', $request->get('min_stock'));
        }
        if ($request->get('max_stock')) {
            $query->where('base_stock', '<=', $request->get('max_stock'));
        }

        if ($request->get('min_discount')) {
            $query->whereHas('discount', function($query) use($request){
                $query->where('discount', '>=', $request->get('min_discount'));
            });
        }
        if ($request->get('max_discount')) {
            $query->whereHas('discount', function($query) use($request){
                $query->where('discount', '<=', $request->get('max_discount'));
            });
        }
        if ($request->get('expires_before')) {
            $query->whereHas('discount', function($query) use($request){
                $query->where('expires_at', '<=', $request->get('expires_before'));
            });
        }
        if ($request->get('expires_after')) {
            $query->whereHas('discount', function($query) use($request){
                $query->where('expires_at', '>=', $request->get('expires_after'));
            });
        }

		$products = $query->orderBy('product_name', 'ASC')
							->paginate(25);
    	$categories = \App\Category::orderBy('category', 'ASC')->get()->all();
    	return view('admin/discounts/discount_products')
                            ->with('products', $products)
                            ->with('categories', $categories);
    }

    public function update(Request $request)
    {
        $this->authorize('discount_product_update');
    	foreach ($request->post('products') as $product) {
    		if (!empty($product['id']) && 
    			$product['discount'] != '' && 
    			$product['discount'] <= 100) {

    			Discount_product::updateOrCreate(
    				['product_id' 	=> 	$product['id']],
    				['discount'  	=>	$product['discount'],
    				'expires_at'	=>	$product['expires_at']]
    			);
    		}
    	}

    	return redirect()->back()->withErrors('UPDATED !! Product discounts are updated');
    }
}
