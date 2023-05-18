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
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                           
                          
                            <div class="form-group">
                                <label>New password</label>
                                <x-text-input id="password" class="form-control" type="password" name="password" :value="old('password')" required/>
                                <span class="error" id="password_error"></span>
                            </div>
                             <div class="form-group">
                                <label>Confirm Password</label>
                                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" :value="old('password_confirmation')" required/>
                                <span class="error" id="password_confirmation_error"></span>
                              
                            </div>
                            
                            
                            <button type="submit" class="btn btn-main-primary btn-block signinbtn"><span class="submit">{{ __('Sign In') }} </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
                        </form>
                    </div>
                    <div class="main-signin-footer mt-3 mg-t-5">
                        <p>Forget it, <a href="{{url('/')}}" class="login sign-in"> Send me back</a> to the sign in screen.</p>
                     
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
            url: '{{ route("adminpassword.store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                        notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                          $(".signinbtn").prop('disabled',false);
                        window.location.href ='{{ url("/") }}';
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