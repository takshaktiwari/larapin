<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount_category;
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
    		if (!empty($category['id'])) {

    			$a = Discount_category::updateOrCreate(
    				['category_id'	=>	$category['id']],

    				['discount'		=>	$category['discount'],
    				 'expires_at'	=>	$category['expires_at']]
    			);

    			echo "<pre>";
    			print_r ($a->toArray());
    			echo "</pre>";

    			$parent_category = Category::find($category['id']);
    			foreach ($parent_category->child_categories as $child) {
    				
    				Discount_category::updateOrCreate(
    					['category_id'	=>	$child->id],

    					['discount'		=>	$category['discount'],
    					 'expires_at'	=>	$category['expires_at']]
    				);

    			}
    		}
    	}

    	//return redirect()->back()->withErrors('SUCCESS !! Discounts are successfully update');
    }


}
