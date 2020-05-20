@extends('layouts.admin')

@section('styles')
	@parent
	<style>
		.tox-notifications-container{
			display: none;
		}
	</style>
@endsection

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Edit Page</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Pages</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	                <li class="breadcrumb-item active">Edit Page</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/pages') }}" class="btn btn-primary">All Pages</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<form action="{{ url('admin/page/update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-7">
							<div class="form-group">
							    <label for="">Page Title <span class="text-danger">*</span></label>
							    <input type="text" name="title" required class="form-control" value="{{ $page->title }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							    <label for="">Featured </label>
							    <input type="file" name="feat_img" class="form-control">
							</div>
						</div>
						<div class="col-md-2">
							<img src="{{ url('storage'.$page->image_sm) }}" alt="" class="img-thumbnail" style="max-height:80px;">
						</div>
					</div>
					<div class="form-group">
					    <label for="">Page Content </label>
					    <textarea name="content" rows="10" class="form-control text-editor">{{ $page->content }}</textarea>
					</div>
					<div class="form-group">
						<label for="">Status <span class="text-danger">*</span></label>
						<select name="status" class="form-control">
							<option value="1">Active</option>
							<option value="0">In-Active</option>
						</select>
					</div>
					
					<div class="form-group">
					    <label for="">Meta Title </label>
					    <textarea name="m_title" rows="2" class="form-control" maxlength="250">{{ $page->m_title }}</textarea>
					</div>
					<div class="form-group">
					    <label for="">Meta Keywords </label>
					    <textarea name="m_keywords" rows="2" class="form-control" maxlength="250">{{ $page->m_keywords }}</textarea>
					</div>
					<div class="form-group">
					    <label for="">Meta Description </label>
					    <textarea name="m_description" rows="2" class="form-control" maxlength="250">{{ $page->m_description }}</textarea>
					</div>
					<input type="hidden" name="page_id" value="{{ $page->id }}">
					<input type="submit" class="btn btn-lg btn-primary rounded-sm px-4">
				</form>

			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection

@section('scripts')
	@parent
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
      	tinymce.init({
        	selector: '.text-editor',
        	plugins: 'print preview paste importcss searchreplace autolink autosave directionality code visualblocks visualchars fullscreen image link codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
        	imagetools_cors_hosts: ['picsum.photos'],
        	menubar: 'file edit view insert format tools table help',
        	toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview print | insertfile image link codesample',
        	toolbar_sticky: true,
        	autosave_ask_before_unload: true,
        	height: 400,
  			toolbar_mode: 'sliding',
      	});
    </script>
@endsection
