<x-guest-layout>
	 
			<!-- End of Breadcrumb -->
 <nav class="breadcrumb-nav">
				<div class="container">
					<ul class="breadcrumb bb-no">
						<li><a href="{{url('/')}}">Home</a></li>
						<li>Product</li>
					</ul>
				</div>
			</nav>
			<!-- Start of Page Content -->
			<div class="page-content">
				<div class="container">
					<div class="row gutter-lg">
						<div class="main-content">
							<div class="product product-single row">
								<div class="col-md-6 mb-6">
									<div class="product-gallery product-gallery-sticky">
										<div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
											'navigation': {
												'nextEl': '.swiper-button-next',
												'prevEl': '.swiper-button-prev'
											}
										}">
											<div class="swiper-wrapper row cols-1 gutter-no">
												<div class="swiper-slide">
													<figure class="product-image">
														<img src="{{url('product/'.$product['image'])}}"
															data-zoom-image="{{url('product/'.$product['image'])}}"
															alt="Electronics Black Wrist Watch" width="800" height="900">
													</figure>
												</div>
												
												
											
												
												
											</div>
											
											
										</div>
										
									</div>
								</div>
								<div class="col-md-6 mb-4 mb-md-6">
									<div class="product-details" data-sticky-options="{'minWidth': 767}">
										<h1 class="product-title">{{$product['name']}}</h1>
										<div class="product-bm-wrapper">
											<div class="product-meta">
												<div class="product-categories">
													Category:
													<span class="product-category"><a href="#">{{$product['category']['name']}}</a></span>
												</div>
												<div class="product-sku">
													SubCategory: <span>{{$product['subCategory']['name']}}</span>
												</div>
												<div class="product-sku mt-2">
													Brand: <span>{{$product['feature_attributes']['name']}}</span>
												</div>
											</div>
										</div>

										<hr class="product-divider">

										<div class="product-price">
												<ins class="new-price">MRP : {{$product['mrp']}}</ins>
										</div>

										


										<hr class="product-divider">

										@if($product['productFeatures'])
											@foreach($product['productFeatures'] as $pro_value)
												<div class="product-form product-variation-form product-color-swatch">
													<label>{{$pro_value['feature_name']['name']}}</label>
												
													 <div class="d-flex align-items-center product-variations">
													 	 <a href="#">
													 	 		@if($pro_value['feature_attribute_name'])
													 	 			{{$pro_value['feature_attribute_name']['name']}}
													 	 		@else
													 	 			{{$pro_value['value']}}
													 	 		@endif
													 	 </a>
													 </div>
												
												</div>
											@endforeach
										@endif
										<div class="product-form product-variation-form product-color-swatch">
                                            <label>Color:</label>
                                            <div class="d-flex align-items-center product-variations">
                                                <a href="#" class="color" style="background-color: #ffcc01"></a>
                                                <a href="#" class="color" style="background-color: #ca6d00;"></a>
                                                <a href="#" class="color" style="background-color: #1c93cb;"></a>
                                                <a href="#" class="color" style="background-color: #ccc;"></a>
                                                <a href="#" class="color" style="background-color: #333;"></a>
                                            </div>
                                        </div>

								

										<div class="product-sticky-content sticky-content">
											<div class="product-form container ">
												@auth
												<a href="javascript:void(0)"
													class="addwishlist btn btn-dark btn-rounded mb-2 mb-lg-0" data-id="{{$product['id']}}">Add To Wishlist&nbsp;&nbsp;</a>
												@else
														<a href="{{url('login')}}"
													class="btn btn-dark btn-rounded sign-in mb-2 mb-lg-0" data-id="{{$product['id']}}">Add To Wishlist&nbsp;&nbsp;</a>
												@endauth
												@auth
												 <div class="dropdown cart-dropdown cart-offcanvas mr-13 mr-lg-2 ml-lg-2">
                            <div class="cart-overlay"></div>
                            <button class="cart-toggle link btn btn-dark">Request a Quote</button>
                            <div class="dropdown-box">
                                <div class="cart-header">
                                    <span>&nbsp;</span>
                                    <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                                </div>

                                <div class="">
                                    
                                   <form class="form inquiry-form">
                                   	@csrf
                                   	<div class="form-group">
                                        <input type="text" id="username" name="username" class="form-control" value="{{$user['name']}}" readonly>
                                        <span class="error" id="username_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="phone" name="phone" class="form-control" value="{{$user['phone']}}" readonly>
                                        <span class="error" id="phone_error"></span>

                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="email" name="email" class="form-control" value="{{$user['email']}}" readonly>
                                        <span class="error" id="email_error mb-2"></span>
                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="product_name" name="product_name" class="form-control" value="{{$product['name']}}" readonly>
                                        <span class="error" id="product_name_error"></span>

                                         <input type="hidden" id="product_id" name="product_id" class="form-control" value="{{$product['id']}}">
                                        
                                    </div>

                                     <div class="form-group">
                                        <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Product Quantity">
                                         <span class="alert alert-icon alert-error alert-bg alert-inline show-code-action" id="quantity_error"  style="display:none"></span>
                                        
                                    </div>
                                    <div class="form-group mt-4">
                                        <textarea id="message" name="enquiry" cols="30" rows="2" class="form-control" placeholder="Enquiry"></textarea>
                                        <span class="alert alert-icon alert-error alert-bg alert-inline show-code-action" id="enquiry_error" style="display:none"></span>
                                    </div>
                                    
                                   	  <button type="submit" class="btn btn-dark btn-rounded inquiry mt-5">Save</button>
                                   </form>
                                </div>

                                

                            
                            </div>
                            <!-- End of Dropdown Box -->
                        </div>
												@else
												<a href="{{url('login')}}"
													class="btn btn-dark btn-rounded sign-in mr-lg-2 ml-lg-2 mr-13" data-id="{{$product['id']}}">Request a Quote </a>
												@endauth
												
											</div>
										</div>

										<div class="social-links-wrapper">
											
											<div class="product-link-wrapper d-flex">
													
											</div>
											
										</div>
										
											
									</div>
								</div>
							</div>
						
							<div class="tab tab-nav-boxed tab-nav-underline product-tabs">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a href="#product-tab-description" class="nav-link active">Description</a>
									</li>
								
									
									
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="product-tab-description">
										<div class="row mb-4">
											<div class="col-md-6 mb-5">
												<h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
											
												<div class="mb-4 descriptProduct">{!!html_entity_decode($product['description'])!!}</div>
												
											</div>
											
										</div>
										
									</div>
								
								
								
								</div>
							</div>
							
							
						</div>
						<!-- End of Main Content -->
						<aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
							<div class="sidebar-overlay"></div>
							<a class="sidebar-close" href="#"><i class="close-icon"></i></a>
							<a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
							<div class="sidebar-content scrollable">
								<div class="sticky-sidebar">
									<div class="widget widget-icon-box mb-6">
										<div class="icon-box icon-box-side">
											<span class="icon-box-icon text-dark">
												<i class="w-icon-truck"></i>
											</span>
											<div class="icon-box-content">
												<h4 class="icon-box-title">Free Shipping & Returns</h4>
												<p>For all orders over $99</p>
											</div>
										</div>
										<div class="icon-box icon-box-side">
											<span class="icon-box-icon text-dark">
												<i class="w-icon-bag"></i>
											</span>
											<div class="icon-box-content">
												<h4 class="icon-box-title">Secure Payment</h4>
												<p>We ensure secure payment</p>
											</div>
										</div>
										<div class="icon-box icon-box-side">
											<span class="icon-box-icon text-dark">
												<i class="w-icon-money"></i>
											</span>
											<div class="icon-box-content">
												<h4 class="icon-box-title">Money Back Guarantee</h4>
												<p>Any back within 30 days</p>
											</div>
										</div>
									</div>
									<!-- End of Widget Icon Box -->

									
									<!-- End of Widget Banner -->

									
								</div>
							</div>
						</aside>
						<!-- End of Sidebar -->
					</div>
				</div>
			</div>

</x-guest-layout>
<script type="text/javascript">
	$(function(){
			$('.descriptProduct ul').addClass('list-type-check list-style-none');

	});
	$('#inquirymsg').hide();
	$('.btn-close').click(function(){
		$('.alert-bg').text('');
		$('.alert-bg').hide();
	});
	$('.inquiry-form').on('submit', function(e) {
		e.preventDefault()
		let formValue = new FormData(this);
		$.ajax({
       		type: "Post",
          url: '{{ url("customerInquiry") }}',
          data: formValue,
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
          	if(response.success){
          		
          		notifyMsg(response.message,'success');
          		$('.btn-close').trigger('click');

          	}else{
          		notifyMsg(response.message,'error');
          		$('.btn-close').trigger('click');
          	}
          },
          error: function(response) {
          	let error = response.responseJSON;
            if(!error){
            		error = JSON.parse(response.responseText);
            }
            $.each( error.errors, function( key, value ) {
            			$("#"+key+"_error").show();
  								$("#"+key+"_error").text(value);
						});
				}
	});
	});
</script>
