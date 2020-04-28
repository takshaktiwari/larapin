@extends('layouts.admin')

@section('content')
	@php
		#	existing attributes associated to this category
		$cat_attributes = $category->attributes->pluck('id')->toArray();

		#	existing attribute_otions associated to this category
		$cat_options = $category->attr_options->pluck('id')->toArray();
	@endphp
	<style>
		.custom_check{
			line-height: 0px;
		}
		.relative{
			position: relative;
		}
		.child_list{
			width: 30%;
		}
	</style>

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="font-size-18">Category Attributes</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                        	<a href="javascript: void(0);">Categories</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $category->category }}</li>
                        <li class="breadcrumb-item active">Attributes</li>
                    </ol>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="float-right d-none d-md-block">
                    <a href="{{ url('admin/categories') }}" class="btn btn-primary">All Categories</a>
                </div>
            </div>
        </div>
        
		<form action="{{ url('admin/category/attributes/update') }}" method="POST" enctype="multipart/form-data" class="mb-5">
		    @csrf
		    <div id="accordion">
		    	@foreach($attributes as $attribute)
			        <div class="card mb-1">
			            <div class="card-header p-3 d-flex" id="{{ $attribute->slug }}">
			                <h6 class="my-0 ml-0 mr-auto font-size-18">
                	    		@if(count($attribute->attr_options) > 0)
                		    		<span class="my-auto pr-2">
                		    			<i class="fas fa-angle-down"></i>
                		    		</span>
                	    		@endif

			                    <a href="#{{ 'attribute_'.$attribute->id }}" class="text-dark" data-toggle="collapse"
			                            aria-expanded="true"
			                            aria-controls="collapseOne">
			                        {{ $attribute->attribute }}
			                        <span class="badge badge-dark badge-pill ml-2">{{ $attribute->attr_options_count }}</span>
			                    </a>
			                </h6>
			                <div class="my-auto custom_check">
			                	<input type="checkbox" id="{{ 'attribute_switch_'.$attribute->id }}" switch="dark" class="parent_check" name="attributes[]" value="{{ $attribute->id }}"  {{ checked($cat_attributes, $attribute->id, TRUE) }} />
			                	<label for="{{ 'attribute_switch_'.$attribute->id }}" data-on-label="Yes"
			                	        data-off-label="No" class="mb-0"></label>
			                </div>
			            </div>
			    
			            <div id="{{ 'attribute_'.$attribute->id }}" class="collapse"
			                    aria-labelledby="{{ $attribute->slug }}" data-parent="#accordion">
			                <div class="card-body bg-light border d-flex flex-wrap">
			                    @foreach($attribute->attr_options as $attr_option)
			                    	<div class="form-check list-group-item border my-1 mx-1 flex-fill child_list">
			                    	  	<label class="form-check-label ">
			                    	    	<input type="checkbox" class="form-check-input child_check m-0 relative" name="attr_options[]" value="{{ $attr_option->id }}" {{ checked($cat_options, $attr_option->id, TRUE) }}>
			                    	    	{{ $attr_option->attr_option }}
			                    	  	</label>
			                    	</div>
			                    @endforeach
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
			$("#accordion").find('.collapse').first().addClass('show');
			$(".parent_check").change(function(event) {
				if($(this).is(':checked')){
					$(this).parent().parent().next().find('.child_check').prop( "checked", true );
				}else{
					$(this).parent().parent().next().find('.child_check').prop( "checked", false );
				}
			});
		});
	</script>
@endsection