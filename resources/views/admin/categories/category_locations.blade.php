@extends('layouts.admin')

@section('content')
	@php
		#	existing locations associated to this category
		$cat_locations = $category->locations->pluck('id')->toArray();
	@endphp
	<style>
		.custom_check{
			line-height: 0px;
		}
		.relative{
			position: relative;
		}
		.location_list{
			width: 30%;
		}
	</style>

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="font-size-18">Category Locations</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                        	<a href="javascript: void(0);">Categories</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $category->category }}</li>
                        <li class="breadcrumb-item active">locations</li>
                    </ol>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="float-right d-none d-md-block">
                    <a href="{{ url('admin/categories') }}" class="btn btn-primary">All Categories</a>
                </div>
            </div>
        </div>
        
		<form action="{{ url('admin/category/locations/update') }}" method="POST" enctype="multipart/form-data" class="mb-5">
		    @csrf
		    <div id="accordion_country">
		    	@foreach($countries as $country)
			        <div class="card mb-1">
			            <div class="card-header p-3 d-flex" id="{{ $country->slug }}">
			                <h6 class="my-0 ml-0 mr-auto font-size-18">
                	    		@if(count($country->states) > 0)
                		    		<span class="my-auto pr-2">
                		    			<i class="fas fa-angle-down"></i>
                		    		</span>
                	    		@endif

			                    <a href="#{{ 'country_'.$country->id }}" class="text-dark" data-toggle="collapse"
			                            aria-expanded="true"
			                            aria-controls="collapseOne">
			                        {{ $country->country }}
			                        <span class="badge badge-dark badge-pill ml-2">{{ $country->locations_count }}</span>
			                    </a>
			                </h6>
			                <div class="my-auto custom_check">
			                	<input type="checkbox" id="{{ 'country_switch_'.$country->id }}" switch="dark" class="country_check" />
			                	<label for="{{ 'country_switch_'.$country->id }}" data-on-label="Yes"
			                	        data-off-label="No" class="mb-0"></label>
			                </div>
			            </div>
			    
			            <div id="{{ 'country_'.$country->id }}" class="collapse"
			                    aria-labelledby="{{ $country->slug }}" data-parent="#accordion_country">
			                <div class="card-body bg-light border">
			                    @if(count($country->states) > 0)

	            		    		<div id="accordion_state">
	            		    			@foreach($country->states as $state)
		            		    			<div class="card mb-1">
		            		    				<div class="card-header p-3 d-flex" id="{{ $state->slug }}">
									                <h6 class="my-0 ml-0 mr-auto font-size-18">
						                	    		@if(count($state->locations) > 0)
						                		    		<span class="my-auto pr-2">
						                		    			<i class="fas fa-angle-down"></i>
						                		    		</span>
						                	    		@endif

									                    <a href="#{{ 'state_'.$state->id }}" class="text-dark" data-toggle="collapse"
									                            aria-expanded="true"
									                            aria-controls="collapseOne">
									                        {{ $state->state }}
									                        <span class="badge badge-dark badge-pill ml-2">{{ $state->locations_count }}</span>
									                    </a>
									                </h6>
									                <div class="my-auto custom_check">
									                	<input type="checkbox" id="{{ 'state_switch_'.$state->id }}" switch="dark" class="state_check" />
									                	<label for="{{ 'state_switch_'.$state->id }}" data-on-label="Yes"
									                	        data-off-label="No" class="mb-0"></label>
									                </div>
									            </div>
									            <div id="{{ 'state_'.$state->id }}" class="collapse"
									                    aria-labelledby="{{ $state->slug }}" data-parent="#accordion_state">
									                <div class="card-body d-flex flex-wrap">
									                		@foreach($state->locations as $location)
									                			<div class="form-check list-group-item border my-1 mx-1 flex-fill location_list">
									                			  	<label class="form-check-label ">
									                			    	<input type="checkbox" class="form-check-input location_check m-0 relative" name="location[]" value="{{ $location->id }}" {{ checked($cat_locations, $location->id, TRUE) }}>
									                			    	{{ $location->location }}
									                			    	<span class="badge badge-secondary">
									                			    		{{ $location->pincode }}
									                			    	</span>
									                			  	</label>
									                			</div>
									                		@endforeach
									                </div>
									            </div>
	            		    				</div>
	            		    			@endforeach
	            		    		</div>
	            		    	@endif
			                </div>
			            </div>
			        </div>
		        @endforeach
		    </div>

		    <div class="text-center py-5">
		    	<input type="hidden" name="category_id" value="{{ $category->id }}">
		    	<input type="submit" class="btn btn-lg btn-info px-5 rounded-sm" value="Update Category">
		    </div>
		</form>


    </div> <!-- container-fluid -->
@endsection

@section('scripts')
	@parent
	<script>
		$(document).ready(function($) {
			$("#accordion_country").find('.collapse').first().addClass('show');
			$(".country_check").change(function(event) {
				if($(this).is(':checked')){
					$(this).parent().parent().next().find('.state_check').prop( "checked", true );
					$(this).parent().parent().next().find('.location_check').prop( "checked", true );
				}else{
					$(this).parent().parent().next().find('.state_check').prop( "checked", false );
					$(this).parent().parent().next().find('.location_check').prop( "checked", false );
				}
			});

			$(".state_check").change(function(event) {
				if($(this).is(':checked')){
					$(this).parent().parent().next().find('.location_check').prop( "checked", true );
				}else{
					$(this).parent().parent().next().find('.location_check').prop( "checked", false );
				}
			});
		});
	</script>
@endsection