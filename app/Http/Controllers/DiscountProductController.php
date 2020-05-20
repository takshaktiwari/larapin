<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Discount_product;

class DiscountProductController extends Controller
{
    public function index()
    {
        $this->authorize('discount_product_access');
    	$products = Product::with('discount')
							->orderBy('product_name', 'ASC')
							->paginate(25);
    	
    	return view('admin/discounts/discount_products')->with('products', $products);
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
