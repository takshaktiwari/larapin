<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add($product_id)
    {
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
    	
    	return redirect()->back()->withErrors($msg);
    }

    public function wishlist()
    {
    	$items = Wishlist::where('user_id', Auth::user()->id)->paginate(10);
    	return view('user/wishlist')->with('items', $items);
    }

    public function destroy($id)
    {
    	Wishlist::find($id)->delete();
    	return redirect()->back()->withErrors('REMOVED !! Product is successfuly removed from your wishlist');
    }
}
