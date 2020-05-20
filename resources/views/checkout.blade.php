@extends('layouts.app')

@section('styles')
	@parent
	<style>
		.checkout_stripped_link{
			text-align: center;
			padding: 13px 6px;
			border-radius: 4px;
			border-bottom: 3px solid #afafaf;
			font-size: 18px;
			font-weight: 400;
		}
		.checkout_stripped_link a{
			font-weight: 600;
			margin-left: 6px;
		}
		.addr-hide{
			display: none;
		}
	</style>
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Checkout</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('cart') }}">Cart</a></li>
						<li class="breadcrumb-item active" aria-current="page">Checkout</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="checkout-page mt-70 rmt-80 mb-70 rmb-80">
		<div class="container">
			@guest
			<h4 class="checkout_stripped_link bg-color2 mb-0">
				Returning Customer 
				<a href="" data-toggle="collapse" data-target="#checkout_login">Login Here</a>
			</h4>
			<div class="p-4 collapse shadow-sm" id="checkout_login">
				<div class="login-info-inner">
					<h2>Welcome Back</h2>
					<form action="{{ url('login') }}" method="POST" class="login-form">
						@csrf								
						<div class="email-field">
							<label for="email">Enter Email*</label>
							<input id="email" type="email" class="" name="email" value="" required="" autocomplete="email" autofocus="">
                            								</div>
						<div class="password-field">
							<label for="pass">Password*</label>
							<input id="password" type="password" class="" name="password" required="" autocomplete="current-password">
                        </div>
						<div class="alternative-login">
							<span>
								<a href="http://localhost/projects/larapin/password/reset">
									Forget Password
								</a>
							</span>
                    		<span>Don't Have Account ?<a class="signup-link" href="http://localhost/projects/larapin/register">Sign Up</a></span>
						</div>
						<div class="signin-button-wrap">
							<button type="submit" class="btn-bg2">
							    Login
							</button>
						</div>
					</form>
					<div class="or-text">or you can join with</div>
					<div class="share-btn-wrap">
						<div class="facebook-btn">
							<a href="#"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
						</div>
						<div class="google-btn">
							<a href="#"><i class="fab fa-google"></i><span>Google</span></a>
						</div>
					</div>
				</div>
			</div>
			<h4 class="checkout_stripped_link bg-color2 mt-4">
				Don't Have any account ? <a href="{{ url('register') }}">Regitser Here</a>
			</h4>

			<h2 class="page-title text-center text-dark">Or</h2>
			<h4 class="text-center text-dark font-weight-normal">Continue as Guest</h4>
			@endguest
			

			<form action="{{ url('checkout/do') }}" method="POST" class="row col-gap-60">
				@csrf
				<div class="col-xl-8 col-lg-6">
					<div class="checkout-form-wrap rmb-50">
						<div class="cart-title">
							<h4>Shipping Details</h4>
						</div>
						
						@auth
							<div class="row">
								@foreach(Auth::user()->addresses as $addr)
									<div class="col-md-6">
										<div class="custom-control custom-radio">
										  	<input type="radio" class="custom-control-input" id="addr_{{ $addr->id }}" name="shipping_addr" value="{{ $addr->id }}" required="" {{ checked($addr->default_addr, '1') }}>
										  	<label class="custom-control-label" for="addr_{{ $addr->id }}">
										  		{{ $addr->name }}
										  		<div class="small">
										  			{{ $addr->line1 }}, <br>
										  			{{ $addr->location->location }}, 
										  			{{ $addr->district->district }}, <br>
										  			{{ $addr->state->state }}
										  			<b class="ml-1">[{{ $addr->pincode->pincode }}]</b>
										  		</div>
										  	</label>
										</div>
									</div>
								@endforeach
								<div class="col-md-12">
									<div class="custom-control custom-radio">
									  	<input type="radio" class="custom-control-input" id="addr_new" name="shipping_addr" value="new" required="">
									  	<label class="custom-control-label" for="addr_new">
											<h4 class="color-theme mb-0">
												New Address
											</h4>
										</label>
									</div>
								</div>
							</div>
							
							<div class="addr-hide" id="new_address">
						@else
							<div class="" id="new_address">
						@endauth
								@include('includes/address_form')
							</div>
						
						@if($shipping_slots)
							<div class="cart-title  pt-3">
								<h4>Shipping Slots</h4>
							</div>
							<div class="row">
								@foreach($shipping_slots as $key => $slot)
									<div class="col-md-6">
										<div class="custom-control custom-radio">
										  	<input type="radio" class="custom-control-input" id="slot_{{ $slot->id }}" name="shipping_slot_id" value="{{ $slot->id }}" {{ checked($key, '0') }}>
										  	<label class="custom-control-label" for="slot_{{ $slot->id }}">
										  		{{ date('h:i A', strtotime($slot->time_from)).' - '.date('h:i A', strtotime($slot->time_to)) }}
										  		@if($slot->time_from > date('H:i:s'))
										  			<div class="small">Today</div>
										  		@else
										  			<div class="small">Tomorrow</div>
										  		@endif
										  	</label>
										</div>
									</div>
								@endforeach
							</div>
						@endif

						<div class="form-group border-top pt-3">
							<label for="email">Other Note <span>(optional)</span></label>
							<textarea name="order_note" class="form-control mb-0" placeholder="+01 000..." rows="8" maxlength="499"></textarea>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-6">
					<div class="checkout-cart-total clearfix ">
						<div class="cart-title ">
							<h4>Order Summary</h4>
						</div>
						<div class="total-item-wrap clearfix">
							@php
								$total_price = 0;
							@endphp
							@foreach(session('cart', array()) as $cart_item)
								@php
									$total_price += $cart_item['product_price'] * $cart_item['quantity'];
								@endphp
								<div class="total-item">
									<a href="{{ url('product/'.$cart_item['product']['slug']) }}">
										<span class="title">
											{{ $cart_item['product']['product_name'] }}
										</span>
									</a>
									<span class="price text-nowrap	 ml-2">
										<i class="fas fa-rupee-sign"></i>
										{{ number_format($cart_item['product_price'] * $cart_item['quantity'], 2) }}
									</span>
								</div>
							@endforeach
							<div class="total-item">
								<span class="title">Shipping Cost</span>
								<span class="price text-nowrap">
									<i class="fas fa-rupee-sign"></i>
									{{ number_format($shipping_charge, 2) }}
								</span>
							</div>
							<div class="total-item discount">
								<span class="title">Discount</span>
								<span class="price text-nowrap">
									<i class="fas fa-rupee-sign"></i>
									@php
										if(!empty(session('coupon', array()))) {
											$discount = session('coupon')['amount'];
											if(empty($discount)){
												$discount = $total_price * (session('coupon')['percent'] / 100);
											}
											$total_price -= $discount;
											echo number_format($discount, 2);
										}else{
											echo '0.00';
										}
									@endphp
								</span>
							</div>
							<div class="total-item total">
								<span class="title">Total</span>
								<span class="price text-nowrap">
									<i class="fas fa-rupee-sign"></i>
									{{ number_format($total_price + $shipping_charge, 2) }}
								</span>
							</div>
						</div>
						<div class="cart-title">
							<h4 class="mb-25 mt-10">Payment</h4>
						</div>
						<ul id="accordionExample" class="mb-40">
							
							@if(get_setting('pay_online') == 'enable')
								<li class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="methodone" name="payment_method" value="online" checked>
									<label class="custom-control-label" for="methodone" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">Pay Online</label>
									<div id="collapseOne" class="collapse show" data-parent="#accordionExample" style="">
										<ul>
											<li>
												<a href="#">
													<img src="{{ url('assets/front/img/pay-method/visa.png') }}" alt="">
												</a>
											</li>
											<li>
												<a href="#">
													<img src="{{ url('assets/front/img/pay-method/mastercard.png') }}" alt="">
												</a>
											</li>
											<li>
												<a href="#">
													<img src="{{ url('assets/front/img/pay-method/discover.png') }}" alt="">
												</a>
											</li>
											<li>
												<a href="#">
													<img src="{{ url('assets/front/img/pay-method/americanexpress.png') }}" alt="">
												</a>
											</li>
										</ul>
									</div>
								</li>
							@endif
							
							@if(get_setting('cash_on_delivery') == 'enable')
								<li class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="methodthree" name="payment_method" value="cod">
									<label class="custom-control-label collapsed" for="methodthree" data-toggle="collapse" data-target="#collapsethree" aria-controls="collapsethree">Cash On Delivery</label>
									<div id="collapsethree" class="collapse" data-parent="#accordionExample" style="">
										<p>Lorem ipsum dolor sit amet, con se ctetur adipiscing elit. In sagittis eg esta ante, sed viverra nunc tinci dunt nec elei fend et tiram.</p>
									</div>
								</li>
							@endif
						</ul>
						<div class="checkout-btn text-center">
							<button type="submit" class="theme-btn br-5 w-100">Place Order</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
