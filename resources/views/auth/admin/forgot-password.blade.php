<x-login-layout>
	<div class="my-auto page page-h">
			<div class="main-signin-wrapper">
				<div class="main-card-signin d-md-flex wd-100p">
				<div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white" >
					<div class="my-auto authentication-pages">
						<div>
							<img src="{{url('logo.png')}}" class=" m-0 mb-4" alt="logo">
							<p>India’s Leading platform for Unique and Innovative Corporate Gifts and Rewards. Trusted by 4000+ Organisations.</p>
						</ul>
						</div>
					</div>
				</div>
				<div class="p-5 wd-md-50p">
					<div class="main-signin-header">
						<h2>Forgot Password!!</h2>
						<h4>Please Enter Your Email</h4>
						<x-auth-session-status class="mb-4" :status="session('status')" />
						<form  name="loginForm" method="POST" id="loginForm" autocomplete="off" action="">
							@csrf
							<div class="form-group">
								<label>Email</label>
								<x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
								<span class="error" id="email_error"></span>
								<x-input-error :messages="$errors->get('email')" class="mt-2" />
							</div>
							
							
							<button type="submit" class="btn btn-main-primary btn-block signinbtn"><span class="submit">{{ __('Sign In') }} </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
						</form>
					</div>
					<div class="main-signin-footer mt-3 mg-t-5">
						<p>Forget it, <a href="{{url('admin/login')}}"> Send me back</a> to the sign in screen.</p>
					 
					</div>
				</div>
			</div>
			</div>
	</div>
</x-login-layout>
<script type="text/javascript">
		$('#loginForm').on('submit', function(e) {
			e.preventDefault();
			 $('.error').text('');
			let formValue = new FormData(this);
				 $(".loading").show();
				 $(".signinbtn").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/forgot-password") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    	  $(".signinbtn").prop('disabled',false);
                        window.location.href ='{{ url("admin/login") }}';
                    },2000);
                } else {
                	 $(".loading").hide();
                	 $('.submit').show();
                	 $(".signinbtn").prop('disabled',false);
                    notifyMsg(response.message,'error');
                }
            },
            error: function(response) {
            		$('.loading').hide();
            	  $('.submit').show();
            	  $(".signinbtn").prop('disabled',false);
                let error = response.responseJSON;
                if(!error){
                    error = JSON.parse(response.responseText);
                }
                $.each( error.errors, function( key, value ) {
  								$("#"+key+"_error").text(value);
								});

            },
        });
	  });
</script>