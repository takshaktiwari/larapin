<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::orderBY('id', 'DESC')->paginate(25);
    	return view('admin/products/products')->with('products', $products);
    }

    public function create()
    {
    	$categories = \App\Category::whereNull('parent')
    								->with('child_categories')
    								->get()->all();
        $brands = \App\Brand::orderBy('brand', 'ASC')->get()->all();
    	return view('admin/products/product_create')
                                ->with('categories', $categories)
                                ->with('brands', $brands);
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'product_name'		=>	'required|max:250|unique:products,product_name',
    		'subtitle'			=>	'nullable|max:250',
    		'base_price'		=>	'required',
    		'base_discount'		=>	'nullable',
            'base_stock'        =>  'required|numeric',
    		'featured'			=>	'required|numeric',
    		'status'			=>	'required|numeric',
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('product_name'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	$product = 	Product::create([
						'product_name'		=>	$request->post('product_name'),
						'subtitle'			=>	$request->post('subtitle'),
						'base_price'		=>	$request->post('base_price'),
						'base_discount'		=>	$request->post('base_discount'),
                        'base_stock'        =>  $request->post('base_stock'),
						'brand_id'			=>	$request->post('brand_id'),
                        'featured'          =>  $request->post('featured'),
						'status'			=>	$request->post('status'),
						'short_description'	=>	$request->post('short_description'),
						'product_tags'		=>	$request->post('product_tags'),
						'slug'				=>	$slug
					]);

        $product->categories()->sync($request->post('categories'));
    	
    	\App\Product_detail::create(['product_id' => $product->id]);

    	return redirect('admin/product/details/'.$product->id)
    				->withErrors('CREATED !! New Product '.$request->post('product_name').' is successfully created. Please uodate other product informations.');
    }

    public function edit($id)
    {
    	$product = Product::find($id);
        $brands = \App\Brand::orderBy('brand', 'ASC')->get()->all();
    	$categories = \App\Category::whereNull('parent')
    								->with('child_categories')
    								->get()->all();
    	return view('admin/products/product_info')
    				->with('product', $product)
                    ->with('brands', $brands)
    				->with('categories', $categories);
    }

    public function info_update(Request $request)
    {
        $request->validate([
            'product_name'      =>  'required|max:250',
            'subtitle'          =>  'nullable|max:250',
            'base_price'        =>  'required',
            'base_discount'     =>  'nullable',
            'base_stock'        =>  'nullable|numeric',
            'featured'          =>  'required|numeric',
            'status'            =>  'required|numeric',
        ]);



        $slug = str_replace(' ', '-', strtolower(trim($request->post('product_name'))));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        Product::where('id', $request->post('product_id'))
                    ->update([
                        'product_name'      =>  $request->post('product_name'),
                        'subtitle'          =>  $request->post('subtitle'),
                        'base_price'        =>  $request->post('base_price'),
                        'base_discount'     =>  $request->post('base_discount'),
                        'base_stock'        =>  $request->post('base_stock'),
                        'brand_id'          =>  $request->post('brand_id'),
                        'featured'          =>  $request->post('featured'),
                        'status'            =>  $request->post('status'),
                        'short_description' =>  $request->post('short_description'),
                        'product_tags'      =>  $request->post('product_tags'),
                        'slug'              =>  $slug
                    ]);
        
        $product = Product::find($request->post('product_id'));
        $product->categories()->sync($request->post('categories'));

        if (empty($product->details)) {
            \App\Product_detail::create(['product_id' => $product->id]);
        }

        return redirect('admin/product/details/'.$product->id)
                    ->withErrors('UPDATED !! Product '.$request->post('product_name').' is successfully updated. Please update other informations.');
    }
}
