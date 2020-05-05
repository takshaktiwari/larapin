@extends('layouts.admin')

@section('styles')
    @parent
    <style>
        .custom_check{
            line-height: 0px;
        }

    </style>
@endsection

@section('content')

@php
    # existing product attributes
    $pr_attributes = $product->variants->pluck('attribute_id')->toArray();
    $pr_attributes = array_unique($pr_attributes);
@endphp
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Product Details</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Products</a>
    	                </li>
    	                <li class="breadcrumb-item active">Details</li>
                        <li class="breadcrumb-item active">{{ substr($product->product_name, 0, 50) }}...</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/products') }}" class="btn btn-primary">All Products</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
        
		@include('admin.products.product_nav')
        
		<div class="card">
			<div class="card-body">
                <div class="d-flex mb-3">
                    <li class="py-2 px-3 text-danger border">
                        <b class="mr-1">Base Price:</b>
                        <i class="fas fa-rupee-sign"></i>
                        {{ $product->base_price }}
                    </li>
                    <li class="py-2 px-3 text-danger border">
                        <b class="mr-1">Base Discount:</b>
                        <i class="fas fa-rupee-sign"></i>
                        {{ $product->base_discount }}
                    </li>
                    <li class="py-2 px-3 text-danger border">
                        <b class="mr-1">Base Stock:</b>
                        {{ $product->base_stock }}
                    </li>
                </div>
                <div class="clearfix"></div>
				<form action="{{ url('admin/product/variants/update') }}" method="POST">
					@csrf
                    
		            <div id="accordion" class="mb-4">
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
                                        <input type="checkbox" id="{{ 'attribute_switch_'.$attribute->id }}" switch="dark" class="parent_check" name="attributes[{{ $attribute->attribute }}][id]" value="{{ $attribute->id }}"  {{ checked($pr_attributes, $attribute->id, TRUE) }} />
                                        <label for="{{ 'attribute_switch_'.$attribute->id }}" data-on-label="Yes"
                                                data-off-label="No" class="mb-0"></label>
                                    </div>
                                </div>
                        
                                <div id="{{ 'attribute_'.$attribute->id }}" class="collapse"
                                        aria-labelledby="{{ $attribute->slug }}" data-parent="#accordion">
                                    <div class="card-body border ">
                                        <div class="row">
                                        @foreach($attribute->attr_options as $attr_option)
                                            @php
                                                $pr_variant = pr_variant($product, $attr_option);

                                                $style="";
                                                if($pr_variant['checked'] != 'checked'){
                                                    $style = 'display:none';
                                                }
                                            @endphp
                                            <div class="col-md-3">
                                                <div class="child_list mb-4">
                                                    <div class="form-check my-2">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input child_check" name="attributes[{{ $attribute->attribute }}][attr_options][{{ $attr_option->attr_option }}][id]" value="{{ $attr_option->id }}" {{ $pr_variant['checked'] }}>
                                                            {{ $attr_option->attr_option }}
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="child_inputs" style="{{ $style }}">
                                                        <input type="text" name="attributes[{{ $attribute->attribute }}][attr_options][{{ $attr_option->attr_option }}][price]" class="form-control text-center rounded-0 flex-fill" placeholder="(+ / -) Price" value="{{ $pr_variant['price'] }}">

                                                        <input type="text" name="attributes[{{ $attribute->attribute }}][attr_options][{{ $attr_option->attr_option }}][discount]" class="form-control text-center rounded-0 flex-fill" placeholder="Discount Total" value="{{ $pr_variant['discount'] }}">

                                                        <input type="text" name="attributes[{{ $attribute->attribute }}][attr_options][{{ $attr_option->attr_option }}][stock]" class="form-control text-center rounded-0 flex-fill" placeholder="Stock" value="{{ $pr_variant['stock'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
					<input type="submit" class="btn btn-lg rounded-sm btn-primary px-5" value="Update">
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->

    @php
        function pr_variant($product, $attr_option){
            $arr['checked']     = '';
            $arr['price']       = '';
            $arr['discount']    = '';
            $arr['stock']       = '';

            foreach ($product->variants as $variant) {
                if($attr_option->id == $variant->attr_option_id && 
                    $attr_option->attribute_id == $variant->attribute_id){
                    $arr['checked']     = 'checked';
                    $arr['price']       = $variant->price;
                    $arr['discount']    = $variant->discount;
                    $arr['stock']       = $variant->stock;

                    break;
                }
            }

            return $arr;
        }
    @endphp
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

            $(".child_check").change(function(event) {
                if($(this).prop("checked") == true){
                    $(this).parent().parent().next('.child_inputs').slideDown('fast');
                }else{
                    $(this).parent().parent().next('.child_inputs').slideUp('fast');
                }
            });
        });
    </script>
@endsection