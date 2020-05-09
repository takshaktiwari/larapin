@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Edit Slide</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Slider</a>
    	                </li>
    	                <li class="breadcrumb-item active">Slides</li>
                        <li class="breadcrumb-item active">Edit</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/slider') }}" class="btn btn-primary">All Slides</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		
		<div class="row">
			<div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/slide/update') }}" method="POST" enctype="multipart/form-data" class="p-sm-3 p-0">
                            @csrf
                            <div class="d-flex">
                                <img src="{{ url('storage'.$slide->image_sm) }}" alt="" class="img-thumbnail" style="max-height: 70px;">
                                <div class="form-group ml-3">
                                    <label for="">Select Image <span class="text-danger">*</span></label>
                                    <input type="file" name="slide" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="">Title </label>
                                <input type="text" name="title" class="form-control" maxlength="250" value="{{ $slide->title }}">
                            </div>
                            <div class="form-group">
                                <label for="">Caption </label>
                                <textarea name="caption" rows="3" class="form-control" maxlength="250">{{ $slide->caption }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Set Order </label>
                                        <input type="number" name="set_order" class="form-control" value="{{ $slide->set_order }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" required class="form-control">
                                            <option value="1" {{ selected($slide->status, '1') }} >Active</option>
                                            <option value="0" {{ selected($slide->status, '0') }} >In-Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="slide_id" value="{{ $slide->id }}">
                            <input type="submit" class="btn btn-primary px-5">
                        </form>
                    </div>
                </div>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection