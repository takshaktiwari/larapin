<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount_category;
use App\Discount_product;
use App\Category;

class DiscountCategoryController extends Controller
{
    public function index()
    {
    	$categories = Category::whereNull('parent')->orderBy('category', 'ASC')->paginate(25);
    	return view('admin/discounts/discount_category')
    					->with('categories', $categories);
    }

    public function update(Request $request)
    {
    	foreach ($request->post('categories') as $category) {
    		if (!empty($category['id']) && 
                $category['discount'] != '' && 
                $category['discount'] <= '100') {

    			Discount_category::updateOrCreate(
    				['category_id'	=>	$category['id']],

    				['discount'		=>	$category['discount'],
    				 'expires_at'	=>	$category['expires_at']]
    			);

    			$parent_category = Category::find($category['id']);
    			foreach ($parent_category->child_categories as $child) {

    				Discount_category::updateOrCreate(
    					['category_id'	=>	$child->id],

    					['discount'		=>	$category['discount'],
    					 'expires_at'	=>	$category['expires_at']]
    				);
    			}

                $child_ids    = $parent_category->child_categories->pluck('id')->toArray();
                $category_ids = array_merge($child_ids, [$category['id']]);

                $cats = Category::whereIn('id', $category_ids)
                                        ->with('products')
                                        ->get()->all();
                $product_ids = [];
                foreach ($cats as $cat) {
                    $pr_ids = $cat->products->pluck('id')->toArray();
                    $product_ids = array_merge($product_ids, $pr_ids);
                }
                $product_ids = array_unique($product_ids);

                Discount_product::whereIn('product_id', $product_ids)
                                ->update(['discount'    =>  $category['discount'],
                                        'expires_at'    =>  $category['expires_at']]);
    		}
    	}

    	return redirect()->back()->withErrors('SUCCESS !! Discounts are successfully update');
    }


}
