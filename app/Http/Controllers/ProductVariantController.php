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
    	$product = Product::find($id);

    	$category = Category::with(['attributes' =>	function($query) use ($product){
									#	getting select option of this attribute
									$cat =	Category::with(['attr_options' => function($query){
		    										$query->whereRaw('attr_options.attribute_id', 'attributes.id');
		    									}])
												->find($product->category_id);
									#   available options in array for this attribute
									$options = $cat->attr_options->pluck('id')->toArray();
						    		$query->with(['attr_options' => function($query) use ($options){
						    			#	select only those options with are selected
						    			#	category options are in 'attr_option_category' table
						    			$query->whereIn('id', $options);
						    		}]);
						    	}])
								->find($product->category_id);

    	return view('admin/products/product_variants')->with('product', $product)
    												->with('category', $category);
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
    						Product_variant::create([
    							'product_id'	=>	$request->post('product_id'),
    							'attribute_id'	=>	$attribute_id,
    							'attr_option_id'=>	$attr_option['id'],
    							'attr_option'	=>	$key,
    							'price'			=>	$attr_option['price'],
    							'discount'		=>	$attr_option['discount']
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
