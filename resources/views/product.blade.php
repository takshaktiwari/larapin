@extends('layouts.app')

@section('styles')
	@parent
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<style>
		/* The container */
		.pr_option {
		  display: inline-block;
		  position: relative;
		  padding-left: 30px;
		  padding-bottom: 4px;
		  padding-top: 4px;
		  padding-right: 12px;
		  margin-bottom: 5px;
		  cursor: pointer;
		  font-size: 14px;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		  border: 1px solid #3dca79;
		  border-radius: 5px;
		  color: #3dca79;
		}

		/* Hide the browser's default radio button */
		.pr_option input {
		  position: absolute;
		  opacity: 0;
		  cursor: pointer;
		}

		/* Create a custom radio button */
		.checkmark {
		  position: absolute;
		  top: 8px;
		  left: 8px;
		  height: 15px;
		  width: 15px;
		  background-color: #eee;
		  border-radius: 50%;
		}

		/* On mouse-over, add a grey background color */
		.pr_option:hover input ~ .checkmark {
		  background-color: #ccc;
		}

		/* When the radio button is checked, add a blue background */
		.pr_option input:checked ~ .checkmark {
		  background-color: #071c35;
		}

		/* Create the indicator (the dot/circle - hidden when not checked) */
		.checkmark:after {
		  content: "";
		  position: absolute;
		  display: none;
		}

		/* Show the indicator (dot/circle) when checked */
		.pr_option input:checked ~ .checkmark:after {
		  display: block;
		}

		/* Style the indicator (dot/circle) */
		.pr_option .checkmark:after {
		 	top: 3.6px;
			left: 3.6px;
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background: white;
		}

		input[type=radio].attr_option_id{
			display: none;
		}
	</style>
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">{{ substr($product->product_name, 0, 20) }}...</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Shop Details</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="shop-details-page mt-120 rmt-70 mb-60 rmb-20">
		<div class="container">
			<div class="row col-gap-60">
				@if(Agent::isDesktop())
					<div class="col-xl-3 col-lg-4">
						@include('shop_sidebar')
					</div>
				@endif
				<div class="col-xl-9 col-lg-8">
					<div class="product-details-wrap">
						<div class="row col-gap-60">
							<div class="col-xl-5">
								<div class="product-preview-wrap">
									<div class="tab-content bg-white p-15 b1 br-5">
										<div class="tab-pane active" id="preview">
											<a data-fancybox="gallery" href="{{ url('storage'.$product->primary_img->image_lg) }}">
												<img src="{{ url('storage'.$product->primary_img->image_md) }}" alt="{{ url('storage'.$product->primary_img->title) }}" />
											</a>
										</div>
									</div>
									<ul class="nav nav-tabs mt-30">
										@foreach($product->images as $key => $image)
										<li>
											<a data-fancybox="gallery" href="{{ url('storage'.$image->image_lg) }}">
												<img src="{{ url('storage'.$image->image_sm) }}" alt="{{ $image->title }}" />
											</a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>
							<div class="col-xl-7">
								<div class="product-details text-left bg-white p-20 b1 br-5">
									<h4 class="mb-25 rmt-25">{{ $product->product_name }}</h4>
									<div class="rating mb-25">
										@if($product->reviews->count())
											<div class="star mr-15">
												@for($i=0; $i<=$product->reviews->avg('rating'); $i++)
													<i class="flaticon-star"></i>
												@endfor
											</div>
											<a href="{{ url('reviews/'.$product->slug) }}" class="text">
												({{ $product->reviews->count() }} Reviews)
											</a>
										@else
											<a href="{{ url('reviews/'.$product->slug) }}" class="color-theme font-weight-bold">
												<i class="fas fa-pen-nib"></i>
												Be the first to review
											</a>
										@endif
									</div>
									<div class="short_description">
										{{ $product->short_description }}
									</div>
									<h6 class="stock">
										Availability: 
										<span>
											@if($product->base_stock <= 10)
												{{ $product->base_stock }} Left
											@else
												In Stock
											@endif
										</span>
									</h6>
									<h4 class="price" id="product_price">
										<span>
											<i class="fas fa-rupee-sign"></i>
											{{ number_format(product_sale_price($product), 2) }}
										</span>
										<del class="small text-secondary ml-1">
											<i class="fas fa-rupee-sign"></i>
											{{ number_format($product->base_price, 2) }}
										</del>
									</h4>
									
									<form action="{{ url('cart/store') }}">
										<div class="product_attributes">
											@foreach($product->product_attrs as $pr_attribute)
											<div class="pr_attribute pb-2 mb-2">
												<h5 class="pb-1 mb-0">
													{{ $pr_attribute->attribute->attribute }}
												</h5>
												@foreach($pr_attribute->product_options as $key => $pr_option)
													
													<input 	type="hidden" 
															name="pr_attribute[{{ $pr_attribute->attribute->id }}][attribute_id]" 
															value="{{ $pr_attribute->attribute->id }}">
													<input 	type="hidden" 
															name="pr_attribute[{{ $pr_attribute->attribute->id }}][attribute]" 
															value="{{ $pr_attribute->attribute->attribute }}">
													<input 	type="radio" 
															name="pr_attribute[{{ $pr_attribute->attribute->id }}][pr_option][attr_option_id]" 
															class="attr_option_id" 
															value="{{ $pr_option->attr_option->id }}">

													<label class="pr_option {{ $pr_attribute->attribute->slug }}">
														{{ $pr_option->attr_option->attr_option }}
													  	<input type="radio" 
													  			class="pr_option_select" 
													  			data-attr="{{ $pr_attribute->attribute->slug }}" 
													  			data-attr-option-id="{{ $pr_option->attr_option->id }}" 
													  			data-pr-option="{{ $pr_option->id }}" 

													  			name="pr_attribute[{{ $pr_attribute->attribute->id }}][pr_option][attr_option]" 
													  			value="{{ $pr_option->attr_option->attr_option }}" 
													  			required="">
													  	<span class="checkmark"></span>
													</label>
												@endforeach
											</div>
											@endforeach
										</div>
										<div class="product-spinner mt-20">
											<div class="number-input b1">
												<button type="button" class="minus"></button>
												<input min="1" name="quantity" value="1" type="number" name="quantity">
												<button type="button" class="plus"></button>
											</div>
											<input type="hidden" name="product_id" value="{{ $product->id }}">
											<input type="submit" class="theme-btn br-30 ml-25" value="Add to Cart">
											<a href="#" class="add-wishlist">
												<i class="fas fa-heart"></i>
											</a>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="product-details-review bg-white mt-60 px-20 pt-20 pb-30 b1 br-5">
							<h4>Description</h4>
							<div class="" id="details">
								{{ $product->details->description }}
							</div>
						</div>

						<div class="related-product mt-60 rmt-75">
							<h3 class="mb-35">Related Product</h3>
							<div class="row">
								
								@foreach($related as $item)
								<div class="col-xl-4 col-md-6 col-md-4 mb-30">
									<div class="product">
										<div class="product-img-wrap">
											<a href="{{ url('product/'.$item->slug) }}">
												<img src="{{ url('storage'.$item->primary_img->image_md) }}" alt="{{ $item->product_name }}">
											</a>
										</div>
										<div class="product-content-wrap">
											<div class="product-content">
												<p>
													<a href="{{ url('product/'.$item->slug) }}">
														{{ $item->product_name }}
													</a>
												</p>
												@if($product->reviews->count() > 0)
													<div class="review">
														<a href="{{ url('reviews/'.$product->slug) }}" class="btn btn-success btn-sm font-weight-bold px-2 py-0 mr-2">
															{{ number_format($product->reviews->avg('rating'), 1) }} <i class="fas fa-star"></i>
														</a>
														<span class="small">
															( {{ $product->reviews->count() }} Reviews )
														</span>
													</div>
												@endif
											</div>
											<div class="product-action">
												<a href="#" class="add-to-btn small-btn">
													<i class="flaticon-shopping-cart"></i>
													<span>Add to Cart</span>
													<h5 class="product-price">
														<i class="fas fa-rupee-sign"></i>
														{{ number_format(product_sale_price($item), 2) }}
														
														@if(!empty($product->discount->discount))
															<del class="small text-secondary absolute ml-1 mt-1">
																{{ number_format($item->base_price, 2) }}
															</del>
														@endif
													</h5>
												</a>
												<div class="add-wishlist">
													<i class="fas fa-heart"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	@parent
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script>
		$(document).ready(function($) {
			$(".pr_option_select").change(function(event) {
				$(this).parent().prev('input[type=radio]').attr('checked', 'checked');

				var pr_option = $(this).val();
				var pr_option_attr = $(this).attr('data-attr');
				var pr_option_id = $(this).attr('data-pr-option');
				var product_id = '{{ $product->id }}';
				var base_price = '{{ product_sale_price($product) }}';

				$.ajax({
					url: '{{ url('ajax/product_add_attr_price') }}',
					type: 'GET',
					data: {product_id: product_id, pr_option_id: pr_option_id, base_price: base_price},
					success: function(result){
						var new_price = eval(result);
						$("#product_price").html('<i class="fas fa-rupee-sign"></i> '+new_price.toFixed(2));
					}
				});
				

				$('.'+pr_option_attr).css({
					'color': '#3dca79',
					'border-color': '#3dca79'
				});

				$(this).parent('.'+pr_option_attr).css({
					'color': '#071c35',
					'border-color': '#071c35'
				});
			});
		});
	</script>
@endsection