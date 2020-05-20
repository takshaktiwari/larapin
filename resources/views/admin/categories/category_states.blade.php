@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="font-size-18">Category States</h4>
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
                        <li class="breadcrumb-item active">States</li>
                    </ol>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="float-right d-none d-md-block">
                    <a href="{{ url('admin/categories') }}" class="btn btn-primary">All Categories</a>
                </div>
            </div>
        </div>
        

		<div class="card">
			<div class="card-body table-responsive">
				<form action="{{ url('admin/category/states/update') }}" method="POST">
					@csrf
					@php
						$cat_states = $category->states->pluck('id')->toArray();
					@endphp
					@foreach($states as $state)
						<li class="list-group-item d-flex">
							<div class="custom-control custom-checkbox flex-fill">
							    <input 	type="checkbox" 
							    		class="custom-control-input" 
							    		id="country_{{ $state->id }}" 
							    		name="states[]" 
							    		value="{{ $state->id }}"
							    		{{ checked($cat_states, $state->id, TRUE) }}>

							    <label 	class="custom-control-label" 
							    		for="country_{{ $state->id }}">
							    	{{ $state->state }}
							    </label>
							</div>

							@if(checked($cat_states, $state->id, TRUE))
							<a href="{{ url('admin/category/'.$category->id.'/districts?state_id='.$state->id) }}" class="btn btn-sm btn-success">
								Next
								<i class="fas fa-angle-right"></i>
							</a>
							@endif
						</li>
					@endforeach
					<li class="list-group-item">
						<input type="hidden" name="category_id" value="{{ $category->id }}">
						<input type="hidden" name="country_id" value="{{ $country->id }}">
						<input type="submit" class="btn btn-primary px-4">
					</li>
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
