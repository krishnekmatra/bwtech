<x-guest-layout>
	<nav class="breadcrumb-nav">
				<div class="container">
					<ul class="breadcrumb bb-no">
						<li><a href="{{url('/')}}">Home</a></li>
						<li><a href="javascript:void(0)">About Us</a></li>
					</ul>
				</div>
			</nav>
			 <div class="page-content">
				<div class="container">
					<section class="introduce mt-20 mb-10">
						<h2 class="title title-center">
							Welcome to Ek Matra Technologies Pvt Ltd!,
						</h2>
						<p class=" mx-auto text-center">We are a rapidly growing technology company based in Mumbai,</p>
					</section>
				  
					<section class="customer-service mb-7 mt-10">
						<div class="row gutter-lg pb-3">
							<div class="col-md-6 pr-lg-8 mb-8">
								<h2 class="title text-left">we are currently looking to hire for the following positions</h2>
								<div class="accordion accordion-simple accordion-plus">
									@foreach($we_are_hiring as $value)
											<div class="card border-no">
												<div class="card-header">
													<a href="#collapse3-{{$loop->index}}" class="{{($loop->index == 0) ? 
												'collapse' : 'expand'}}">{{$value['title']}}</a>
												</div>
												<div class="card-body {{($loop->index == 0) ? 
												'expanded' : 'collapsed'}}" id="collapse3-{{$loop->index}}">
														<p class="mb-0">
														   {{$value['description']}}
														</p>
												</div>
										  </div>
									@endforeach
								</div>
							</div>
							<div class="col-md-6 pr-lg-8 mb-8">
								<h2 class="title mb-3">Send Your Resume</h2>
								<p>We are here to answer any question you may have</p>
								 <form class="form contact-us-form" action="#" method="post" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-6">
											<div class="form-group">
													<label for="username">Name*</label>
													<input type="text" id="name" name="name"
														class="form-control">
														<span class="error mb-2" id="name_error"></span>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group">
													<label for="username">Email*</label>
													<input type="email" id="email" name="email"
														class="form-control">
														<span class="error mb-2" id="email_error"></span>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group">
													<label for="username">Phone*</label>
													<input type="text" id="number" name="number"
														class="form-control">
														<span class="error mb-2" id="number_error"></span>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group">
													<label for="username">Resume*</label>
													<input type="file" id="image" name="image"
														class="form-control">
														<span class="error mb-2" id="image_error"></span>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
													<label for="username">Message*</label>
													<textarea type="text" id="description" name="description"
														class="form-control" cols="3" rows="3"></textarea>
														<span class="error mb-2" id="description_error"></span>
											</div>
										</div>
										<div class="col-3">
										<button type="submit" class="btn btn-dark btn-rounded sendNow">Send Resume</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</section>
					<section class="member-section  pt-9 mb-10 pb-4">
						<div class="container">
						<h4 class="title title-center mb-3">Meet Our Team</h4>
						
						<div class="swiper-container swiper-theme mt-10" data-swiper-options="{
							'spaceBetween': 20,
							'slidesPerView': 1,
							'breakpoints': {
								'576': {
									'slidesPerView': 2
								},
								'768': {
									'slidesPerView': 3
								},
								'992': {
									'slidesPerView': 4
								}
							}
						}">
							<div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-sm-2 cols-1">
								<div class="swiper-slide member-wrap">
									<figure class="br-lg">
										<img src="{{url('aboutus/DSC_1057.jpg')}}" alt="Member" width="295" height="332"  data-zoom-image="{{url('aboutus/DSC_1057.jpg')}}"
                                                            alt="Electronics Black Wrist Watch" width="800" height="900"/>
									
									</figure>
									 <a href="#" class="product-gallery-btn product-image-full" data-zoom-image="{{url('aboutus/DSC_1057.jpg')}}"><i class="w-icon-zoom"></i></a>
								   
								</div>
								<div class="swiper-slide member-wrap">
									<figure class="br-lg">
										 <img src="{{url('aboutus/DSC_5124.jpg')}}" alt="Member" width="295" height="332" />
									   
									</figure>
									 <a href="#" class="product-gallery-btn product-image-full" data-zoom-image="{{url('aboutus/DSC_5124.jpg')}}"><i class="w-icon-zoom"></i></a>
								  
								</div>
								  <div class="swiper-slide member-wrap">
									<figure class="br-lg">
										 <img src="{{url('aboutus/DSC_6470.JPG')}}" alt="Member" width="295" height="332" />
									   
									</figure>
									 <a href="#" class="product-gallery-btn product-image-full" data-zoom-image="{{url('aboutus/DSC_6470.JPG')}}"><i class="w-icon-zoom"></i></a>
								  
								</div>

								 <div class="swiper-slide member-wrap">
									<figure class="br-lg">
										 <img src="{{url('aboutus/DSC_6480.JPG')}}" alt="Member" width="295" height="332" />
									   
									</figure>
									 <a href="#" class="product-gallery-btn product-image-full" data-zoom-image="{{url('aboutus/DSC_6480.JPG')}}"><i class="w-icon-zoom"></i></a>
								  
								</div>

								 <div class="swiper-slide member-wrap">
									<figure class="br-lg">
										 <img src="{{url('aboutus/DSC_6481.JPG')}}" alt="Member" width="295" height="332" />
									   
									</figure>
									 <a href="#" class="product-gallery-btn product-image-full" data-zoom-image="{{url('aboutus/DSC_6481.JPG')}}"><i class="w-icon-zoom"></i></a>
								  
								</div>

								  <div class="swiper-slide member-wrap">
									<figure class="br-lg">
										 <img src="{{url('aboutus/DSC_8112.gif')}}" alt="Member" width="295" height="332" />
									   
									</figure>
									 <a href="#" class="product-gallery-btn product-image-full" data-zoom-image="{{url('aboutus/DSC_8112.gif')}}"><i class="w-icon-zoom"></i></a>
								  
								</div>

								 <div class="swiper-slide member-wrap">
									<figure class="br-lg">
										 <img src="{{url('aboutus/IMG-20230505-WA0013.jpg')}}" alt="Member" width="295" height="332" />
									   
									</figure>
									<a href="#" class="product-gallery-btn product-image-full" data-zoom-image="{{url('aboutus/IMG-20230505-WA0013.jpg')}}"><i class="w-icon-zoom"></i></a>
								  
								  
								</div>
							   
								
							</div>
							<div class="swiper-pagination"></div>
						</div>
						</div>
					</section>
				</div>
			</div>
</x-guest-layout>
<script type="text/javascript">
	 $('.product-image-full').click(function(){
	 // 	  $('div.gallery').magnificPopup({delegate: 'img' , type: 'image', gallery:{enabled:true},

     // callbacks: {
     //      elementParse: function() { this.item.src = this.item.el.attr('src'); }
     // }
	 	let img = $(this).attr('data-zoom-image');
		 Wolmart.popup({
						items:{
							src:img
							},
							type:'image',
							mainClass:'image-popup',
							elementParse:function(){
								this.item.src = this.item.el.attr('src'); 
							},
							callbacks:{
								
							}
					});
					});
		
	
	$('.wearehiring').addClass('active');
	$('.contact-us-form').on('submit', function(e) {
		e.preventDefault()
		let formValue = new FormData(this);
		 $(".sendNow").prop('disabled',true);
		$.ajax({
			type: "Post",
		  url: '{{ url("vacancy/store") }}',
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
						$("#"+key+"_error").show();
								$("#"+key+"_error").text(value);
						});
				}
	});
	});
</script>