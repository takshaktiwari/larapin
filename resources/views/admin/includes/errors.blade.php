
@if ($errors->any())
	<audio src="{{ url('assets/notification.mp3') }}" autoplay></audio>
	<div class="alert alert-dark rounded-0 font-size-16 alert-dismissible custom_alert shadow-sm">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<ul class="mb-0">
	  	    @foreach ($errors->all() as $error)
	  	        <li class="font-weight-bold">{{ $error }}</li>
	  	    @endforeach
	  	</ul>
	</div>
@endif