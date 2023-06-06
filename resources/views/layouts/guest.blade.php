<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	
	@include('layouts.guest-script')
	<body>
			<div class="page-wrapper">
				<h1 class="d-none">Ekmatra</h1>
				<!-- Start of Header -->
					@include('layouts.guest-header')
				 <main class="main">
						{{ $slot }}
				</main>
					@include('layouts.guest-footer')
			</div>
			<div class="sticky-footer sticky-content fix-bottom">
				<a href="{{url('/')}}" class="sticky-link active">
					<i class="w-icon-home"></i>
					<p>Home</p>
				</a>
			 	@auth
				<a href="{{url('myaccount')}}" class="sticky-link">
					<i class="w-icon-account"></i>
					<p>Account</p>
				</a>
				@else
				<a href="{{url('login')}}" class="sticky-link login sign-in ">
					<i class="w-icon-account"></i>
					<p>Account</p>
				</a>

				@endauth

			<div class="cart-dropdown dir-up">
				@auth
				<a href="{{url('wishlist')}}" class="sticky-link">
					<i class="w-icon-cart"></i>
					<p>Wishlist</p>
				</a>
				@else
				<a href="{{url('login')}}" class="sticky-link login sign-in wishlistAuth">
					<i class="w-icon-cart"></i>
					<p>Wishlist</p>
				</a>
				@endauth
			
			<!-- End of Dropdown Box -->
			</div>
			<div class="header-search hs-toggle dir-up">
			<a href="#" class="search-toggle sticky-link">
				<i class="w-icon-search"></i>
				<p>Search</p>
			</a>
			<form action="{{url('search')}}" id="searchMobileViewForm" class="input-wrapper" method="get">
				<input type="text" class="form-control" name="q" autocomplete="off" placeholder="Search"
					required />
				<button class="btn btn-search bg-white searchbtn" type="submit">
					<i class="w-icon-search"></i>
				</button>
			</form>
			</div>
	</div>
	<!-- End of Sticky Footer -->

	<!-- Start of Scroll Top -->
	<a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg
			version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
			<circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
				r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
		</svg> </a>
	<!-- End of Scroll Top -->

	<!-- Start of Mobile Menu -->
	<div class="mobile-menu-wrapper">
		<div class="mobile-menu-overlay"></div>
		<!-- End of .mobile-menu-overlay -->

		<a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
		<!-- End of .mobile-menu-close -->

		<div class="mobile-menu-container scrollable">
			<form action="{{url('search')}}" method="get" class="input-wrapper">
				<input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
					required />
				<button class="btn btn-search" type="submit">
					<i class="w-icon-search"></i>
				</button>
			</form>
			<!-- End of Search Form -->
			<div class="tab">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a href="#main-menu" class="nav-link active">Main Menu</a>
					</li>
					<li class="nav-item">
						<a href="#categories" class="nav-link">Categories</a>
					</li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="tab-pane active" id="main-menu">
					<ul class="mobile-menu">
						<li><a href="{{url('/')}}">Home</a></li>
						<li>
                            <a href="#">Shop By</a>
                            <ul>
                                <li>
                                    <a href="#">Occasions</a>
                                    <ul>
                                        @foreach($occasions as $value)
																					<li><a href="{{url('shop-by/occasions/'.$value['slug'])}}">{{$value['name']}}</a></li>
																					@endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Price</a>
                                    <ul>
                                        <li><a href="{{url('shop-by/price/1-99')}}">Under 100</a></li>
																				<li><a href="{{url('shop-by/price/100-499')}}">100 t0 500</a></li>
																				<li><a href="{{url('shop-by/price/500-999')}}">500 to 1000</a></li>
																				<li><a href="{{url('shop-by/price/1000-4999')}}">1000 to 5000</a></li>
																				<li><a href="{{url('shop-by/price/0-5000')}}">5000 above</a></li>
													
                                    </ul>
                                </li>
                               
                                
                            </ul>
                        </li>
						<li>
							<a href="javascript:void(0)">What We Do</a>
							<ul>
								<li><a href="{{url('what-we-do/brandstore')}}">BrandStore</a></li>
                <li><a href="{{url('what-we-do/send')}}">Send</a></li>
							</ul>
						</li>
					    <li><a href="{{url('/')}}">Our Work</a></li>
					    <li><a href="{{url('/')}}">About Us</a></li>
					    <li><a href="{{url('/')}}">We are hiring</a></li>
					    <li><a href="{{url('contact-us')}}">Conatct Us</a></li>
						<li>
							@auth
							<a href="{{url('submitanenquiry')}}">Request for Quotations</a>
							@else
							<a href="{{url('login')}}" class="sign-in requestforquotation">Request for Quotations</a>
							@endauth
						</li>

						
						
					</ul>
				</div>
				<div class="tab-pane" id="categories">
					<ul class="mobile-menu">
						@foreach($category as $value)
						
						
						<li>
							<a href="{{url('shop/'.$value['slug'])}}">
								<i><img src="{{url('category/'.$value['image'])}}" alt="Categroy" width="15" height="15" /></i>{{$value['name']}}
							</a>
							
						</li>
						
						@endforeach
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Mobile Menu -->

	<!-- Start of Newsletter popup -->
	<div class="productPrice-popup mfp-hide product-single login-popup">
		
		
				<p>Are you want to show price in catalogue?	</p>
				<form method="post" action="{{url('wishlist-download')}}">
					@csrf
					<input type="hidden" value="" id="download_id" name="download_id">
					<div class="row justify-content-center">
					<button type="submit" class="btn btn-dark btn-block col-3 text-center productPriceClose" name="priceShow" value="1"><span class="submit" >Yes</span></button>
					
					<button type="submit" class="btn btn-dark btn-block col-3 ml-lg-3 productPriceClose"   name="priceShow" value="0"><span class="submit">No</span></button>
				</div>
						</form>
	</div>
		
	</div>

	<div class="newsletter-popup mfp-hide newsletterdiv">
		<div class="newsletter-content">
			<h6 class="text-uppercase font-weight-bold ls-25">Save to</h6>
			<div class="d-flex addDiv mt-2 mb-2">

				<span data-v-80b17294="" class="cg-wishlist__cta__toggle quantity-plus w-icon-plus addlist"></span>

				<span data-v-80b17294="" class="cg-wishlist__cta__title ml-2" style=""> Add new list </span>
			</div>
			<div class="d-flex pl-3 addListDiv" style="display:none !important;">
				<input data-v-80b17294="" type="text" class="form-control" id="name">
				<button data-v-80b17294="" type="button" class="btn btn-dark btn-rounded saveWishlist"> ADD LIST </button>
			</div>
			
			

			<input type="hidden" name="product_id" id="product_id">
				<input type="hidden" name="product_price" id="product_price">
			<p class="text-light ls-10"></p>
			
			<div class="form-checkbox d-flex align-items-center">
					<ul class="widget-body filter-items item-check mt-1">
						
					</ul>
				
			</div>
		</div>
	</div>

	<!-- End of Newsletter popup -->
	<div class="mfp-hide  image-popup">
		<div class="image-popup-show">
				<img src="">
		</div>
	</div>
	<!-- Start of Quick View -->
	<div class="product product-single product-popup login-popup">
		<h4>Forgot your password?</h4>
		<p>Enter the email address associated with your account, and we’ll email you a link to reset your password.

