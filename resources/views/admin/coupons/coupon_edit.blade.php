@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Edit Coupon</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Coupons</a>
    	                </li>
    	                <li class="breadcrumb-item active">Edit</li>
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
                    <div class="card-body">
                        <form action="{{ url('admin/coupon/update') }}" method="POST" class="p-sm-3 p-0">
                            @csrf
                            <div class="form-group">
                                <label for="">Coupon Code <span class="text-danger">*</span></label>
                                <input type="text" name="coupon" required class="form-control" value="{{ $coupon->coupon }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Discount % </label>
                                        <input type="number" name="percent" id="percent" class="form-control"  placeholder="0%" value="{{ $coupon->percent }}" max="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Discount (Amount) </label>
                                        <input type="number" name="amount" id="amount" class="form-control "  placeholder="0.00" value="{{ $coupon->amount }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Min. Purchase </label>
                                        <input type="number" name="min_purchase" class="form-control"  placeholder="0.00"  value="{{ $coupon->min_purchase }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Expires At </label>
                                        <input type="datetime-local" name="expires_at" class="form-control"  value="{{ date('Y-m-d', strtotime($coupon->expires_at)).'T'.date('H:i', strtotime($coupon->expires_at)) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status </label>
                                        <select name="status" required class="form-control">
                                            <option value="1" {{ selected($coupon->status, '1') }} >Active</option>
                                            <option value="0" {{ selected($coupon->status, '0') }} >In-Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">
                            <input type="submit" class="btn btn-primary px-5">
                        </form>
                    </div>
                </div>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function($) {
            $("#percent").click(function(event) {
                $("#amount").val('');
            });
            $("#amount").click(function(event) {
                $("#percent").val('');
            });
        });
    </script>
@endsection