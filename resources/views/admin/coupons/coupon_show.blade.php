@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Coupon Details</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Coupons</a>
    	                </li>
    	                <li class="breadcrumb-item active">Detail</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/coupons') }}" class="btn btn-primary">All Coupons</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0 text-center">Coupon Details</h4>
                    </div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>Coupon Code :</td>
                                    <td>{{ $coupon->coupon }}</td>
                                </tr>
                                <tr>
                                    <td>Discount (%) :</td>
                                    <td>
                                        @if(!empty($coupon->percent))
                                            {{ $coupon->percent }}
                                            <i class="fas fa-percent"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Discount (Amt) :</td>
                                    <td>
                                        @if(!empty($coupon->amount))
                                            <i class="fas fa-rupee-sign"></i>
                                            {{ $coupon->amount }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Min. Purchase :</td>
                                    <td>
                                        @if(!empty($coupon->min_purchase))
                                            <i class="fas fa-rupee-sign"></i>
                                            {{ $coupon->min_purchase }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expires At :</td>
                                    <td>
                                        @if(!empty($coupon->expires_at))
                                            {{ date('d-M-Y h:i A', strtotime($coupon->expires_at)) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Satus :</td>
                                    <td>
                                        @if($coupon->status == '1')
                                            Active
                                        @elseif($coupon->status == '0')
                                            In-Active
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created At :</td>
                                    <td>{{ date('d-M-Y h:i A', strtotime($coupon->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center py-3">
                                        <a href="{{ url('admin/coupon/edit/'.$coupon->id) }}" class="btn btn-success rounded-sm px-4" title="Edit this">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>

                                        <a href="{{ url('admin/coupon/delete/'.$coupon->id) }}" class="btn btn-danger rounded-sm px-4" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0 text-center">Used By <span class="small">(Users)</span></h4>
                    </div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Used At</th>
                            </thead>
                            <tbody>
                                @foreach($coupon->users as $key => $user)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ date('d-M-Y h:i A', strtotime($user->pivot->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
			

    </div> <!-- container-fluid -->
@endsection