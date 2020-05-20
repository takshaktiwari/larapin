@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-9">
                <div class="page-title-box">
                    <h4 class="font-size-18">Category Districts</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                        	<a href="javascript: void(0);">Categories</a>
                        </li>
                        <li class="breadcrumb-item active">
                        	<a href="{{ url('admin/categories') }}">
                        		{{ $category->category }}
                        	</a>
                        </li>
                        <li class="breadcrumb-item">
                        	<a href="{{ url('admin/category/'.$category->id.'/countries') }}">
                    			{{ $country->country }}
                    		</a>
                    	</li>
                        <li class="breadcrumb-item">
                        	<a href="{{ url('admin/category/'.$category->id.'/states?country_id='.$country->id) }}">
                    			{{ $state->state }}
                    		</a>
                    	</li>
                        <li class="breadcrumb-item active">Districts</li>
                    </ol>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="float-right d-none d-md-block">
                    <a href="{{ url('admin/categories') }}" class="btn btn-primary">All Categories</a>
                </div>
            </div>
        </div>
        

		<div class="card">
			<div class="card-body table-responsive">
				<form action="{{ url('admin/category/districts/update') }}" method="POST">
					@csrf
					@php
						$cat_districts = $category->districts->pluck('id')->toArray();
					@endphp
					@foreach($districts as $district)
						<li class="list-group-item d-flex">
							<div class="custom-control custom-checkbox flex-fill">
							    <input 	type="checkbox" 
							    		class="custom-control-input" 
							    		id="country_{{ $district->id }}" 
							    		name="districts[]" 
							    		value="{{ $district->id }}"
							    		{{ checked($cat_districts, $district->id, TRUE) }}>

							    <label 	class="custom-control-label" 
							    		for="country_{{ $district->id }}">
							    	{{ $district->district }}
							    </label>
							</div>

							@if(checked($cat_districts, $district->id, TRUE))
							<a href="{{ url('admin/category/'.$category->id.'/pincodes?district_id='.$district->id) }}" class="btn btn-sm btn-success">
								Next
								<i class="fas fa-angle-right"></i>
							</a>
							@endif
						</li>
					@endforeach
					<li class="list-group-item">
						<input type="hidden" name="category_id" value="{{ $category->id }}">
						<input type="hidden" name="state_id" value="{{ $state->id }}">
						<input type="submit" class="btn btn-primary px-4">
					</li>
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
