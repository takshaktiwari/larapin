@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<input type="text" class="code" id="user_purchase_code">
<button id="user_purchase_code_submit" class="submitBtn"></button>

<script>
    .jQuery(document).ready(function($) {
        $.ajax({
            url: '<?= get_site_url() ?>/after_purchase_code.php',
            type: 'POST',
            data: {user_email: user_email, purchase_code: purchase_code},
            success: function(result){
                
                if(result == 'success'){
                    $("#generate_purchase_code").html('Purchase code is successfully sent to user via email. Please on Update profile to save the code along with user information');
                }else{
                    $("#generate_purchase_code").html('Error !! Unable to send email to user');
                }
            }
        });




        $("#user_purchase_code_submit").click(function(event) {
            var purchase_code = $("#user_purchase_code").val();
            if(purchase_code != ''){

                alert(purchase_code);
            }
        });
        
    });
</script>
