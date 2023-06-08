<footer class="footer appear-animate" data-animation-options="{'name': 'fadeIn'}">
			<div class="footer-newsletter bg-primary">
				<div class="container">
					<div class="row justify-content-center align-items-center">
						<div class="col-xl-5 col-lg-6">
							<div class="icon-box icon-box-side text-white">
								<div class="icon-box-icon d-inline-flex">
									<i class="w-icon-envelop3"></i>
								</div>
								<div class="icon-box-content">
									<h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
										Our Newsletter</h4>
									<p class="text-white">Get all the latest information on Events, Sales and Offers.
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
							<form  action="#" method="post"
								class="input-wrapper input-wrapper-inline input-wrapper-rounded subscription" name="subscription" id="subscription">
								@csrf
								<input type="email" class="form-control mr-2 bg-white" name="email" id="email"
									placeholder="Your E-mail Address" />

								<button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
										class="w-icon-long-arrow-right"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="footer-top">
					<div class="row">
						<div class="col-lg-4 col-sm-6">
							<div class="widget widget-about mt-0 mb-4">
								<a href="demo12.html" class="logo-footer">
									<img src="{{url('front/images/demos/demo12/logo.png')}}" alt="logo-footer" width="145"
										height="45" />
								</a>
								<div class="widget-body">
									<p class="widget-about-title">Got Question? Call us 24/7</p>
									<a href="tel:18005707777" class="widget-about-call">{{$contact}}</a>
									

									<div class="social-icons social-icons-colored">
										<a href="https://www.facebook.com/ekmatra.store" class="social-icon social-facebook w-icon-facebook"></a>
										<a href="https://twitter.com/ek_matra" class="social-icon social-twitter w-icon-twitter"></a>
										<a href="https://www.instagram.com/ekmatra.store/" class="social-icon social-instagram w-icon-instagram"></a>
										<a href="https://www.youtube.com/channel/UCG8zYHZfRHJaGsjmBJxM4VQ" class="social-icon social-youtube w-icon-youtube"></a>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="widget">
								<h3 class="widget-title">Company</h3>
								<ul class="widget-body">
									<li><a href="{{url('about-us')}}">About Us</a></li>
									<li><a href="{{url('we-are-hiring')}}">Career</a></li>
									<li><a href="{{url('contact-us')}}">Contact Us</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="widget">
								<h4 class="widget-title">My Account</h4>
								<ul class="widget-body">
									<li>
										@auth
											<a href="{{url('myaccount')}}" class="d-lg-show">My Account</a>
										@else
											<a href="{{url('login')}}" class="ml-0 d-lg-show login sign-in">Sign In</a>
										@endauth
									</li>
									<li><a href="{{url('contact-us')}}">Help</a></li>
									@auth
									<li>
										
											<a href="{{url('catalogue')}}">My Wishlist</a>
										
									</li>
									@endauth
									<li><a href="https://ekmatra.store/assets/pdf/ek-matra-privacy-policy.pdf">Privacy Policy</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="widget">
								<h4 class="widget-title">Our Service</h4>
								<ul class="widget-body">
									  <li><a href="{{url('what-we-do/brandstore')}}">Brand Store</a></li>
                                      <li><a href="{{url('what-we-do/send')}}">Send</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-middle">
					<div class="widget widget-category">
						<div class="category-box">
								@foreach($category as $cat)
									<a  href="{{url('shop/'.$cat['slug'])}}" class="category-name" href="">{{$cat['name']}}</a>
								@endforeach
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<div class="footer-left">
						<p class="copyright">Copyright © <?php echo date('Y') ?> Bwtech.All Rights Reserved.</p>
					</div>
					<div class="footer-right">
						<span class="payment-label mr-lg-8">We're using safe payment for</span>
						<figure class="payment">
							<img src="{{url('front/images/payment.png')}}" alt="payment" width="159" height="25" />
						</figure>
					</div>
				</div>
			</div>
		</footer>
<script type="text/javascript">
	$('.subscription').on('submit', function(e) {
		e.preventDefault()
		let formValue = new FormData(this);
		 $(".sendNow").prop('disabled',true);
		$.ajax({
       		type: "Post",
          url: '{{ url("subscription") }}',
          data: formValue,
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
          	if(response.success){
          		
          		notifyMsg(response.message,'success');
          		 setTimeout(function(){
          		 	window.location.reload();
          		 },1000);
          		

          	}else{
          		notifyMsg(response.message,'error');
            	 $(".sendNow").prop('disabled',false);
          	}
          },
          error: function(response) {
          	let error = response.responseJSON;
            if(!error){
            		error = JSON.parse(response.responseText);
            }
             $(".sendNow").prop('disabled',false);
            $.each( error.errors, function( key, value ) {
            	notifyMsg(value,'error');
            			
						});
				}
	});
	});
</script>