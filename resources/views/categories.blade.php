@extends('layouts.app')

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Shop by Categories</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Categories</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="categories-section text-center pt-60 pb-30">
		<div class="container">
			<div class="row">
				@foreach($categories as $category)
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-30">
					<a href="{{ url('shop?category='.$category->slug) }}" class="categori-item bg-white br-5">
						@if(!empty($category->discount_category->discount))
							<div class="item-off">
								{{ $category->discount_category->discount }}%
								<span>off</span>
							</div>
						@endif
						<div class="categori-img d-flex align-items-center justify-content-center">
							<img src="{{ url('storage'.$category->image_sm) }}" alt="img">
						</div>
						<div class="categori-name">
							<span>{{ $category->category }}</span>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</section>

@endsection