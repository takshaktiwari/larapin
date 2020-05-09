@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Coupons</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Coupons</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/coupon/create') }}" class="btn btn-primary">+ Create New</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<table id="datatable" class="table table-bordered">
				    <thead>
					    <tr>
					        <th>#</th>
					        <th>Coupon</th>
					        <th>Discount (%)</th>
					        <th>Discount <span class="small">(Amt)</span></th>
					        <th>Purchase <span class="small">(Min Amt)</span></th>
					        <th>Expires At</th>
					        <th>Status</th>
					        <th>Action</th>
					    </tr>
				    </thead>
				    <tbody>
					    @foreach($coupons as $key => $coupon)
					        <tr>
					        	<td>{{ $key+1 }}</td>
					            <td>{{ $coupon->coupon }}</td>
					            <td>
					            	@if(!empty($coupon->percent))
						            	{{ $coupon->percent }}
						            	<i class="fas fa-percent"></i>
					            	@endif
					            </td>
					            <td>
					            	@if(!empty($coupon->amount))
						            	<i class="fas fa-rupee-sign"></i>
						            	{{ $coupon->amount }}
					            	@endif
					            </td>
					            <td>
					            	@if(!empty($coupon->min_purchase))
						            	<i class="fas fa-rupee-sign"></i>
						            	{{ $coupon->min_purchase }}
					            	@endif
					            </td>
					            <td>
					            	@if(!empty($coupon->expires_at))
					            		{{ date('d-M-Y h:i A', strtotime($coupon->expires_at)) }}
					            	@endif
					            </td>
					            <td>
					            	@if($coupon->status == '1')
					            		Active
					            	@elseif($coupon->status == '0')
					            		In-Active
					            	@endif
					            </td>
					            <td class="font-size-20">
					            	<a href="{{ url('admin/coupon/show/'.$coupon->id) }}" class="btn btn-sm btn-info" title="Edit this">
					            	    <i class="fas fa-eye"></i>
					            	</a>

				                    <a href="{{ url('admin/coupon/edit/'.$coupon->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>

				                    <a href="{{ url('admin/coupon/delete/'.$coupon->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $coupons->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
