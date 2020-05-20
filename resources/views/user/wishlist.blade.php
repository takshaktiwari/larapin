@extends('layouts.app')

@section('styles')
	@parent
	<style>
		.wish-items img{
			max-height: 100px;
		}
		.wish-items .item-off{
			top: unset;
			right: unset;
			width: 35px;
			height: 35px;
			font-size: 12px;
			line-height: 34px;
			margin-top: -100px;
		}
		.wish-items .buttons{
			max-width: 150px;
		}
	</style>
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Dashboard</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="user_section py-75">
		<div class="container">
			<div class="row">
				<div class="col-md-3" id="wrapper">
					@include('user/user_navigation')
				</div>
					<!-- /#sidebar-wrapper -->
				
				<div class="col-md-9">
					<!-- Page Content -->
					<div id="page-content-wrapper">

						<div class="body-cntn">
							<div class="cart-total-product b1 br-5 p-25">
								<h4 class="cart-heading">My Wishlists</h4>

								<div class="wish-items pb-15">
									@foreach($items as $item)
							    	<div class="d-sm-flex mb-30 text-sm-left text-center">
							    		<div class="my-auto ">
							    			<a href="{{ url('product/'.$item->product->slug) }}">
								    			<img src="{{ url('storage'.$item->product->primary_img->image_sm) }}" class="img-thumbnail my-1" alt="">
								    			@if(!empty($item->product->discount->discount))
								    				<div class="item-off">
								    					{{ $item->product->discount->discount }}%
								    					<span>off</span>
								    				</div>
								    			@endif
							    			</a>
							    		</div>
						    			<div class="my-auto flex-fill px-2">
						    				<a href="{{ url('product/'.$item->product->slug) }}">
						    					<h5 class="mb-2">
						    						{{ $item->product->product_name }}
						    					</h5>
						    				</a>
						    				@if($item->product->reviews->count() > 0)
						    					<div class="review mb-2">
						    						<span class="btn btn-success btn-sm font-weight-bold px-2 py-0 mr-2">
						    							{{ number_format($item->product->reviews->avg('rating'), 1) }} <i class="fas fa-star"></i>
						    						</span>
						    						<span class="small">
						    							( {{ $item->product->reviews->count() }} Reviews )
						    						</span>
						    					</div>
						    				@endif
							    			<h6 class="color-theme">
							    				<i class="fas fa-rupee-sign"></i>
							    				{{ number_format(product_sale_price($item->product), 2) }}
							    				
							    				@if(!empty($item->product->discount->discount))
							    					<del class="small text-secondary absolute ml-1 mt-1">
							    						{{ number_format($item->product->base_price, 2) }}
							    					</del>
							    				@endif
							    			</h6>

						    			</div>
							    		<div class="my-auto px-2 buttons">
							    			<div class="d-flex d-sm-block">
								    			<a href="{{ url('cart/store/?quantity=1&product_id='.$item->product->id) }}" class="btn btn-sm bg-theme flex-fill text-white w-100 px-3 mb-sm-2 mb-0" title="Delete this">
								    			    <i class="fas fa-shopping-cart mr-1"></i>
								    			    Add To Cart
								    			</a>
								    			<a href="{{ url('user/wishlist/delete/'.$item->id) }}" class="btn btn-sm btn-danger flex-fill w-100 mb-sm-1 mb-0 px-3" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
								    			    <i class="fas fa-times mr-1"></i>
								    			    <span class="d-sm-inline d-none">
								    			    	Remove
								    			    </span>
								    			</a>
							    			</div>
							    		</div>
							    	</div>
								    @endforeach
								</div>
								
								{{ $items->links() }}

							</div>		        
						</div>
								
					</div>
					<!-- /#page-content-wrapper -->

				</div>
			</div>
		</div>
	</section>
@endsection