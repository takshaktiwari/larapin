<?php

namespace App\Http\Controllers;

use Image;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
    	$pages = Page::orderBy('title', 'ASC')->get()->all();
    	return view('admin/pages/pages')->with('pages', $pages);
    }

    public function create()
    {
    	return view('admin/pages/page_create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'title'			=>	'required|max:250|unique:pages,title',
    		'm_title'  		=>	'nullable|max:250',
    		'm_keywords'  	=>	'nullable|max:250',
    		'm_description' =>	'nullable|max:250'
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('title'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	$object = [ 'title'			=>	$request->post('title'),
    				'content'		=>	$request->post('content'),
    				'slug'			=>	$slug,
    				'm_title'		=>	$request->post('m_title'),
    				'm_keywords'	=>	$request->post('m_keywords'),
    				'm_description'	=>	$request->post('m_description') ];

    	if (isset($_FILES['feat_img']['tmp_name']) != '') {
			$image_lg = '/app/pages/'.$slug.'.jpg';
		    $img = Image::make($_FILES['feat_img']['tmp_name']);
		    $img->resize(1000, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_lg, 80, 'jpg');

	    	$image_md = '/app/pages/md/'.$slug.'.jpg';
	        $img = Image::make($_FILES['feat_img']['tmp_name']);
	        $img->resize(500, null, function ($constraint) { 
	            $constraint->aspectRatio();
	        });
	        $img->save(storage_path().$image_md, 80, 'jpg');

	        $image_sm = '/app/pages/sm/'.$slug.'.jpg';
		    $img = Image::make($_FILES['feat_img']['tmp_name']);
		    $img->resize(200, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_sm, 80, 'jpg');

		    $arr = ['image_lg'	=>	$image_lg,
					'image_md'	=>	$image_md,
					'image_sm'	=>	$image_sm];
			$object = array_merge($object, $arr);
    	}
    	
    	Page::create($object);
    	return redirect('admin/pages')->withErrors('CREATED !! New page is successfully created');
    }

    public function edit($id)
    {
    	$page = Page::find($id);
    	return view('admin/pages/page_edit')->with('page', $page);
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'title'			=>	'required|max:250',
    		'm_title'  		=>	'nullable|max:250',
    		'm_keywords'  	=>	'nullable|max:250',
    		'm_description' =>	'nullable|max:250'
    	]);

    	$slug = str_replace(' ', '-', strtolower(trim($request->post('title'))));
    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    	$object = [ 'title'			=>	$request->post('title'),
    				'content'		=>	$request->post('content'),
    				'slug'			=>	$slug,
    				'm_title'		=>	$request->post('m_title'),
    				'm_keywords'	=>	$request->post('m_keywords'),
    				'm_description'	=>	$request->post('m_description') ];

    	if ($_FILES['feat_img']['tmp_name'] != '') {
			$image_lg = '/app/pages/'.$slug.'.jpg';
		    $img = Image::make($_FILES['feat_img']['tmp_name']);
		    $img->resize(1000, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_lg, 80, 'jpg');

	    	$image_md = '/app/pages/md/'.$slug.'.jpg';
	        $img = Image::make($_FILES['feat_img']['tmp_name']);
	        $img->resize(500, null, function ($constraint) { 
	            $constraint->aspectRatio();
	        });
	        $img->save(storage_path().$image_md, 80, 'jpg');

	        $image_sm = '/app/pages/sm/'.$slug.'.jpg';
		    $img = Image::make($_FILES['feat_img']['tmp_name']);
		    $img->resize(200, null, function ($constraint) { 
		        $constraint->aspectRatio();
		    });
		    $img->save(storage_path().$image_sm, 80, 'jpg');

		    $arr = ['image_lg'	=>	$image_lg,
					'image_md'	=>	$image_md,
					'image_sm'	=>	$image_sm];
			$object = array_merge($object, $arr);
    	}
    	
    	Page::find($request->post('page_id'))->update($object);
    	return redirect('admin/pages')->withErrors('UPDATED !! Page is successfully updated');
    }

    public function destroy($id)
    {
    	Page::find($id)->delete();
    	return redirect('admin/pages')->withErrors('DELETED !! Page is successfully deleted');
    }
}
