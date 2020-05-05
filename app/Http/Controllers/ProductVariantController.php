<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Product_variant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function edit($id)
    {
    	$product = Product::with(['categories' => function($query){
                        $query->with('attributes');
                        $query->has('attributes', '>', '0');
                    }])->find($id);

        $attributes_id = [];

        foreach ($product->categories as $category) {

            foreach ($category->attributes as $attribute) {
                array_push($attributes_id, $attribute->id);
            }
        }

        $attributes_id = array_unique($attributes_id);

        $attributes = \App\Attribute::whereIn('id', $attributes_id)
                                    ->get()->all();


    	return view('admin/products/product_variants')->with('product', $product)
                                                    ->with('attributes', $attributes);
    }

    public function update(Request $request)
    {
    	$data = $request->all();

    	Product_variant::where('product_id', $request->post('product_id'))->delete();
    	if(isset($data['attributes']) && count($data['attributes']) > 0){
    		foreach ($data['attributes'] as $attribute) {

    			if (isset($attribute['id'])) {
    				$attribute_id = $attribute['id'];

    				foreach ($attribute['attr_options'] as $key => $attr_option) {
    					if (isset($attr_option['id'])) {
    						$arr = Product_variant::create([
    							'product_id'	   =>	$request->post('product_id'),
    							'attribute_id'	   =>	$attribute_id,
    							'attr_option_id'   =>	$attr_option['id'],
    							'attr_option_name' =>	$key,
    							'price'			   =>	$attr_option['price'],
    							'discount'		   =>	$attr_option['discount'],
                                'stock'            =>   $attr_option['stock'],
    						]);
    					}
    				} # endforeach
    			} # endif
    		} # endforeach
    	} # endif

    	return redirect('admin/product/images/'.$request->post('product_id'))
    				->withErrors('SUCCESS !! Product is successfully updated');
    } 
}
