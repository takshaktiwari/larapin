<?php

namespace App\Http\Controllers;

use Agent;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
    	$query = Product::where('status', '1')
                        ->whereHas('primary_img', function($query){
                            $query->whereNotNull('primary_img');
                        });
        if (!empty($request->get('category'))) {
            $category = Category::where('slug', $request->get('category'))->first();
            $query->with('categories')
                    ->whereHas('categories', function($query) use ($category){
                        $query->whereIn('categories.id', $category);
                    });
        }
        if (!empty($request->get('search'))){
            $query->where(function($query) use ($request){
                $query->where('product_name', 'like', '%'.$request->get('search').'%');
                $query->orWhere('subtitle', 'like', '%'.$request->get('search').'%');
                $query->orWhere('short_description', 'like', '%'.$request->get('search').'%');
                $query->orWhere('product_tags', 'like', '%'.$request->get('search').'%');
            });
        }

        $products = $query->paginate(18);
        $agent = new Agent();

        if ($request->get('origin_type') == 'ajax') {
            return $products;
        }
    	return view('shop')->with('products', $products)->with('agent', $agent);
    }

    public function product($slug)
    {
        //session(['cart' => array()]);
    	$product = Product::with(['product_attrs' => function($query){
                                $query->with('attribute');
                                $query->with(['product_options' => function($query){
                                    $query->with('attr_option');
                                }]);
                            }])
                            ->whereHas('primary_img', function($query){
                                $query->whereNotNull('primary_img');
                            })
                            ->where('status', '1')
                            ->where('slug', $slug)->first();

        if ($product) {
            $related = Product::whereHas('categories', function($query) use ($product){
                                    $categories = $product->categories->pluck('id')->toArray();
                                    $query->whereIn('categories.id', $categories);
                                })
                                ->whereHas('primary_img', function($query){
                                    $query->whereNotNull('primary_img');
                                })
                                ->where('status', '1')
                                ->inRandomOrder()
                                ->limit('10')->get()->all();

            return view('product')->with('product', $product)->with('related', $related);
        }else{
            return redirect('shop')->withErrors('SORRY !! Product Not Found');
        }
    }
}
