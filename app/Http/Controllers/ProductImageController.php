<?php

namespace App\Http\Controllers;

use Image;
use App\Product;
use App\Product_image;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function edit($id)
    {
    	$product = Product::find($id);
    	return view('admin/products/product_images')->with('product', $product);
    }

    public function update(Request $request)
    {
    	$product = Product::find($request->post('product_id'));

    	if(!empty($_FILES['product_img'])){
    		Product_image::where('product_id', $product->id)
    						->update(['primary_img' => false]);

    		$product_imgs 	= $_FILES['product_img'];

    		foreach ($product_imgs['tmp_name'] as $key => $tmp_name) {
    			if ($tmp_name != '') {
    				$_FILES['pr_img']['name'] 	= $product_imgs['name'][$key];
    				$_FILES['pr_img']['type'] 	= $product_imgs['type'][$key];
    				$_FILES['pr_img']['tmp_name']= $product_imgs['tmp_name'][$key];
    				$_FILES['pr_img']['error'] 	= $product_imgs['error'][$key];
    				$_FILES['pr_img']['size'] 	= $product_imgs['size'][$key];

    				$slug 	= 	substr($product->slug, 0, 50).
    							'-'.$product->id.'-'.time();

					$image_lg = '/app/product/'.$slug.'.jpg';
				    $img = Image::make($_FILES['pr_img']['tmp_name']);
				    $img->resize(1000, null, function ($constraint) { 
				        $constraint->aspectRatio();
				    });
				    $img->save(storage_path().$image_lg, 80, 'jpg');

			    	$image_md = '/app/product/md/'.$slug.'.jpg';
			        $img = Image::make($_FILES['pr_img']['tmp_name']);
			        $img->resize(500, null, function ($constraint) { 
			            $constraint->aspectRatio();
			        });
			        $img->save(storage_path().$image_md, 80, 'jpg');

			        $image_sm = '/app/product/sm/'.$slug.'.jpg';
				    $img = Image::make($_FILES['pr_img']['tmp_name']);
				    $img->resize(250, null, function ($constraint) { 
				        $constraint->aspectRatio();
				    });
				    $img->save(storage_path().$image_sm, 80, 'jpg');

				    Product_image::create([
				    	'product_id'	=>	$product->id,
				    	'image_lg'		=>	$image_lg,
				    	'image_md'		=>	$image_md,
				    	'image_sm'		=>	$image_sm,
				    	'title'			=>	$request->post('title'),
				    	'primary_img'	=>	false
				    ]);
    			} # endif
    		} # endforeach
    	} # endif -outer

        Product_image::where('product_id', $product->id)->update(['primary_img' => false]);
        Product_image::where('product_id', $product->id)->first()->update(['primary_img' => true]);

    	return redirect('admin/product/images/'.$product->id)
    				->withErrors('UPDATED !! Product images are successfully updated');
    }

    public function destroy($img_id)
    {
    	$image = Product_image::find($img_id);
    	Product_image::where('id', $img_id)->delete();
    	if (isset($image->primary_img) && $image->primary_img == '1') {
    		$product_image = Product_image::where('product_id', $image->product_id)
                                            ->first();

            if ($product_image) {
                $product_image->update(['primary_img' => true]);
            }
    	}
    	return redirect()->back()
    				->withErrors('DELETED !! Product image is successfully deleted');
    }

    public function primary($img_id)
    {
    	$image = Product_image::find($img_id);
    	Product_image::where('product_id', $image->product_id)
    					->update(['primary_img' => false]);
    	Product_image::where('id', $img_id)->update(['primary_img' => true]);

    	return redirect()->back()
    				->withErrors('SUCCESS !! Product primary image is successfully changed');
    }
}
