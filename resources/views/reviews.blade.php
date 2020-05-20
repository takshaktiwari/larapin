@extends('layouts.app')

@section('styles')
	@parent
	<style>
		.review img{
			max-width: 80px;
		}
		
		.stars .rating { float:left;margin:0;}
		.rating > input {display:none;}
		.rating > label:before {margin:3px;font-size:32px;font-family:'Font Awesome 5 Free';display:inline-block;content:"\f005";}
		.rating > label {color:#b3b3b3;float:right;}
		.rating > input:checked ~ label,
		.rating:not(:checked) > label:hover,
		.rating:not(:checked) > label:hover ~ label { color: #FFD700;  }
		.rating > input:checked + label:hover,
		.rating > input:checked ~ label:hover,
		.rating > label:hover  input:checked  label,
		.rating > input:checked  label:hover  label { color: #f3cd00;  }
	</style>
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Reviews</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">
							<a href="{{ url('/') }}">{{ substr($product->product_name, 0, 25) }}...</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Reviews</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="shop-page mt-120 rmt-80 mb-90 rmb-50">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="checkout-form-wrap border mb-40">
						<div class="row">
							<div class="col-md-3">
								<img src="{{ url('storage'.$product->primary_img->image_md) }}" alt="{{ $product->product_name }}" class="w-100">
							</div>
							<div class="col-md-9 my-auto">
								<h5>
									<a href="{{ url('product/'.$product->slug) }}">
										{{ $product->product_name }}
									</a>
								</h5>
								@if($product->reviews->count())
								<div class="rating mb-15">
									<div class="star text-warning mr-15 d-inline">
										@for($i=0; $i<=$product->reviews->avg('rating'); $i++)
											<i class="flaticon-star"></i>
										@endfor
									</div>
									<a href="{{ url('reviews/'.$product->slug) }}" class="text">
										({{ $product->reviews->count() }} Reviews)
									</a>
								</div>
								@endif
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
								<h5>
									<a href="" data-toggle="collapse" data-target="#submit_review">
										<i class="fas fa-pen-nib"></i>
										Write A Review
									</a>
								</h5>
							</div>
						</div>
					</div>

					<div class="checkout-form-wrap border collapse" id="submit_review">
						@auth
						<form action="{{ url('review/create') }}" method="POST">
							@csrf
							<div class="stars">
							    <fieldset class="rating">
							        <input type="radio" id="star5" class="star5_0" name="rating" value="5" />
							        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
							        <input type="radio" id="star4" class="star4_0" name="rating" value="4" />
							        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							        <input type="radio" id="star3" class="star3_0" name="rating" value="3" />
							        <label class = "full" for="star3" title="Average - 3 stars"></label>

							        <input type="radio" id="star2" class="star2_0" name="rating" value="2" />
							        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

							        <input type="radio" id="star1" class="star1_5" name="rating" value="1" />
							        <label class = "full" for="star1" title="Very Poor - 1 star"></label>
							    </fieldset>
							    <div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label for="" class="pl-0">Title <span class="text-danger">*</span></label>
								<input type="text" name="title" class="form-control" required placeholder="Enter the title" maxlength="250" >
							</div>
							<div class="form-group">
								<label for="" class="pl-0">Your Review <span class="text-danger">*</span></label>
								<textarea name="review" rows="4" class="form-control" required="" placeholder="Write your review here..."></textarea>
							</div>
							<input type="hidden" name="product_id" value="{{ $product->id }}">
							<input type="submit" class="theme-btn">
						</form>
						@else
							<h4 class="text-center mb-0">
								Please <a href="{{ url('login') }}" class="color-theme">Login</a> 
								to write a review
							</h4>
						@endif
					</div>
					
					@foreach($reviews as $review)
						<a href="" name="review_{{ $review->id }}"></a>
						<div class="checkout-form-wrap border review mt-4">
							<div class="d-sm-flex">
								<div class="user_img">
									@empty($review->user->user_img)
										<img src="{{ url('assets/user-avatar.png') }}" alt="{{ $review->user->name }}" class="rounded-circle img-thumbnail">
									@else
										<img src="{{ url('storage'.$review->user->user_img) }}" alt="{{ $review->user->name }}" class="rounded-circle img-thumbnail">
									@endempty
								</div>
								<div class="user_info pl-sm-3 my-sm-auto mt-3">
									<h6 class="mb-1">{{ $review->user->name }}</h6>
									<div class="text-danger small">
										{{ date('d-M-Y h:i A', strtotime($review->created_at)) }}
									</div>
									<div class="text-warning">
										@for($i=0; $i<=$review->rating; $i++)
											<i class="flaticon-star"></i>
										@endfor
									</div>
									<p class="font-weight-bold text-dark mb-1">{{ $review->title }}</p>
									<p class="mb-0">{{ $review->review }}</p>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="col-md-3">
					<img src="{{ url('assets/star-boy.jpg') }}" alt="">
				</div>

			</div>
		</div>
	</section>
@endsection
