<?php

namespace App\Http\Controllers;

use App\Product;
use App\Product_detail;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function edit($id)
    {
        $this->authorize('product_update_details');
    	$product = Product::find($id);
    	return view('admin/products/product_details')->with('product', $product);
    }

    public function update(Request $request)
    {
        $this->authorize('product_update_details');
    	$request->validate([
    		'ship_charge'	=>	'nullable',
    		'ship_time'		=>	'nullable|numeric',
    		'sku_code'		=>	'nullable',
    		'description'	=>	'nullable',
    		'm_title'		=>	'nullable|max:254',
    		'm_keywords'	=>	'nullable|max:254',
    		'm_description'	=>	'nullable|max:254',
    		'product_id'	=>	'required|numeric',
    	]);

    	Product_detail::updateOrCreate(
    		['product_id' => $request->post('product_id')],
    		[	'ship_charge'	=>	$request->post('ship_charge'),
    			'ship_time'		=>	$request->post('ship_time'),
    			'sku_code'		=>	$request->post('sku_code'),
    			'description'	=>	$request->post('description'),
    			'm_title'		=>	$request->post('m_title'),
    			'm_keywords'	=>	$request->post('m_keywords'),
    			'm_description'	=>	$request->post('m_description'),
    		]
    	);

    	return redirect('admin/product/variants/'.$request->post('product_id'))
    				->withErrors('UPDATED !! Product details are successfully updated');
    }
}
