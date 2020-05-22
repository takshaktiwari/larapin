@extends('layouts.app')


@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Contact Us</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Contact Us</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="contact-info-map mt-110 rmt-80 mb-80 rmb-50">
		<div class="container">
			<div class="row col-gap-100">
				<div class="col-lg-6">
					<div class="contact-info-map-inner">
						<div class="contact-info">
							<div class="section-title mb-30">
								<h3>Contact Information</h3>
							</div>
							<div class="contact-box mb-20">
								<div class="row">
									<div class="col-lg-6 col-md-4 col-sm-6">
										<div class="contact-info-box">
											<i class="fa fa-phone"></i>
											<span>+01 (000) 234 765 <br>+01 (222) 234 567</span>
										</div>
									</div>
									<div class="col-lg-6 col-md-4 col-sm-6">
										<div class="contact-info-box">
											<i class="fa fa-envelope"></i>
											<span><a href="https://tf.techoners.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="72111d1c06131106070132151f131b1e5c111d1f">[email&#160;protected]</a> <br><a href="https://tf.techoners.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="355a415d504758545c594046755258545c591b565a58">[email&#160;protected]</a></span>
										</div>
									</div>
									<div class="col-lg-6 col-md-4 col-sm-6">
										<div class="contact-info-box">
											<i class="fa fa-map-marker"></i>
											<span>3010 Laurel Lee <br>Blaine, MN 55414, USA</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="contact-map">
							<div class="outer-container">
								<div class="map-outer">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="contact-form rmt-50">
						<div class="section-title mb-45">
							<h3>Get In Touch</h3>
						</div>

						<form name="contact_form" class="contact-form" action="{{ url('contact_us') }}" method="POST">
							@csrf
							<div class="row clearfix">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Name*</label>
										<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Jhon Mack" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email*</label>
										<input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="eg : yourmail@gmail.com" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone">Phone Number*</label>
										<input type="text" name="phone" id="phone" class="form-control" placeholder="+01 234 . . . ." maxlength="10" value="{{ old('phone') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="subject">Subject*</label>
										<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="message">Message*</label>
										<textarea name="message" id="message" class="form-control" rows="7" placeholder="Your Message" required>{{ old('message') }}</textarea>
									</div>
								</div>
							</div>
							<div class="form-group mt-20 mb-0">
								<button type="submit" class="theme-btn br-30" type="submit">Send Message</button>
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>
	</section>
@endsection
