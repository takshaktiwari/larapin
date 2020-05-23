<?php

namespace App\Http\Controllers;

use Exception;
use App\Product;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('product_access');
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

        $products = $query->orderBY('id', 'DESC')->paginate(25);

        $categories = \App\Category::orderBy('category', 'ASC')->get()->all();
    	return view('admin/products/products')
                                ->with('products', $products)
                                ->with('categories', $categories);
    }

    public function upload()
    {
        return view('admin/products/upload');
    }

    public function upload_sample()
    {
        return \Storage::download('downloadable/product_import_sample.xlsx');
    }

    public function upload_do(Request $request)
    {
        #   storing file basepath is '/storage/app/'
        $ext = $request->file('import_file')->getClientOriginalExtension();
        $imported_file = $request->file('import_file')
                                    ->storeAs(
                                        'imports', 'import-'.time().'.'.$ext
                                    );

        try {
            set_time_limit(0);
            Excel::import(new ProductsImport, storage_path('app/'.$imported_file));
            return redirect('admin/products')->withErrors('SUCCESS !! Product List is successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    

    public function create()
    {
        $this->authorize('product_create');
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
        $this->authorize('product_create');
    	$request->validate([
    		'product_name'		=>	'required|max:250|unique:products,product_name',
    		'subtitle'			=>	'nullable|max:250',
    		'base_price'		=>	'required',
            'base_stock'        =>  'required|numeric',
    		'in_offer'			=>	'required|numeric',
            'featured'          =>  'required|numeric',
    		'status'			=>	'required|numeric',
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('product_name'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	$product = 	Product::create([
						'product_name'		=>	$request->post('product_name'),
						'subtitle'			=>	$request->post('subtitle'),
						'base_price'		=>	$request->post('base_price'),
                        'base_stock'        =>  $request->post('base_stock'),
						'brand_id'			=>	$request->post('brand_id'),
                        'in_offer'          =>  $request->post('in_offer'),
                        'featured'          =>  $request->post('featured'),
						'status'			=>	$request->post('status'),
						'short_description'	=>	$request->post('short_description'),
						'product_tags'		=>	$request->post('product_tags'),
						'slug'				=>	$slug
					]);

        $product->categories()->sync($request->post('categories'));
    	
    	\App\Product_detail::create(['product_id' => $product->id]);
        \App\Discount_product::create(['product_id' => $product->id]);

    	return redirect('admin/product/details/'.$product->id)
    				->withErrors('CREATED !! New Product '.$request->post('product_name').' is successfully created. Please uodate other product informations.');
    }

    public function edit($id)
    {
        $this->authorize('product_update_info');
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
        $this->authorize('product_update_info');
        $request->validate([
            'product_name'      =>  'required|max:250',
            'subtitle'          =>  'nullable|max:250',
            'base_price'        =>  'required',
            'base_stock'        =>  'nullable|numeric',
            'in_offer'          =>  'required|numeric',
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
                        'base_stock'        =>  $request->post('base_stock'),
                        'brand_id'          =>  $request->post('brand_id'),
                        'in_offer'          =>  $request->post('in_offer'),
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

    public function destroy($id)
    {
        $this->authorize('product_delete');
        $product = Product::find($id);

        if ($product) {
            foreach ($product->images as $image) {
                if (file_exists(base_path('storage'.$image->image_sm))) {
                    //unlink(base_path('storage'.$image->image_sm));
                }
                if (file_exists(base_path('storage'.$image->image_md))) {
                    //unlink(base_path('storage'.$image->image_md));
                }
                if (file_exists(base_path('storage'.$image->image_lg))) {
                    //unlink(base_path('storage'.$image->image_lg));
                }
            }

            Product::where('id', $product->id)->delete();
            Product_detail::where('product_id', $product->id)->delete();
            Product_image::where('product_id', $product->id)->delete();
            Product_attr::where('product_id', $product->id)->delete();
            Product_option::where('product_id', $product->id)->delete();
            Product_image::where('product_id', $product->id)->delete();
            Product_review::where('product_id', $product->id)->delete();

            return redirect()->back()->withErrors('DELETED !! Product is successfully deleted');
        }else{
            return redirect()->back()->withErrors('ERROR !! Product not found');
        }
    }
}
