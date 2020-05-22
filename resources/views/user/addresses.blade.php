@extends('layouts.app')

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">My Addresses</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Addresses</li>
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
						<div class="cart-total-product b1 br-5 p-25">
                        	<h4 class="cart-heading">
                        		Address
                        		<a href="{{ url('user/address/create') }}" class="btn border ml-2 bg-theme btn-sm text-white">+ Create New</a>
                        	</h4>
                        	<div class="row">
								@foreach(Auth::user()->addresses as $addr)
									<div class="col-md-6">
										<div class="contact-info-box text-left p-3">
										 	<span><b style="color: #000">{{ $addr->name }}</b></span><br>
											<span>
												<b>Contact: </b>
												{{ $addr->mobile }}
												@if(!empty($addr->email))
													, {{ $addr->email }}
												@endif
											</span><br>
											<span class="small">{{ $addr->landmark }}</span><br>
											<span>
												<b>Address: </b>
												{{ $addr->line1 }}
												@if(!empty($addr->line2))
													{{ $addr->line2 }}
												@endif
											</span>
											<br>

											
											<span>
												<b>Location: </b>
												{{ $addr->location->location }}
											</span><br>
											<span>
												<b>City: </b>
												{{ $addr->district->district }}
											</span>
											<span class="ml-2">
												<b>[{{ $addr->pincode->pincode }}]</b>
											</span><br>
											<span>
												<b>Country: </b>
												{{ $addr->state->state }},
												{{ $addr->country->country }} 
											</span>


											<div class="clearfix mt-2"></div>
											<a href="{{ url('user/address/edit/'.$addr->id) }}" class="theme-btn py-2 my-1">Edit</a>
											<a href="{{ url('user/address/delete/'.$addr->id) }}" class="theme-btn py-2 my-1">Delete</a>
										</div>
									</div>
								@endforeach
							</div>
                    	</div>		        
					</div>
					<!-- /#page-content-wrapper -->

				</div>
			</div>
		</div>
	</section>
@endsection