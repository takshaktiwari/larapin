<div class="bg-light border-right" id="sidebar-wrapper">  
	<div class="d-sm-none d-flex flex-wrap bg-theme text-center rounded">
		<a href="{{ url('user/home') }}" class="p-2 flex-fill text-white border-left border-bottom">
			<i class="fas fa-tachometer-alt mr-1"></i>
		</a>
		<a href="{{ url('user/orders') }}" class="p-2 flex-fill text-white border-left border-bottom">
			<i class="fas fa-truck-loading mr-1"></i>
		</a>
		<a href="{{ url('user/wishlist') }}" class="p-2 flex-fill text-white border-left border-bottom">
			<i class="fas fa-heart mr-1"></i>
		</a>
		<a href="{{ url('user/addresses') }}" class="p-2 flex-fill text-white border-left border-bottom">
			<i class="fas fa-home mr-1"></i>
		</a>
		<a href="{{ url('user/profile') }}" class="p-2 flex-fill text-white border-left border-bottom">
			<i class="fas fa-pen-nib mr-1"></i>
		</a>
		<a href="{{ url('user/change_password') }}" class="p-2 flex-fill text-white border-left border-bottom">
			<i class="fas fa-key mr-1"></i>
		</a>
		<a href="{{ route('logout') }}" class="p-2 flex-fill text-white border-left border-bottom" 
		   onclick="event.preventDefault();
		                 document.getElementById('logout-form').submit();">
		    <i class="fas fa-power-off mr-1"></i>
		</a>
	</div> 
	<div class="list-group list-group-flush d-sm-block d-none">
		<a href="{{ url('user/home') }}" class="list-group-item text-dark bg-light">
			<i class="fas fa-tachometer-alt mr-1"></i>
			Dashboard
		</a>
		<a href="{{ url('user/orders') }}" class="list-group-item text-dark bg-light">
			<i class="fas fa-truck-loading mr-1"></i>
			My Order
		</a>
		<a href="{{ url('user/wishlist') }}" class="list-group-item text-dark bg-light">
			<i class="fas fa-heart mr-1"></i>
			My Wishlist
		</a>
		<a href="{{ url('user/addresses') }}" class="list-group-item text-dark bg-light">
			<i class="fas fa-home mr-1"></i>
			My Addresses
		</a>
		<a href="{{ url('user/profile') }}" class="list-group-item text-dark bg-light">
			<i class="fas fa-pen-nib mr-1"></i>
			Edit Profile
		</a>
		<a href="{{ url('user/change_password') }}" class="list-group-item text-dark bg-light">
			<i class="fas fa-key mr-1"></i>
			Change Password
		</a>
		
		<a class="list-group-item text-dark bg-light" href="{{ route('logout') }}"
		   onclick="event.preventDefault();
		                 document.getElementById('logout-form').submit();">
		    <i class="fas fa-power-off mr-1"></i>
		    {{ __('Logout') }}
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		    @csrf
		</form>
	</div>
</div>