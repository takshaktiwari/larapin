<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Image;

class SliderController extends Controller
{
    public function index()
    {
        $this->authorize('slider_access');
    	$slides = Slider::orderBy('set_order', 'ASC')->get()->all();
    	return view('admin/slider/slides')->with('slides', $slides);
    }

    public function create()
    {
        $this->authorize('slider_create');
    	return view('admin/slider/slide_create');
    }

    public function store(Request $request)
    {
        $this->authorize('slider_create');
    	$request->validate([
    		'slide'		=>	'required|image',
    		'title'		=>	'nullable|max:250',
    		'caption'	=>	'nullable|max:250',
    		'set_order'	=>	'required|numeric',
    		'status'	=>	'required|numeric',
    	]);

    	$object = ['title'		=>	$request->post('title'),
    				'caption'	=>	$request->post('caption'),
    				'set_order'	=>	$request->post('set_order'),
    				'status'	=>	$request->post('status'),
                    'url_link'  =>  $request->post('url_link'),
                    'url_text'  =>  $request->post('url_text') ];

    	$slug = time();
		$image_lg = '/app/slider/'.$slug.'.jpg';
	    $img = Image::make($_FILES['slide']['tmp_name']);
	    $img->resize(1500, null, function ($constraint) { 
	        $constraint->aspectRatio();
	    });
	    $img->save(storage_path().$image_lg, 95, 'jpg');

    	$image_md = '/app/slider/md/'.$slug.'.jpg';
        $img = Image::make($_FILES['slide']['tmp_name']);
        $img->resize(1000, null, function ($constraint) { 
            $constraint->aspectRatio();
        });
        $img->save(storage_path().$image_md, 95, 'jpg');

        $image_sm = '/app/slider/sm/'.$slug.'.jpg';
	    $img = Image::make($_FILES['slide']['tmp_name']);
	    $img->resize(500, null, function ($constraint) { 
	        $constraint->aspectRatio();
	    });
	    $img->save(storage_path().$image_sm, 95, 'jpg');

	    $arr = ['image_lg'	=>	$image_lg,
				'image_md'	=>	$image_md,
				'image_sm'	=>	$image_sm];
		$object = array_merge($object, $arr);

		Slider::create($object);
		return redirect('admin/slider')->withErrors('CREATED !! New slide is successfully created');
    }

    public function edit($id)
    {
        $this->authorize('slider_update');
    	$slide = Slider::find($id);
    	return view('admin/slider/slide_edit')->with('slide', $slide);
    }

    public function update(Request $request)
    {
        $this->authorize('slider_update');
    	$request->validate([
    		'slide'		=>	'nullable|image',
    		'title'		=>	'nullable|max:250',
    		'caption'	=>	'nullable|max:250',
    		'set_order'	=>	'required|numeric',
    		'status'	=>	'required|numeric',
    	]);

    	$object = ['title'		=>	$request->post('title'),
    				'caption'	=>	$request->post('caption'),
    				'set_order'	=>	$request->post('set_order'),
    				'status'	=>	$request->post('status'),
                    'url_link'  =>  $request->post('url_link'),
                    'url_text'  =>  $request->post('url_text') ];

    	if (!empty($_FILES['slide']['tmp_name'])) {
	    	$slug = time();
			$image_lg = '/app/slider/'.$slug.'.jpg';
		    $img = Image::make($_FILES['slide']['tmp_name']);
		    $img->resize(1500, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_lg, 80, 'jpg');

	    	$image_md = '/app/slider/md/'.$slug.'.jpg';
	        $img = Image::make($_FILES['slide']['tmp_name']);
	        $img->resize(1000, null, function ($constraint) { 
	            $constraint->aspectRatio();
	        });
	        $img->save(storage_path().$image_md, 80, 'jpg');

	        $image_sm = '/app/slider/sm/'.$slug.'.jpg';
		    $img = Image::make($_FILES['slide']['tmp_name']);
		    $img->resize(500, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_sm, 80, 'jpg');

		    $arr = ['image_lg'	=>	$image_lg,
					'image_md'	=>	$image_md,
					'image_sm'	=>	$image_sm];
			$object = array_merge($object, $arr);
    	}
    	

		Slider::find($request->post('slide_id'))->update($object);
		return redirect('admin/slider')->withErrors('UPDATED !! Slide is successfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('slider_delete');
    	Slider::find($id)->delete();
    	return redirect('admin/slider')->withErrors('DELETED !! Slide is successfully deleted');
    }
}
