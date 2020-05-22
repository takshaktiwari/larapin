@extends('layouts.app')


@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">{{ $page->title }}</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="cart-page mt-70 rmt-80 mb-70 rmb-80">
		<div class="container">
			<h3 class="border-bottom">{{ $page->title }}</h3>

			<div class="page_content">
				{!! $page->content !!}
			</div>
		</div>
	</section>
@endsection

