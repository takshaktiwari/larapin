@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Permissions</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Permissions</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/permission/create') }}" class="btn btn-primary">+ Create New</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
		
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('admin/permission/create') }}" method="POST" class="bg-white p-sm-3 p-0">
						    @csrf
						    <div class="form-group">
						        <label for="">Permission <span class="text-danger">*</span></label>
						        <input type="text" name="name" required class="form-control">
						    </div>
						    <div class="form-group">
						        <label for="">Parent Permission</label>
						        <select name="parent" class="form-control" >
						            <option value="">-- Select --</option>
						            @foreach($permissions as $permission)
						                <option value="{{ $permission->id }}">
						                    {{ ucfirst($permission->title) }}
						                </option>
						            @endforeach
						        </select>
						    </div>
						    <div class="form-group">
						        <label for="">Title <span class="text-danger">*</span></label>
						        <input type="text" name="title" required class="form-control">
						    </div>
						    <div class="form-group">
						        <label for="">Hint </label>
						        <textarea name="hint" rows="3" class="form-control" placeholder="Hint for permission" ></textarea>
						    </div>
						    <div class="form-check ">
						        <label class="form-check-label ">
						            <input type="checkbox" class="form-check-input " name="resource" value="1">
						            Create all resources
						            <em class="small text-danger ml-1">
						                ( <b>_access,</b>
						                _create, _update, _show, _delete )
						            </em class="small text-danger">
						        </label>
						    </div>
						    <input type="submit" class="btn btn-dark px-4 mt-2">
						</form>

					</div>
				</div>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
