<?php

namespace App\Http\Controllers;

use Image;
use App\Category;
use App\Country;
use App\State;
use App\District;
use App\Pincode;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function front_index()
    {
        $categories = Category::with('parent_category')->paginate(25);
        return view('categories')->with('categories', $categories);
    }


    public function index($value='')
    {
        $this->authorize('category_access');
    	$categories = Category::with('parent_category')->paginate(25);
    	return view('admin/categories/categories')->with('categories', $categories);
    }

    public function create()
    {
        $this->authorize('category_create');
    	$categories  = Category::get()->all();
    	return view('admin/categories/category_create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        
    	$data = $request->all();

    	if (!isset($data['category_id'])) {
    		$request->validate([
    			'category'	=>	'required|unique:categories,category'
    		]);
    	}

    	$slug = str_replace(' ', '-', strtolower(trim($data['category'])));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	$object = [	'category'		=>	$data['category'],
    				'slug'			=>	$slug,
    				'parent'		=>	$data['parent'],
    				'm_title'		=>	$data['m_title'],
    				'm_keywords'	=>	$data['m_keywords'],
    				'm_description'	=>	$data['m_description'],
    				'featured'		=>	$data['featured'],
    				'status'		=>	$data['status'],
    			];

    	if ($_FILES['image_file']['tmp_name'] != '') {
			$image_lg = '/app/category/'.$slug.'.jpg';
		    $img = Image::make($_FILES['image_file']['tmp_name']);
		    $img->resize(1000, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_lg, 80, 'jpg');

	    	$image_md = '/app/category/md/'.$slug.'.jpg';
	        $img = Image::make($_FILES['image_file']['tmp_name']);
	        $img->resize(500, null, function ($constraint) { 
	            $constraint->aspectRatio();
	        });
	        $img->save(storage_path().$image_md, 80, 'jpg');

	        $image_sm = '/app/category/sm/'.$slug.'.jpg';
		    $img = Image::make($_FILES['image_file']['tmp_name']);
		    $img->resize(200, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_sm, 80, 'jpg');

		    $arr = ['image_lg'	=>	$image_lg,
					'image_md'	=>	$image_md,
					'image_sm'	=>	$image_sm];
			$object = array_merge($object, $arr);
    	}

    	if (isset($data['category_id'])) {
            $this->authorize('category_update');
    		Category::where('id', $data['category_id'])->update($object);
    		$msg = 'SUCCESS !! Category is successfully updated';
    	}else{
            $this->authorize('category_create');
    		Category::create($object);
    		$msg = 'SUCCESS !! Category is successfully updated';
    	}

        return redirect('admin/categories')->withErrors($msg);
    }

    public function edit($id)
    {
        $this->authorize('category_update');
        $category = Category::find($id);
        $categories = Category::with('parent_category')->get()->all();
        return view('admin/categories/category_edit')
                                ->with('category', $category)
                                ->with('categories', $categories);
    }

    public function countries($id)
    {
        $this->authorize('category_location');
        $countries = Country::get()->all();
        $category = Category::find($id);

        return view('admin/categories/category_countries')
                                ->with('countries', $countries)
                                ->with('category', $category);
    }

    public function countries_update(Request $request)
    {
        $this->authorize('category_location');
        $category = Category::find($request->input('category_id'));
        $category->countries()->sync($request->input('countries'));

        #   ataching the check tree
        $countries = Country::whereIn('id', $request->input('countries'))->get()->all();
        foreach ($countries as $country) {
            $category->states()->attach($country->states->pluck('id')->toArray());
            $category->districts()->attach($country->districts->pluck('id')->toArray());
            $category->pincodes()->attach($country->pincodes->pluck('id')->toArray());
        }

        #detaching the unchecked tree
        $countries = Country::whereNotIn('id', $request->input('countries'))->get()->all();
        foreach ($countries as $country) {
            $category->states()->detach($country->states->pluck('id')->toArray());
            $category->districts()->detach($country->districts->pluck('id')->toArray());
            $category->pincodes()->detach($country->pincodes->pluck('id')->toArray());
        }

        return redirect()->back()
                    ->withErrors('SUCCESS !! Category is updated for given countries');
    }

    public function states($id, Request $request)
    {
        $this->authorize('category_location');
        $country = Country::find($request->input('country_id'));
        $states = State::where('country_id', $request->input('country_id'))->get()->all();
        $category = Category::find($id);

        return view('admin/categories/category_states')
                                ->with('country', $country)
                                ->with('states', $states)
                                ->with('category', $category);
    }

    public function states_update(Request $request)
    {
        $this->authorize('category_location');
        $category = Category::find($request->input('category_id'));
        $category->states()->attach($request->input('states'));

        #   ataching the check tree
        $states = State::whereIn('id', $request->input('states'))->get()->all();
        foreach ($states as $state) {
            $category->districts()->attach($state->districts->pluck('id')->toArray());
            $category->pincodes()->attach($state->pincodes->pluck('id')->toArray());
        }

        #detaching the unchecked tree
        $states = State::whereNotIn('id', $request->input('states'))
                        ->where('country_id', $request->input('country_id'))
                        ->get()->all();
        foreach ($states as $state) {
            $category->states()->detach($state->id);
            $category->districts()->detach($state->districts->pluck('id')->toArray());
            $category->pincodes()->detach($state->pincodes->pluck('id')->toArray());
        }

        return redirect()->back()
                    ->withErrors('SUCCESS !! Category is updated for given states');
    }

    public function districts($id, Request $request)
    {
        $this->authorize('category_location');
        $state = State::find($request->input('state_id'));
        $country = Country::find($state->country_id);
        $districts = District::where('state_id', $request->input('state_id'))->get()->all();
        $category = Category::find($id);

        return view('admin/categories/category_districts')
                                ->with('state', $state)
                                ->with('country', $country)
                                ->with('districts', $districts)
                                ->with('category', $category);
    }

    public function districts_update(Request $request)
    {
        $this->authorize('category_location');
        $category = Category::find($request->input('category_id'));
        $category->districts()->attach($request->input('districts'));
        
        #   ataching the check tree
        $districts = District::whereIn('id', $request->input('districts'))->get()->all();
        foreach ($districts as $district) {
            $category->pincodes()->attach($district->pincodes->pluck('id')->toArray());
        }

        #detaching the unchecked tree
        $districts = District::whereNotIn('id', $request->input('districts'))
                                ->where('state_id', $request->input('state_id'))
                                ->get()->all();
        foreach ($districts as $district) {
            $category->districts()->detach($district->id);
            $category->pincodes()->detach($district->pincodes->pluck('id')->toArray());
        }
        
        return redirect()->back()
                    ->withErrors('SUCCESS !! Category is updated for given districts');
    }

    public function pincodes($id, Request $request)
    {
        $this->authorize('category_location');
        $district = District::find($request->input('district_id'));
        $state = State::find($district->state_id);
        $country = Country::find($district->country_id);
        $pincodes = Pincode::where('district_id', $request->input('district_id'))->get()->all();
        $category = Category::find($id);

        return view('admin/categories/category_pincodes')
                                ->with('district', $district)
                                ->with('state', $state)
                                ->with('country', $country)
                                ->with('pincodes', $pincodes)
                                ->with('category', $category);
    }

    public function pincodes_update(Request $request)
    {
        $this->authorize('category_location');
        $category = Category::find($request->input('category_id'));
        $category->pincodes()->attach($request->input('pincodes'));

        #detaching the unchecked tree
        $pincodes = Pincode::whereNotIn('id', $request->input('pincodes'))
                                ->where('district_id', $request->input('district_id'))
                                ->get()->all();
        foreach ($pincodes as $pincode) {
            $category->pincodes()->detach($pincode->id);
        }

        return redirect()->back()
                    ->withErrors('SUCCESS !! Category is updated for given pincodes');
    }



    public function attributes($id)
    {
        $this->authorize('category_attributes');
        $attributes = \App\Attribute::withCount('attr_options')
                                    ->with('attr_options')
                                    ->get()->all();
        $category   = Category::with('attributes')->find($id);
        return view('admin/categories/category_attributes')
                                ->with('attributes', $attributes)
                                ->with('category', $category);
    }

    public function attributes_update(Request $request)
    {
        $this->authorize('category_attributes_update');
        $category = Category::find($request->post('category_id'));
        $category->attributes()->sync($request->post('attributes'));
        return redirect('admin/categories')->withErrors('UPDATED !! Category Attributes are successfully updated');
    }



}