@endsection


@section('scripts')
	@parent
	<script>
		$(document).ready(function($) {
			$("#same_billing").change(function(event) {
				if($("#same_billing").prop('checked') == true){
					$("#billing_details").slideUp('fast');
				}else{
					$("#billing_details").slideDown('fast');
				}
			});

			@guest
				$(".address_form").attr('required', '');
			@endguest

			$("input[name=shipping_addr]").change(function(event) {
				var shipping_addr = $(this).val();

				if(shipping_addr == 'new'){
					$("#new_address").slideDown('fast', function(){
						$(".address_form").attr('required', '');
					});
				}else{
					$("#new_address").slideUp('fast', function(){
						$(".address_form").removeAttr('required');
					});
				}
			});

			$("#country_id").change(function(event) {
			    var country_id = $(this).val();

			    if(country_id != ''){
			        $.ajax({
			            url: '{{ url('ajax/get_country_states') }}',
			            type: 'POST',
			            data: {country_id: country_id ,_token: '{{csrf_token()}}'},
			            success: function(result){
			                $("#state_id").html('<option value="">-- Select State --</option>');
			                if(result != ''){
			                    $.each(result, function(index, val) {
			                        $("#state_id").append('<option value="'+val.id+'">'+val.state+'</option>');
			                    });
			                }
			            }
			        });
			        
			    }
			});

			$("#state_id").change(function(event) {
			    var state_id = $(this).val();

			    if(state_id != ''){
			        $.ajax({
			            url: '{{ url('ajax/get_state_districts') }}',
			            type: 'POST',
			            data: {state_id: state_id ,_token: '{{csrf_token()}}'},
			            success: function(result){
			                $("#district_id").html('<option value="">-- Select District --</option>');
			                if(result != ''){
			                    $.each(result, function(index, val) {
			                        $("#district_id").append('<option value="'+val.id+'">'+val.district+'</option>');
			                    });
			                }
			            }
			        });
			        
			    }
			});

			$("#district_id").change(function(event) {
			    var district_id = $(this).val();

			    if(district_id != ''){
			        $.ajax({
			            url: '{{ url('ajax/get_district_pincodes') }}',
			            type: 'POST',
			            data: {district_id: district_id ,_token: '{{csrf_token()}}'},
			            success: function(result){
			                $("#pincode_id").html('<option value="">-- Select Pincode --</option>');
			                if(result != ''){
			                    $.each(result, function(index, val) {
			                        $("#pincode_id").append('<option value="'+val.id+'">'+val.pincode+'</option>');
			                    });
			                }
			            }
			        });
			        
			    }
			});

			$("#pincode_id").change(function(event) {
			    var pincode_id = $(this).val();

			    if(pincode_id != ''){
			        $.ajax({
			            url: '{{ url('ajax/get_pincode_locations') }}',
			            type: 'POST',
			            data: {pincode_id: pincode_id ,_token: '{{csrf_token()}}'},
			            success: function(result){
			                $("#location_id").html('<option value="">-- Select Location --</option>');
			                if(result != ''){
			                    $.each(result, function(index, val) {
			                        $("#location_id").append('<option value="'+val.id+'">'+val.location+'</option>');
			                    });
			                }
			            }
			        });
			        
			    }
			});
		});
	</script>
@endsection