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
																				Explore Now
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

								<div class="title-link-wrapper title-select after-none appear-animate d-flex justify-content-between align-items-center">
										<h2 class="title font-secondary font-weight-bolder">Latest Products</h2>
										 <div class="d-flex justify-content-end align-items-center">
										 	<a class="select-allhref"><input type="checkbox" name="selectallproduct" class="selectalllatestproduct" data-type='latest'><label>Select All</label></a>
										 @auth
                                                <a href="javascript:void(0)"
                                                    class="addmultipleProduct text-white btn btn-dark btn-rounded mb-2 mb-lg-0  Catalogue-btn ml-1">Add To Catalogue &nbsp;&nbsp;</a>
                                                @else
                                                        <a href="{{url('login')}}"
                                                    class="btn btn-dark btn-rounded sign-in mb-2 mb-lg-0  Catalogue-btn ml-1">Add To Catalogue &nbsp;&nbsp;</a>
                                                @endauth
										<a href="{{url('shop/product')}}" class="font-weight-bold ls-25 mt-1 ml-1">
												More Products
												<i class="w-icon-long-arrow-right line-height-inherit"></i>
										</a>
                  </div>
								</div>
								 <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2 latestProduct">
                        	 @foreach($product as $product_val)
                            <div class="product-wrap mt-2">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{url('product-detail/'.$product_val['slug'])}}">
                                            <img src="{{url('product/'.$product_val['image'])}}" alt="Product"
                                                width="300" height="338" />
                                        </a>
                                        <div class="product-action-vertical">
                                          	 <a class="mt-2 multipproductcheckbox">
								 																<input type="checkbox" class="multipleProduct latestproductCheck" name="multipleProduct" value="{{$product_val['id']}}" data-price="{{$product_val['price']}}"/>
																						</a>
                                            @auth
								 																<a href="#" class="btn-product-icon btn-wishlist w-icon-heart wishlist" data-id="{{$product_val['id']}}" data-price="{{$product_val['price']}}"
                                                title="Add to wishlist"></a>
                                					 @else
                                						<a href="{{url('login')}}" class="btn-product-icon btn-wishlist w-icon-heart  sign-in"></a>
                                					@endif
                                  						<a href="{{url('product-detail/'.$product_val['slug'])}}" class="btn-product-icon  w-icon-search mt-2"
                                                title="Quickview"></a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="{{url('product-detail/'.$product_val['slug'])}}">{{$product_val['name']}}</a></h4>
                                        
                                        <div class="product-price">
                                            <ins class="new-price">Price : {{$product_val['price']}}</ins>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                           @endforeach
                            
                        </div>
								<!-- End of Selected Products Wrapper -->


								
								<!-- End of Swiper -->

								<div class="banner-wrapper appear-animate row cols-md-2 mb-7">
									 @foreach($banner as $banner_value)
										@if($banner_value['type'] == 'sale')
										<div class="banner banner-fixed overlay-dark br-sm mt-10">
												<figure class="br-sm">
														<img src="{{url('banner/'.$banner_value['image'])}}" alt="Category Banner" width="680"
																height="180" style="background-color: #565960;" />
												</figure>
												<div class="banner-content y-50">
														<a href="{{$banner_value['shop_link']}}"
																class="btn btn-sm btn-outline btn-white btn-rounded btn-icon-right slide-animate">
																Explore Now
																<i class="w-icon-long-arrow-right"></i>
														</a>
												</div>
										</div>
									@endif
									@endforeach
										
								</div>
								<!-- End of Banner-wrapper -->

							
								
								<!-- End of Swiper -->

								
								<!-- End of Swiper -->
						</div>
						<div class="banner banner-fixed purchase-banner appear-animate mb-10">
							   @foreach($banner as $banner_value)
										@if($banner_value['type'] == 'special')
								<figure class="banner-img">
										<img src="{{url('banner/'.$banner_value['image'])}}" alt="Banner" width="680" height="180"
												style="background-color: #342E30;" />
								</figure>
								<div class="banner-content text-center x-50 y-50 slide-animate"
										data-animation-options="{'name': 'fadeInLeftShorter', 'duration': '15s', 'delay': '3s'}">
										
										
										<a href="{{$banner_value['shop_link']}}"
												class="btn btn-lg btn-outline btn-white btn-rounded btn-icon-right slide-animate" target="_blank">
												Explore Now
												<i class="w-icon-long-arrow-right"></i>
										</a>
								</div>
								@endif
								@endforeach
								
						</div>
						<!-- End of Banner -->
						<div class="container">
							<div class="tab tab-nav-boxed tab-nav-outline appear-animate">
                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                    	 @foreach($deal as $key=>$deal_value)
                        <li class="nav-item mr-2 mb-2">
                          
                            <a class="nav-link {{($loop->iteration == 1) ? 'active' :'' }}  br-sm font-size-md ls-normal" href="#tab1-{{ $loop->iteration }}">{{$deal_value['name']}}</a>
                        </li>
                       
                        @endforeach
                    </ul>
                </div>
                <!-- End of Tab -->
                <div class="tab-content product-wrapper appear-animate">
                	 <div class="d-flex justify-content-end">
                	 		<a class="select-allhref"><input type="checkbox" name="selectallproduct" class="selectalllatestproduct" data-type='deal'><label>Select All</label></a>
                	 @auth
                                                <a href="javascript:void(0)"
                                                    class="addmultipleProduct btn btn-dark btn-rounded mb-2 mb-lg-0  Catalogue-btn">Add To Catalogue &nbsp;&nbsp;</a>
                                                @else
                                                        <a href="{{url('login')}}"
                                                    class="btn btn-dark btn-rounded sign-in mb-2 mb-lg-0  Catalogue-btn">Add To Catalogue &nbsp;&nbsp;</a>
                                                @endauth
                	<a href="{{url('deals/product')}}" class="font-weight-bold ls-25 text-right ml-1 more-product">
												More Products
												<i class="w-icon-long-arrow-right"></i>
										</a>
									</div>
                	   @foreach($deal as $key=>$deal_value)
                    <div class="tab-pane {{($loop->iteration == 1) ? 'active' :'' }} pt-4 dealProduct" id="tab1-{{ $loop->iteration }}">
                        <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        	 @foreach($deal_value['productDeals'] as $product_deals)
                            <div class="product-wrap mt-2">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{url('product-detail/'.$product_deals['getProduct']['slug'])}}">
                                            <img src="{{url('product/'.$product_deals['getProduct']['image'])}}" alt="Product"
                                                width="300" height="338" />
                                        </a>
                                        <div class="product-action-vertical">
                                          <a class="mt-2 multipproductcheckbox">
								 																<input type="checkbox" class="multipleProduct selectdealproduct" name="multipleProduct" value="{{$product_deals['getProduct']['id']}}" data-price="{{$product_deals['getProduct']['price']}}" />
																						</a>
                                            @auth
								 																<a href="#" class="btn-product-icon btn-wishlist w-icon-heart wishlist" data-id="{{$product_deals['getProduct']['id']}}" data-price="{{$product_deals['getProduct']['price']}}"
                                                title="Add to wishlist"></a>
                                					 @else
                                						<a href="{{url('login')}}" class="btn-product-icon btn-wishlist w-icon-heart  sign-in"></a>
                                					@endif
                                  						<a href="{{url('product-detail/'.$product_deals['getProduct']['slug'])}}" class="btn-product-icon  w-icon-search mt-2"
                                                title="Quickview"></a>
                                            
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="{{url('product-detail/'.$product_deals['getProduct']['slug'])}}">{{$product_deals['getProduct']['name']}}</a></h4>
                                       
                                        <div class="product-price">
                                            <ins class="new-price">Price : {{$product_deals['getProduct']['price']}}</ins>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                           @endforeach
                            
                        </div>
                    </div>
                    @endforeach
                </div>
								
							

							
							
								<!-- End of Link Banner Newsletter -->

								
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
    if(url){
    	    window.location.href = url;

    }

});

	let login = "{{\Session::get('isLogin')}}";
	if(login == 1){
		Wolmart.popup(
		{
			items:{
				src:'login'
			}
		},"login");     
	}
	$('.selectalllatestproduct').change(function(){
		var type = $(this).attr('data-type');
		if(type === 'deal'){
			$(".selectdealproduct").attr('checked',this.checked);
		}else{
			$(".latestproductCheck").attr('checked', this.checked);
		}
		
	});
</script>