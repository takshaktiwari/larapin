@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Users</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Users</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/user/create') }}" class="btn btn-primary">+ Create New</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<table class="table table-bordered">
				    <thead>
					    <tr>
					        <th>#</th>
					        <th>Name</th>
					        <th>Email</th>
					        <th>Verified at</th>
					        <th>Created at</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($users as $key => $user)
					    	<tr>
					        	<td>{{ $key+1 }}</td>
					            <td> {{ $user->name }} </td>
					            <td> {{ $user->email }} </td>
					            <td> 
					            	{{ date('d-M-Y h:i A', strtotime($user->email_verified_at)) }} 
					            </td>
					            <td>
					            	{{ date('d-M-Y h:i A', strtotime($user->created_at)) }} 
					            </td>
					            <td class="font-size-20">
				                    <a href="{{ url('admin/user/edit/'.$user->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>

				                    <a href="{{ url('admin/user/delete/'.$user->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $users->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
