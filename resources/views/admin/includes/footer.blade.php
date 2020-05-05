<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                © <script>{{ date('Y') }}</script> 
                {{ config('app.name', 'Laravel') }}
                <span class="d-none d-sm-inline-block"> 
                	 - Crafted with 
                	<i class="mdi mdi-heart text-danger"></i> 
                	by 
                	<a href="{{ url('https://inventivemonks.com') }}" target="_blank" class="text-success font-weight-bold">
                		Inventive Monks
                	</a>.
                </span>
            </div>
        </div>
    </div>
</footer>
