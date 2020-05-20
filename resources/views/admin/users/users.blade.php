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
    	        	@can('user_create')
    	            <a href="{{ url('admin/user/create') }}" class="btn btn-primary">+ Create New</a>
    	            @endcan
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
					        <th>Role</th>
					        <th>Verified at</th>
					        <th>Created at</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($users as $key => $user)
					    	<tr>
					        	<td>{{ $key+1 }}</td>
					            <td> 
					            	{{ $user->name }} 
					            	@can('user_token_show')
					            	@if(!empty($user->api_token))
					            		<div class="small text-success font-weight-bold" data-toggle="popover" title="API Token" data-content="{{ $user->api_token }}">
					            			api_token
					            		</div>
					            	@endif
					            	@endcan
					            </td>
					            <td>
					            	@if(!empty($user->role->role_name))
					            	<span class="badge badge-warning font-size-14 text-dark badge-pill">
					            		{{ $user->role->role_name }}
					            	</span>
					            	@endif
					            </td>
					            <td> 
					            	@if($user->email_verified_at != '')
					            		{{ date('d-M-Y h:i A', strtotime($user->email_verified_at)) }} 
					            	@else
					            		<span class="text-danger">Not Verified</span>
					            	@endif
					            	<div class="small">{{ $user->email }}</div>
					            </td>
					            <td>
					            	{{ date('d-M-Y h:i A', strtotime($user->created_at)) }} 
					            </td>
					            <td class="font-size-20">
					            	@can('user_token_update')
					            	<a href="{{ url('admin/user/generate_api_token/'.$user->id) }}" class="btn btn-sm btn-warning border" title="Regenerate Api Token" onclick="return confirm('Old API Token will be lost, are you sure to re-generate ?')">
					            	    <i class="fas fa-sync-alt"></i>
					            	</a>
					            	@endcan
					            	@can('user_update')
				                    <a href="{{ url('admin/user/edit/'.$user->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>
				                    @endcan
				                    @can('user_address_access')
									<a href="{{ url('admin/user/'.$user->id.'/addresses') }}" class="btn btn-sm btn-secondary" title="User Addresses">
									    <i class="fas fa-home"></i>
									</a>
									@endcan
									@can('user_delete')
				                    <a href="{{ url('admin/user/delete/'.$user->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
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

@section('scripts')
	@parent
	<script>
		$(document).ready(function($) {
			$('[data-toggle="popover"]').popover();
		});
	</script>
@endsection
