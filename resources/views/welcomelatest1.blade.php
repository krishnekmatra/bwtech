<x-guest-layout>
			 
						<div class="container pb-2">
								<!-- End Of Category Wrapper -->

								<div class="intro-section mb-2">
										<div class="row">
												<div class="intro-wrapper col-lg-9 mt-4 mb-4">
														<div class="swiper-container swiper-theme pg-inner pg-white animation-slider"
																data-swiper-options="{
																'spaceBetween': 0,
																'slidesPerView': 1
														}">
																<div class="swiper-wrapper row gutter-no cols-1">
																	  @foreach($banner as $banner_value)
																	   @if($banner_value['type'] == 'main')
																		<div class="swiper-slide banner banner-fixed intro-slide intro-slide{{$loop->index}} br-sm" data-url="{{$banner_value['shop_link']}}"
																				style="background-image: url({{asset('banner/'.$banner_value['image'])}}); background-color: #3F3E3A;">
																			
																		</div>
																		@endif
																		@endforeach
																		
																</div>
																<div class="swiper-pagination"></div>
														</div>
												</div>
												<div class="intro-banner-wrapper col-lg-3 mt-4">
													  @foreach($banner as $sub_value)
													  @if($sub_value['type'] == 'sub')
														<div class="banner banner-fixed intro-banner br-sm mb-4">
																<figure class="br-sm">
																		<img src="{{url('banner/'.$sub_value['image'])}}" alt="Category Banner"
																				width="680" height="180" style="background-color: #565960;" />
																</figure>
																<div class="banner-content">
																		
																		<a href="{{$sub_value['shop_link']}}"
																				class="btn btn-white btn-link btn-slide-right btn-icon-right btn-infinite">
																				Shop Now
																				<i class="w-icon-long-arrow-right"></i>
																		</a>
																</div>
														</div>
														@endif
														@endforeach
														<!-- End of Intro Banner -->
														
												</div>
										</div>
								</div>
								<!-- End of Intro-wrapper -->

								<div class="swiper-container swiper-theme icon-box-wrapper br-sm mt-0 mb-10 appear-animate"
										data-swiper-options="{
										'slidesPerView': 1,
										'breakpoints': {
												'576': {
														'slidesPerView': 2
												},
												'992': {
														'slidesPerView': 3
												},
												'1200': {
														'slidesPerView': 4
												}
										}}">
										<div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
												<div class="swiper-slide icon-box icon-box-side text-dark">
														<span class="icon-box-icon icon-shipping">
																<i class="w-icon-truck"></i>
														</span>
														<div class="icon-box-content">
																<h4 class="icon-box-title font-weight-bolder">Free Shipping &amp; Returns</h4>
																<p class="text-default">For all orders over $99</p>
														</div>
												</div>
												<div class="swiper-slide icon-box icon-box-side text-dark">
														<span class="icon-box-icon icon-payment">
																<i class="w-icon-bag"></i>
														</span>
														<div class="icon-box-content">
																<h4 class="icon-box-title font-weight-bolder">Secure Payment</h4>
																<p class="text-default">We ensure secure payment</p>
														</div>
												</div>
												<div class="swiper-slide icon-box icon-box-side text-dark icon-box-money">
														<span class="icon-box-icon icon-money">
																<i class="w-icon-money"></i>
														</span>
														<div class="icon-box-content">
																<h4 class="icon-box-title font-weight-bolder">Money Back Guarantee</h4>
																<p class="text-default">Any back within 30 days</p>
														</div>
												</div>
												<div class="swiper-slide icon-box icon-box-side text-dark icon-box-chat mt-0">
														<span class="icon-box-icon icon-chat">
																<i class="w-icon-chat"></i>
														</span>
														<div class="icon-box-content">
																<h4 class="icon-box-title font-weight-bolder">Customer Support</h4>
																<p class="text-default">Call or email us 24/7</p>
														</div>
												</div>
										</div>
								</div>
								<!-- End of Iocn Box Wrapper -->

								<div class="title-link-wrapper title-select after-none appear-animate">
										<h2 class="title font-secondary font-weight-bolder">Latest Products</h2>
										<a href="{{url('shop/product')}}" class="font-weight-bold ls-25">
												More Products
												<i class="w-icon-long-arrow-right"></i>
										</a>
								</div>
								<div class="swiper-container swiper-theme select-product-wrapper shadow-swiper appear-animate pb-2 mb-10"
										data-swiper-options="{
										'spaceBetween': 20,
										'slidesPerView': 2,
										'breakpoints': {
												'768': {
														'slidesPerView': 3
												},
												'992': {
														'slidesPerView': 4
												},
												'1200': {
														'slidesPerView': 5
												}
										}
										}">
										<div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-sm-3 cols-2">
												@foreach($product as $product_value)
											   <div class="swiper-slide product product-image-gap product-simple">
							<figure class="product-media">
								<a href="{{url('product-detail/'.$product_value['slug'])}}">
									<img src="{{url('product/'.$product_value['image'])}}" alt="Product" width="295"
										height="335" />
									<img src="{{url('product/'.$product_value['image'])}}" alt="Product" width="295"
										height="335" />
								</a>
							   
								<div class="product-action">
									<a href="{{url('product-detail/'.$product_value['slug'])}}" class="btn-product " title="Quick View">QuickView</a>
								</div>
							</figure>
							<div class="product-details">
							  
								<h4 class="product-name">
									<a href="{{url('product-detail/'.$product_value['slug'])}}">{{$product_value['name']}}</a>
								</h4>
								
								<div class="product-pa-wrapper">
									<div class="product-price">
										<ins class="new-price">MRP : {{$product_value['mrp']}}</ins>
									</div>
									<div class="product-price">
										Min Qty : <ins class="new-price">{{$product_value['maq']}}</ins>
									</div>
									<div class="product-action">
									   @auth
																									<a href="javascript:void(0)" class="btn-cart btn-product btn btn-link btn-underline wishlist" data-id="{{$product_value['id']}}" >Add To Wishlist</a>
																									@else
																									<a href="{{url('login')}}" class="btn-cart btn-product btn btn-link btn-underline  sign-in">Add to Wishlist</a>
																									@endauth
									</div>
								</div>
							</div>
						</div>
											  @endforeach
										</div>
								</div>
								<!-- End of Selected Products Wrapper -->

								<div class="notification-wrapper bg-primary br-sm mb-10 appear-animate d-flex align-items-center justify-content-center"
										style="animation-duration: 1.2s;">
										<i class="w-icon-mobile text-white"></i>
										<p class="font-secondary text-white">Download our new app today! Dont Miss our mobile-only offers
												and shop with Android Play.</p>
										<a href="#"
												class="btn btn-white btn-sm btn-outline btn-rounded btn-icon-right font-weight-bold text-capitalize">
												Download
												<i class="w-icon-long-arrow-down"></i>
										</a>
								</div>
								<!-- End of Notificateion Wrapper -->

								<h2 class="title title-vendors font-secondary mb-4 appear-animate">Top Weekly Vendors</h2>
								<div class="swiper-container swiper-theme mb-6 pb-2 appear-animate" data-swiper-options="{
										'spaceBetween': 20,
										'slidesPerView': 1,
										'breakpoints': {
												'576': {
														'slidesPerView': 2
												},
												'768': {
														'slidesPerView': 3
												},
												'1200': {
														'slidesPerView': 4
												}
										}
								}">
										<div class="swiper-wrapper row cols-lg-4 cols-md-3 cols-sm-2 cols-1">
												@foreach($vendor as $value)
												<div class="swiper-slide vendor-widget mb-0">
														<div class="vendor-widget-2">
																<div class="vendor-details">
																		<figure class="vendor-logo">
																				<a href="#">
																						<img src="{{url('vendor/'.$value['image'])}}" alt="Vendor Logo"
																								width="70" height="70" />
																				</a>
																		</figure>
																		<div class="vendor-personal">
																				<h4 class="vendor-name">
																						<a href="#">{{$value['name']}}</a>
																				</h4>
																				<span class="vendor-product-count">({{$value['products_count']}} Products)</span>
																				
																		</div>
																</div>
																<div class="vendor-products row cols-3 gutter-sm">
																	<?php $latest_product = $value->getVendorTopProducts->take(3);?>

																	 @foreach($latest_product as $vendor_product)
																		<div class="vendor-product">
																				<figure class="product-media">
																						<a href="{{url('product-detail/'.$vendor_product['slug'])}}">
																								<img src="{{url('product/'.$vendor_product['image'])}}"
																										alt="Vendor Product" width="100" height="113" />
																						</a>
																				</figure>
																		</div>
																	 @endforeach
																		
																</div>
														</div>
												</div>
												@endforeach
											
										</div>
										<div class="swiper-pagination mt-4"></div>
								</div>
								<!-- End of Swiper -->

								<div class="banner-wrapper appear-animate row cols-md-2 mb-7">
									 @foreach($banner as $banner_value)
										@if($banner_value['type'] == 'sale')
										<div class="banner banner-fixed overlay-dark br-sm mt-4">
												<figure class="br-sm">
														<img src="{{url('banner/'.$banner_value['image'])}}" alt="Category Banner" width="680"
																height="180" style="background-color: #565960;" />
												</figure>
												<div class="banner-content y-50">
														<h4 class="banner-price-info text-lighter font-secondary font-weight-normal mb-0">
																Flash Sale
																<span class="text-primary font-weight-bolder">50% OFF</span>
														</h4>
														<h2 class="banner-title text-white font-secondary">Wireless HeadPhone</h2>
														<h3 class="banner-subtitle text-lighter font-weight-normal">Only until the end of this Week
														</h3>
														<a href="#"
																class="btn btn-sm btn-outline btn-white btn-rounded btn-icon-right slide-animate">
																Shop Now
																<i class="w-icon-long-arrow-right"></i>
														</a>
												</div>
										</div>
									@endif
									@endforeach
										
								</div>
								<!-- End of Banner-wrapper -->

								<div class="title-link-wrapper title-deals after-none appear-animate">
										<h2 class="title font-secondary mb-1">Deals Hot Of The Day</h2>
										<a href="#" class="font-weight-bold ls-25">
												More Products
												<i class="w-icon-long-arrow-right"></i>
										</a>
								</div>
								<div class="swiper-container swiper-theme mb-4 pg-inner animation-slider" data-swiper-options="{
										'spaceBetween': 20,
										'slidesPerView': 1,
										'breakpoints': {
												'992': {
														'slidesPerView': 2
												}
										}
										}">
										<div class="swiper-wrapper row cols-lg-2">
												<div class="swiper-slide ">
														<div class="product product-list br-sm mb-0">
																<figure class="product-media">
																		<a href="#">
																				<img src="{{url('front/images/demos/demo12/products/1-1-1.jpg')}}" alt="Product"
																						width="315" height="355">
																				<img src="{{url('front/images/demos/demo12/products/1-1-2.jpg')}}" alt="Product"
																						width="315" height="355">
																		</a>
																		<div class="product-action-vertical">
																				<a href="#" class="btn-product-icon btn-quickview w-icon-search"
																						title="Quick View"></a>
																		</div>
																		<div class="product-countdown-container mb-0">
																				<div class="product-countdown countdown-compact" data-until="2021, 9, 9"
																						data-format="DHMS" data-compact="false"
																						data-labels-short="Days, Hours, Mins, Secs">
																						00:00:00:00</div>
																		</div>
																</figure>
																<div class="product-details">
																		<h4 class="product-name">
																				<a href="#">Automatic Watch</a>
																		</h4>
																		<div class="ratings-container mb-2">
																				<div class="ratings-full">
																						<span class="ratings" style="width: 100%;"></span>
																						<span class="tooltiptext tooltip-top"></span>
																				</div>
																				<a href="#" class="rating-reviews">(1 Reviews)</a>
																		</div>
																		<div class="product-price text-primary">$20.72 - $79.20</div>
																		<p class="text-default">Aliquam id diam maecenas ultricies me. Volutpat ac tincidunt
																				vitae sempe. Ultrices eros in cursus turpis massa tine.</p>
																		<div class="product-action">
																				<a href="#" class="btn-dark btn-product"
																						title="Select Options">
																						<i class="w-icon-cart"></i>
																						<span>Select Options</span>
																				</a>
																				
																		</div>
																</div>
														</div>
												</div>
												<div class="swiper-slide ">
														<div class="product product-list br-sm mb-0">
																<figure class="product-media">
																		<a href="#">
																				<img src="{{url('front/images/demos/demo12/products/1-4-1.jpg')}}" alt="Product"
																						width="315" height="355">
																				<img src="{{url('front/images/demos/demo12/products/1-4-2.jpg')}}" alt="Product"
																						width="315" height="355">
																		</a>
																		<div class="product-action-vertical">
																				<a href="#" class="btn-product-icon btn-quickview w-icon-search"
																						title="Quick View"></a>
																		</div>
																		<div class="product-countdown-container mb-0">
																				<div class="product-countdown countdown-compact" data-until="2021, 9, 9"
																						data-format="DHMS" data-compact="false"
																						data-labels-short="Days, Hours, Mins, Secs">
																						00:00:00:00</div>
																		</div>
																</figure>
																<div class="product-details">
																		<h4 class="product-name">
																				<a href="#">Mini Wireless Earphone</a>
																		</h4>
																		<div class="ratings-container mb-2">
																				<div class="ratings-full">
																						<span class="ratings" style="width: 100%;"></span>
																						<span class="tooltiptext tooltip-top"></span>
																				</div>
																				<a href="#" class="rating-reviews">(1 Reviews)</a>
																		</div>
																		<div class="product-price text-primary">$59.17 - $129.27</div>
																		<p class="text-default">Aliquam id diam maecenas ultricies me. Volutpat ac tincidunt
																				vitae sempe. Ultrices eros in cursus turpis massa tine.</p>
																		<div class="product-action">
																				<a href="#" class="btn-dark btn-product"
																						title="Select Options">
																						<i class="w-icon-cart"></i>
																						<span>Select Options</span>
																				</a>
																				
																		</div>
																</div>
														</div>
												</div>
												<!-- End of Product List -->
										</div>
								</div>
								<!-- End of Swiper -->

								
								<!-- End of Swiper -->
						</div>
						<div class="banner banner-fixed purchase-banner appear-animate">
							   @foreach($banner as $banner_value)
										@if($banner_value['type'] == 'special')
								<figure class="banner-img">
										<img src="{{url('banner/'.$banner_value['image'])}}" alt="Banner" width="680" height="180"
												style="background-color: #342E30;" />
								</figure>
								@endif
								@endforeach
								<div class="banner-content text-center x-50 y-50 slide-animate"
										data-animation-options="{'name': 'fadeInLeftShorter', 'duration': '15s', 'delay': '3s'}">
										<h3 class="banner-subtitle text-primary text-uppercase font-secondary font-weight-bold">Today's
												Special</h3>
										<h2 class="banner-title text-white text-uppercase font-secondary font-weight-bolder mb-2">Trending
												Accessories Collection</h2>
										<p class="text-lighter font-weight-normal">
												Free shipping on clearance orders of <span class="text-primary font-weight-bolder"> $120
												</span>or more
										</p>
										<a href="#"
												class="btn btn-lg btn-outline btn-white btn-rounded btn-icon-right slide-animate">
												Purchase Now
												<i class="w-icon-long-arrow-right"></i>
										</a>
								</div>
						</div>
						<!-- End of Banner -->
						<div class="container">
								<h2
										class="title title-latest-product font-secondary font-weight-bolder justify-content-center ls-normal mt-10 mb-2 pt-1 appear-animate">
										Latest Products
								</h2>
								<div class="tab tab-latest-product tab-nav-center tab-nav-underline tab-line-grow appear-animate">
										<ul class="nav nav-tabs bb-no justify-content-center" role="tablist">
											  @foreach($deal as $key=>$deal_value)
												<li class="nav-item mb-2">
														<a class="nav-link {{($loop->iteration == 1) ? 'active' :'' }} ls-normal" href="#tab1-{{ $loop->iteration }}">{{$deal_value['name']}}</a>
												</li>
												@endforeach
												
										</ul>
								</div>
								<!-- End of Tab -->
								<div class="tab-content product-wrapper appear-animate">
									  @foreach($deal as $key=>$deal_value)
										<div class="tab-pane {{($loop->iteration == 1) ? 'active' :'' }}" id="tab1-{{ $loop->iteration }}">
												<div class="swiper-container swiper-theme latest-product-wrapper shadow-swiper appear-animate mb-0"
														data-swiper-options="{
														'spaceBetween': 20,
														'slidesPerView': 2,
														'breakpoints': {
																'576': {
																		'slidesPerView': 2
																},
																'768': {
																		'slidesPerView': 3
																},
																'992': {
																		'slidesPerView': 4
																},
																'1200': {
																		'slidesPerView': 5
																}
														}
														}">
														<div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-sm-3 cols-2">
															  @foreach($deal_value['productDeals'] as $product_deals)
																<div class="swiper-slide">
																		<div class="product product-image-gap product-simple">
																				<figure class="product-media">
																						<a href="">
																								<img src="{{url('product/'.$product_deals['getProduct']['image'])}}" alt="Product"
																										width="295" height="335" />
																								<img src="{{url('product/'.$product_deals['getProduct']['image'])}}" alt="Product"
																										width="295" height="335" />
																						</a>
																						
																						<div class="product-action">
																								<a href="{{url('product-detail/'.$product_deals['getProduct']['slug'])}}" class="btn-product" title="Quick View">Quick
																										View</a>
																						</div>
																						
																				</figure>
																				<div class="product-details">

																						<h4 class="product-name">
																								<a href="{{url('product-detail/'.$product_deals['getProduct']['slug'])}}">{{$product_deals['getProduct']['name']}}</a>
																						</h4>
																						
																					
													<div class="product-pa-wrapper">
														<div class="product-price">
														<ins class="new-price">MRP : {{$product_value['mrp']}}</ins>

														</div>
														<div class="product-price">
															Min Qty : <ins class="new-price">{{$product_value['maq']}}</ins>

														</div>
														<div class="product-action">
															@auth
																									<a href="javascript:void(0)" class="btn-cart btn-product btn btn-link btn-underline wishlist" data-id="{{$product_value['id']}}" >Add To Wishlist</a>
																									@else
																									<a href="{{url('login')}}" class="btn-cart btn-product btn btn-link btn-underline  sign-in">Add to Wishlist</a>
																									@endauth
														</div>
													</div>
																				</div>
																		</div>
																		
																</div>
																@endforeach
																
														</div>
												</div>
										</div>
										@endforeach
										
										<!-- End of Tab Pane -->
								</div>
								<!-- End of Tab Content -->
								  @foreach($banner as $banner_value)
										@if($banner_value['type'] == 'download')
										<?php $url = url('banner')."/".$banner_value['image'];?>
										@endif
								 @endforeach
								<div class="banner link-banner-newsletter d-flex mb-8 align-items-center row gutter-no br-sm appear-animate"
										style="background-image: url('banner/'.{{$download}});
										background-color: #27393D;">
										<div class="col-xl-5 col-lg-4 mr-auto">
												<figure class="banner-media d-lg-show">
														<img src="{{url('front//images/demos/demo12/banner/image-2.png')}}" alt="Banner-image">
												</figure>
										</div>
										<div class="banner-content col-xl-5 col-lg-6 col-sm-8 mb-4">
												<h2 class="banner-title text-white text-capitalize font-secondary font-weight-bolder">Download
														Ekmatra App Now!</h2>
												<p>
														Shopping fastly and easily more with our app. Get a link to download the app on your phone.
												</p>
												<form action="#" method="get"
														class="input-wrapper input-wrapper-inline flex-wrap input-wrapper-rounded text-dark">
														<input class="form-control text-dark br-xs bg-white mr-2" type="email"
																placeholder="Enter Your Email..." name="email" id="email_4" required>
														<button class="btn btn-primary btn-rounded br-xs" type="submit">Send Link</button>
												</form>
										</div>
										<div class="col-lg-2 col-sm-4 newsletter-button">
												<a href="#">
														<img src="{{url('front//images/demos/demo12/banner/button-1.jpg')}}" class="mb-4" alt="Button"
																width="141" height="41" style="background-color: #121315" />
												</a>
												<a href="#">
														<img src="{{url('front//images/demos/demo12/banner/button-2.jpg')}}" alt="Button" width="141"
																height="41" style="background-color: #121315" />
												</a>
										</div>
										<!-- End of Content Right -->
								</div>
								<!-- End of Link Banner Newsletter -->

								<h2 class="title title-brands text-left title-client font-secondary pt-3 pb-1 mt-3 mb-4 appear-animate">
										Our Clients</h2>
								<div class="swiper-container swiper-theme brands-wrapper br-sm mb-10 appear-animate"
										data-swiper-options="{
										'loop': true,
										'spaceBetween': 0,
										'slidesPerView': 2,
										'autoplay': {
												'delay': 4000,
												'disableOnInteraction': false
										},
										'breakpoints': {
												'576': {
														'slidesPerView': 3
												},
												'768': {
														'slidesPerView': 4
												},
												'992': {
														'slidesPerView': 6
												},
												'1200': {
														'slidesPerView': 8
												}
										}
								}">
										<div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-2">
											  @foreach($vendor as $value)
												<div class="swiper-slide">
														<figure>
																<img src="{{url('front/images/demos/demo12/brands/1.png')}}" alt="Brand" width="290"
																		height="100" />
														</figure>
												</div>
												@endforeach
												<div class="swiper-slide">
														<figure>
																<img src="{{url('front/images/demos/demo12/brands/2.png')}}" alt="Brand" width="290"
																		height="100" />
														</figure>
												</div>
												<div class="swiper-slide">
														<figure>
																<img src="{{url('front/images/demos/demo12/brands/3.png')}}" alt="Brand" width="290"
																		height="100" />
														</figure>
												</div>
												<div class="swiper-slide">
														<figure>
																<img src="{{url('front/images/demos/demo12/brands/4.png')}}" alt="Brand" width="290"
																		height="100" />
														</figure>
												</div>
												<div class="swiper-slide">
														<figure>
																<img src="{{url('front/images/demos/demo12/brands/5.png')}}" alt="Brand" width="290"
																		height="100" />
														</figure>
												</div>
												<div class="swiper-slide">
														<figure>
																<img src="{{url('front/images/demos/demo12/brands/6.png')}}" alt="Brand" width="290"
																		height="100" />
														</figure>
												</div>
												<div class="swiper-slide">
														<figure>
																<img src="{{url('front/images/demos/demo12/brands/7.png')}}" alt="Brand" width="290"
																		height="100" />
														</figure>
												</div>
												<div class="swiper-slide">
														<figure>
																<img src="{{url('front/images/demos/demo12/brands/8.png')}}" alt="Brand" width="290"
																		height="100" />
														</figure>
												</div>
										</div>
								</div>
								<!-- End of Brands Wrapper -->

								
								
						</div>
						<!-- End of Container -->

				<!-- End of Main -->

				<!-- Start of Footer -->
				
				<!-- End of Footer -->
	 
		<!-- End of Page-wrapper -->

		<!-- Start of Sticky Footer -->
</x-guest-layout>

<script type="text/javascript">
	$('.swiper-slide').click(function(e) {  
    var url = $(this).attr('data-url');
    window.location.href = url;

});
W
	let login = "{{\Session::get('isLogin')}}";
	if(login == 1){
		Wolmart.popup(
		{
			items:{
				src:'login'
			}
		},"login");     
	}
</script>