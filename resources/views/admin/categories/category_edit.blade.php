@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="page-title-box">
            <h4 class="font-size-22 float-left mr-2">Category Create</h4>
            <a href="{{ url('admin/categories') }}" class="btn btn-primary">All Lists</a>
        </div>
        
        <div class="row">
        	<div class="col-md-7">
        		<div class="card">
        			<div class="card-body">
        				<form action="{{ url('admin/category/create') }}" method="POST" enctype="multipart/form-data">
        				    @csrf
        				    <div class="row">
        				    	<div class="col-md-5">
        				    		<img src="{{ url('storage/'.$category->image_sm) }}" alt="" style="max-height: 70px;">
        				    	</div>
        				    	<div class="col-md-7">
        				    		<div class="form-group">
        				    		    <label for="">Select Image </label>
        				    		    <input type="file" name="image_file" class="form-control">
        				    		</div>
        				    	</div>
        				    </div>
        				    
        				    <div class="form-group">
        				        <label for="">Category <span class="text-danger">*</span></label>
        				        <input type="text" name="category" id="category" required="" class="form-control" placeholder="Category name" value="{{ $category->category }}">
        				    </div>
        				    <div class="form-group">
        				        <label for="">Parent Category </label>
        				        <select name="parent" class="form-control" >
        				            <option value="">-- Select --</option>
        				            @foreach($categories as $cat)
        				                <option value="{{ $cat->id }}" {{ selected($cat->id, $category->parent) }} >
        				                    {{ $cat->category }}
        				                </option>
        				            @endforeach
        				        </select>
        				    </div>
        				    
        				    <div class="row">
        				        <div class="col-md-6">
        				            <div class="form-group">
        				                <label for="">Featured <span class="text-danger">*</span></label>
        				                <select name="featured" class="form-control" required>
        				                    <option value="0" {{ selected($category->featured, '0') }} >No</option>
        				                    <option value="1" {{ selected($category->featured, '1') }} >Yes</option>
        				                </select>
        				            </div>
        				        </div>
        				        <div class="col-md-6">
        				            <div class="form-group">
        				                <label for="">Status <span class="text-danger">*</span></label>
        				                <select name="status" class="form-control" required>
        				                    <option value="1" {{ selected($category->status, '1') }} >Active</option>
        				                    <option value="0" {{ selected($category->status, '0') }} >In-Active</option>
        				                </select>
        				            </div>
        				        </div>
        				    </div>

        				    <div class="form-group">
        				        <label for="">Meta title </label>
        				        <textarea name="m_title" rows="2" class="form-control meta_field" maxlength="250">{{ $category->m_title }}</textarea>
        				    </div>
        				    <div class="form-group">
        				        <label for="">Meta Keywords </label>
        				        <textarea name="m_keywords" rows="2" class="form-control meta_field" maxlength="250">{{ $category->m_keywords }}</textarea>
        				    </div>
        				    <div class="form-group">
        				        <label for="">Meta Description </label>
        				        <textarea name="m_description" rows="2" class="form-control meta_field" maxlength="250">{{ $category->m_description }}</textarea>
        				    </div>
        				    <input type="hidden" name="category_id" value="{{ $category->id }}">
        				    <input type="submit" class="btn btn-dark px-4">
        				</form>
        			</div>
        		</div>
			</div>
		</div>


    </div> <!-- container-fluid -->
@endsection