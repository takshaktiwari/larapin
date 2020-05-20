@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-9">
                <div class="page-title-box">
                    <h4 class="font-size-18">Category Pincodes</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                        	<a href="{{ url('admin/categories') }}">Categories</a>
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
                        <li class="breadcrumb-item">
                        	<a href="{{ url('admin/category/'.$category->id.'/districts?state_id='.$state->id) }}">
                    			{{ $district->district }}
                    		</a>
                    	</li>
                        <li class="breadcrumb-item active">Pincodes</li>
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
				<form action="{{ url('admin/category/pincodes/update') }}" method="POST">
					@csrf
					@php
						$cat_pincodes = $category->pincodes->pluck('id')->toArray();
					@endphp
					@foreach($pincodes as $pincode)
						<li class="list-group-item d-flex">
							<div class="custom-control custom-checkbox flex-fill">
							    <input 	type="checkbox" 
							    		class="custom-control-input" 
							    		id="country_{{ $pincode->id }}" 
							    		name="pincodes[]" 
							    		value="{{ $pincode->id }}"
							    		{{ checked($cat_pincodes, $pincode->id, TRUE) }}>

							    <label 	class="custom-control-label" 
							    		for="country_{{ $pincode->id }}">
							    	{{ $pincode->pincode }}
							    </label>
							</div>
						</li>
					@endforeach
					<li class="list-group-item">
						<input type="hidden" name="category_id" value="{{ $category->id }}">
                        <input type="hidden" name="district_id" value="{{ $district->id }}">
						<input type="submit" class="btn btn-primary px-4">
					</li>
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
