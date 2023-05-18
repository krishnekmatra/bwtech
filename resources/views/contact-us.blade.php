<x-guest-layout>
	<nav class="breadcrumb-nav">
				<div class="container">
					<ul class="breadcrumb bb-no">
						<li><a href="{{url('/')}}">Home</a></li>
						<li><a href="javascript:void(0)">Contact Us</a></li>
					</ul>
				</div>
			</nav>
			<div class="page-content contact-us">
				<div class="container">
					<section class="content-title-section mb-10">
						<h3 class="title title-center mb-3">Contact
							Information
						</h3>
						<p class="text-center">{!! nl2br($contact->description) !!}</p>
					</section>
					<!-- End of Contact Title Section -->

					<section class="contact-information-section mb-10 text-center container">
						<div class=" swiper-container swiper-theme " data-swiper-options="{
							'spaceBetween': 20,
							'slidesPerView': 1,
							'breakpoints': {
								'480': {
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

							<div class="swiper-wrapper row cols-xl-4 cols-md-3 cols-sm-2 cols-1">
								<div class="col-md-2 ">
								&nbsp;
								</div>
								<div class="swiper-slide icon-box text-center icon-box-primary ">
									<span class="icon-box-icon icon-email">
										<i class="w-icon-envelop-closed"></i>
									</span>
									<div class="icon-box-content ">
										<h4 class="icon-box-title">E-mail Address</h4>
										<p><a href="https://portotheme.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="ddb0bcb4b19db8a5bcb0adb1b8f3beb2b0">{{$contact['email']}}</a></p>
									</div>
								</div>
								<div class="swiper-slide icon-box text-center icon-box-primary">
									<span class="icon-box-icon icon-headphone">
										<i class="w-icon-headphone"></i>
									</span>
									<div class="icon-box-content">
										<h4 class="icon-box-title">Phone Number</h4>
										<p>{{$contact['phone']}}</p>
									</div>
								</div>
								<div class="swiper-slide icon-box text-center icon-box-primary">
									<span class="icon-box-icon icon-map-marker">
										<i class="w-icon-map-marker"></i>
									</span>
									<div class="icon-box-content">
										<h4 class="icon-box-title">Address</h4>
										<p>{!! nl2br($contact->address) !!}</p>
									</div>
								</div>
								
							</div>
						</div>
					</section>
					<!-- End of Contact Information section -->

					<hr class="divider mb-10 pb-1">

					<section class="contact-section">
						<div class="row gutter-lg pb-3">
							<div class="col-lg-6 mb-8">
								<h4 class="title mb-3">People usually ask these</h4>
								<div class="accordion accordion-bg accordion-gutter-md accordion-border">
									@foreach($faq as $value)
									<div class="card">
										<div class="card-header">
											@if($loop->index == 0)
											<a href="#collapse{{$loop->index}}" class="collapse">{{$value['title']}}</a>
											@else
											<a href="#collapse{{$loop->index}}" class="expand">{{$value['title']}}</a>
											@endif
										</div>
										<div id="collapse{{$loop->index}}" class="card-body {{($loop->index == 0) ? 'expanded' : 'collapsed'}}">
											<p class="mb-0">
												{{$value['description']}}
											</p>
										</div>
									</div>
									@endforeach

								
								</div>
							</div>
							<div class="col-lg-6 mb-8">
								<h4 class="title mb-3">Send Us a Message</h4>
								<form class="form contact-us-form" action="#" method="post">
									@csrf
									<div class="form-group">
										<label for="username">Your Name</label>
										<input type="text" id="username" name="name"
											class="form-control">
											<span class="error" id="name_error"></span>
									</div>
									<div class="form-group">
										<label for="email_1">Your Email</label>
										<input type="email" id="email_1" name="email"
											class="form-control">
											<span class="error" id="email_error"></span>
									</div>
									<div class="form-group">
										<label for="message">Your Message</label>
										<textarea id="message" name="description" cols="30" rows="5"
											class="form-control"></textarea>
											<span class="error" id="description_error"></span>
									</div>
									<button type="submit" class="btn btn-dark btn-rounded sendNow">Send Now</button>
								</form>
							</div>
						</div>
					</section>
					<!-- End of Contact Section -->
				</div>

				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<!-- End Map Section -->
			</div>
</x-guest-layout>
<script type="text/javascript">
	$('.contact-us-form').on('submit', function(e) {
		e.preventDefault()
		let formValue = new FormData(this);
		 $(".sendNow").prop('disabled',true);
		$.ajax({
       		type: "Post",
          url: '{{ url("contact-us/inquiry") }}',
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