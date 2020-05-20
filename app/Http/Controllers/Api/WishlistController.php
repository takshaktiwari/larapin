<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Product;
use App\Wishlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\WhishlistResource;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
    	$validation = validator($request->all(), [
    	                'product_id'    =>  'required|numeric',
    	            ]);
    	if ($validation->fails()) {
    	    return $validation->errors();
    	}else{
    		$product_id = $request->input('product_id');
	    	if ($product_id) {
	    		$product = Product::find($product_id);
	    		
	    		if ($product) {
			    	$query = Wishlist::where('user_id', Auth::user()->id)
					    				->where('product_id', $product_id)
					    				->count();
					if (!$query) {
						Wishlist::create([
							'user_id'	=>	Auth::user()->id,
							'product_id'=>	$product_id
						]);

						$msg = 'SUCCESS !! Product is added to Wishlist';
					}else{
						$msg = 'SUCCESS !! Product is already added to Wishlist';
					}
	    		}else{
	    			$msg = 'ERROR !! Product does not exists';
	    		}
	    	}else{
	    		$msg = 'ERROR !! Product does not exists';
	    	}
	    	
	    	return response()->json(['data' => ['msg' => $msg]]);
    	}
    }

    public function wishlist(Request $request)
    {
    	$items = Wishlist::where('user_id', Auth::user()->id)->paginate(25);
    	return WhishlistResource::collection($items);
    }

    public function destroy(Request $request)
    {
    	$validation = validator($request->all(), [
    	                'id'    =>  'required|numeric',
    	            ]);
    	if ($validation->fails()) {
    	    return $validation->errors();
    	}else{
    		$item = Wishlist::find($request->input('id'));

    		if ($item) {
    			$item->delete();
    			$msg = 'Product is successfully removed from your wishlist';
    		}else{
    			$msg = 'Product is already removed from wishlist Or not found in your wishlist';
    		}

    		return response()->json(['data' => ['msg' => $msg]]);
    	}
    }
}
