<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get_country_states(Request $request)
    {
    	return \App\State::where('country_id', $request->post('country_id'))
    							->get()->all();
    }

    public function get_state_districts(Request $request)
    {
        return \App\District::where('state_id', $request->post('state_id'))
                                ->get()->all();
    }

    public function get_district_pincodes(Request $request)
    {
    	return \App\Pincode::where('district_id', $request->post('district_id'))
    							->get()->all();
    }

    public function get_pincode_locations(Request $request)
    {
        return \App\Location::where('pincode_id', $request->post('pincode_id'))
                                ->get()->all();
    }

    public function product_add_attr_price(Request $request)
    {
        if ($request->input('pr_option_id')) {
            $pr_option = \App\Product_option::find($request->input('pr_option_id'));
            if ($pr_option) {

                return $request->input('base_price') + (int)$pr_option->price;
            }
        }
    }

    public function selected_product_action(Request $request)
    {
        if ($request->input('action') == 'delete') {
            $this->authorize('product_delete');

            $pr_images = \App\Product_image::whereIn('product_id', $request->input('products_ids'))
                                        ->get()->all();

            foreach ($pr_images as $image) {
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

            \App\Product::whereIn('id', $request->input('products_ids'))->delete();
            \App\Product_detail::whereIn('product_id', $request->input('products_ids'))->delete();
            \App\Product_image::whereIn('product_id', $request->input('products_ids'))->delete();
            \App\Product_attr::whereIn('product_id', $request->input('products_ids'))->delete();
            \App\Product_option::whereIn('product_id', $request->input('products_ids'))->delete();
            \App\Product_review::whereIn('product_id', $request->input('products_ids'))->delete();

        }elseif ($request->input('action') == 'in_active'){
            \App\Product::whereIn('id', $request->input('products_ids'))
                        ->update(['status' => false]);

        }elseif ($request->input('action') == 'active'){
            \App\Product::whereIn('id', $request->input('products_ids'))
                        ->update(['status' => true]);

        }elseif ($request->input('action') == 'featured'){
            \App\Product::whereIn('id', $request->input('products_ids'))
                        ->update(['featured' => true]);

        }elseif ($request->input('action') == 'not_featured'){
            \App\Product::whereIn('id', $request->input('products_ids'))
                        ->update(['featured' => false]);

        }elseif ($request->input('action') == 'in_offer'){
            \App\Product::whereIn('id', $request->input('products_ids'))
                        ->update(['in_offer' => true]);

        }elseif ($request->input('action') == 'not_in_offer'){
            \App\Product::whereIn('id', $request->input('products_ids'))
                        ->update(['in_offer' => false]);
        }

    }


}