</p>
		<form  name="passwordForm" method="POST" id="passwordForm" autocomplete="off" action="">
									@csrf
									<div class="form-group">
											<label>Email *</label>
											<input type="text" class="form-control" name="email" id="email" required  autocomplete="none">
											<span class="error" id="email1_error"></span>
									</div>
									

									<button type="submit" class="btn btn-main-primary btn-block forgotbtn" onClick="forgotPassword()"><span class="submit">Submit</span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
		</form>
	</div>

	<!-- End of Quick view -->
	<!-- Plugin JS File -->
	<script src="{{url('front/vendor/sticky/sticky.js')}}"></script>
	<script src="{{url('front/vendor/jquery.plugin/jquery.plugin.min.js')}}"></script>
	<script src="{{url('front/vendor/swiper/swiper-bundle.min.js')}}"></script>
	<script src="{{url('front/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{url('front/vendor/skrollr/skrollr.min.js')}}"></script>
	<script src="{{url('front/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{url('front/vendor/zoom/jquery.zoom.js')}}"></script>
	<script src="{{url('front/vendor/jquery.countdown/jquery.countdown.min.js')}}"></script>
	<script src="{{url('backend/plugins/notify/js/notifIt.js')}}"></script>



	<!-- Main JS -->
	<script src="{{url('front/js/main.min.js')}}"></script>
	
	</body>
	<script type="text/javascript">
		var multipleProduct = [];
		  $('.searchbtn').click(function(){
		  	$('#searchMobileViewForm').submit();
		  })
			var requestforquotation = '';
			var redirectPage = '';
		  $('.requestforquotation').click(function(){
		  	window.requestforquotation = 1;
		  	window.redirectPage = "{{url('submitanenquiry')}}"
		  });


		   $('.wishlistAuth').click(function(){
		   	window.redirectPage = "{{url('wishlist')}}"
		  	window.requestforquotation = 1;
		  });
			function notifyMsg(msg,type) {
				notif({
					msg: msg,
					type: type
				});
			}
				function wishList(id,price){
    			var id = id;
    			var price = price;
    		
	    		$.ajax({
	       		type: "get",
	            url: '{{ url("userWishlist/") }}'+'/'+id,
	           
	          success: function(response) {
	          		 $(".form-checkbox ul").html(response);
	          		 $("#product_id").val(id);
	          		 $("#product_price").val(price);
	          },
	          error: function(response) {
	          	let error = response.responseJSON;
	          
	          }
	        });
	        Wolmart.popup({
						items:{
							src:'.newsletter-popup'
							},
							type:'inline',
							mainClass:'mfp-newsletter mfp-fadein-popup',
							callbacks:{
								beforeClose:function(){
									$(".form-checkbox").html();
									("#hide-newsletter-popup")[0].checked
								}
							}
						});
       }

      $(document).on('click',"#lastPassword",function(e){
      	 $('.mfp-close').trigger('click');
      	 setTimeout(function() {
      	  Wolmart.popup({
						items:{
							src:'.product-popup'
							},
							type:'inline',
							mainClass:'mfp-product mfp-fadein-popup',
							callbacks:{
								beforeClose:function(){
									$(".form-checkbox").html();
									("#hide-newsletter-popup")[0].checked
								}
							}
					});
					}, 300);
			});
			$(document).on('click', "a.addwishlist", function() {
    		var id = $(this).attr('data-id');
    		var price = $(this).attr('data-price');
    		wishList(id,price);
       });
				
  
			
			$(document).on('click', "a.wishlist", function() {
    		var id = $(this).attr('data-id');
    		var price = $(this).attr('data-price');
    		wishList(id,price);
       });

		  $('.selectmultipleproduct').change(function(){
		  	$(".multipleProduct").attr('checked',this.checked);
		  });
			
			$(document).on('click',".addmultipleProduct",function(){
				multipleProduct = [];
		    $.each($(".multipleProduct:checked"), function(){
		      multipleProduct.push({
		      	'product_id' : $(this).val(),
		      	'price' : $(this).attr('data-price')
		      });
		    });
		    if(multipleProduct.length == 0){
		    		notifyMsg('Please Select at least one product','error');
		    		return false;
		    }
		    wishList(0,0);
			})

			$(document).on('click','span.addlist',function(){
				$('.addListDiv').show();
			})

			$(document).on('click','.saveWishlist',function(){
				var name  = $("#name").val();
				var product_id = $("#product_id").val();
				var product_price = $("#product_price").val();
				 $.ajax({
       		type: "Post",
          url: '{{ url("wishlist/store") }}',
          data: {
            "name": name,
            "product_id" : product_id,
            "product_price" : product_price,
            "multipleProduct" : multipleProduct,
            "_token": "{{ csrf_token() }}",
        	},
          success: function(response) {
          	$("#name").val('');
          	notifyMsg('Prodct has been sent in wishlist','success');
          	$('.cart-count').text(response.count);
          	$(".form-checkbox ul").append(response.html);
          	multipleProduct = [];
          	 $('.mfp-close').trigger('click');
          	 $('.multipleProduct').prop('checked', false);


          },
          error: function(response) {
          	let error = response.responseJSON;
            if(!error){
            		error = JSON.parse(response.responseText);
            }
            $.each( error.errors, function( key, value ) {
  								$("#"+key+"_error").text(value);
						});
          },
       });
			})

		$(document).on('change','#wishlist',function(){
			let msg = '';
			let status = '';
			 if ($(this).is(':checked')) {
			 	 msg = "Prodct has been sent in wishlist";
			 	 status = 'success';
			 }else{
			 	 msg = "Prodct has been removed from wishlist";
			 	 status = 'error';
			 }
			$.ajax({
       		type: "post",
          url: '{{ url("wishlist-assignProduct") }}',
          data: {
            "wishlist_id": $(this).val(),
            "product_id" : $("#product_id").val(),
            'product_price' : $("#product_price").val(),
            "multipleProduct" : multipleProduct,
            "_token": "{{ csrf_token() }}",
        	},
          success: function(response) {
          	notifyMsg(msg,status);
          	$('.cart-count').text(response);
          	multipleProduct = [];
          	 $('.mfp-close').trigger('click');
          	           	 $('.multipleProduct').prop('checked', false);


          },
          
       });
		});
		function forgotPassword(){
			let formValue = new FormData(document.getElementById('passwordForm'));
			 $(".loading").show();
				 $(".forgotbtn").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("forgot-password") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    	  $(".forgotbtn").prop('disabled',false);
                        $('.mfp-close').trigger('click');
                    },2000);
                } else {
                	 $(".loading").hide();
                	 $('.submit').show();
                	 $(".forgotbtn").prop('disabled',false);
                    notifyMsg(response.message,'error');
                }
            },
            error: function(response) {
            		$('.loading').hide();
            	  $('.submit').show();
            	  $(".forgotbtn").prop('disabled',false);
                let error = response.responseJSON;
                if(!error){
                    error = JSON.parse(response.responseText);
                }
                $.each( error.errors, function( key, value ) {
  								$("#"+key+"_error").text(value);
								});

            },
        });
		}
    function signin(){
			 let formValue = new FormData(document.getElementById('loginForm'));
			 $.ajax({
       		type: "post",
          url: '{{ url("login") }}',
          data: formValue,
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
          		 if (response.success) {
          		 		notifyMsg('Logged in successfully','success');
          		 		redirectionPage();
          		 }
          },
          error: function(response) {
          	let error = response.responseJSON;
          	$(".sign-in").addClass('active');
            if(!error){
            		error = JSON.parse(response.responseText);
            }
            $("#email1_error").text(error.errors.email);
           
          },
       });
		}

		 function signup(){
			 let formValue = new FormData(document.getElementById('registerForm'));
			 $.ajax({
       		type: "post",
          url: '{{ url("register") }}',
          data: formValue,
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
          		 if (response.success) {
          		 	notifyMsg('Congrats! you have been registered successfully.','success');
          		 	redirectionPage();
          		 }
          },
          error: function(response) {
          	let error = response.responseJSON;
          		$(".sign-up").addClass('active');
            if(!error){
            		error = JSON.parse(response.responseText);
            }
            $.each( error.errors, function( key, value ) {
  								$("#"+key+"_error").text(value);
						});
          },
       });
		}
		function redirectionPage(){
				setTimeout(function(){
					if(window.requestforquotation == 1){
						window.requestforquotation = 0;
						window.location.href = window.redirectPage;
					}else{
						location.reload();
					}
        },2000);
		}
	</script>
</html>
