@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="page-title-box">
            <h4 class="font-size-22 float-left mr-2">Category Create</h4>
            <a href="{{ url('admin/categories') }}" class="btn btn-primary">All Lists</a>
        </div>
        
        <div class="row">
        	<div class="col-md-7">
				<form action="{{ url('admin/category/create') }}" method="POST" enctype="multipart/form-data" class="bg-white p-sm-5 p-4 shadow-sm mb-5">
				    @csrf
				    <div class="form-group">
				        <label for="">Select Image <span class="text-danger">*</span></label>
				        <input type="file" name="image_file" required="" class="form-control">
				    </div>
				    <div class="form-group">
				        <label for="">Category <span class="text-danger">*</span></label>
				        <input type="text" name="category" id="category" required="" class="form-control" placeholder="Category name">
				    </div>

				    <div class="form-group">
				        <label for="">Parent Category </label>
				        <select name="parent" class="form-control" >
				            <option value="">-- Select --</option>
				            @foreach($categories as $category)
				                <option value="{{ $category->id }}">
				                    {{ $category->category }}
				                </option>
				            @endforeach
				        </select>
				    </div>
				    
				    <div class="row">
				        <div class="col-md-6">
				            <div class="form-group">
				                <label for="">Featured <span class="text-danger">*</span></label>
				                <select name="featured" class="form-control" required>
				                    <option value="0">No</option>
				                    <option value="1">Yes</option>
				                </select>
				            </div>
				        </div>
				        <div class="col-md-6">
				            <div class="form-group">
				                <label for="">Status <span class="text-danger">*</span></label>
				                <select name="status" class="form-control" required>
				                    <option value="1">Active</option>
				                    <option value="0">In-Active</option>
				                </select>
				            </div>
				        </div>
				    </div>

				    <div class="form-group">
				        <label for="">Meta title </label>
				        <textarea name="m_title" rows="2" class="form-control meta_field" maxlength="250"></textarea>
				    </div>
				    <div class="form-group">
				        <label for="">Meta Keywords </label>
				        <textarea name="m_keywords" rows="2" class="form-control meta_field" maxlength="250"></textarea>
				    </div>
				    <div class="form-group">
				        <label for="">Meta Description </label>
				        <textarea name="m_description" rows="2" class="form-control meta_field" maxlength="250"></textarea>
				    </div>
				    <input type="submit" class="btn btn-dark px-4">
				</form>
			</div>
		</div>


    </div> <!-- container-fluid -->
@endsection