<x-guest-layout>
	   
			<div class="container pb-2">
				<!-- End Of Category Wrapper -->

				<nav class="breadcrumb-nav">
				<div class="container">
					<ul class="breadcrumb bb-no">
						<li><a href="{{url('/')}}">Home</a></li>
					</ul>
				</div>
			</nav>

				<div class="container">
				<div class="shop-content row gutter-lg">
					<!-- Start of Sidebar, Shop Sidebar -->
					<!-- End of Shop Sidebar -->

					<!-- Start of Main Content -->
					

						<div id="tag_container">
							 <div class="product-wrapper row cols-lg-4 cols-md-3 cols-2 product_page">
                        	 @foreach($product as $product_deals)
                            <div class="product-wrap mt-2">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{url('product-detail/'.$product_deals['getProduct']['slug'])}}">
                                            <img src="{{url('product/'.$product_deals['getProduct']['image'])}}" alt="Product"
                                                width="300" height="338" />
                                        </a>
                                        <div class="product-action-vertical">
                                          
                                            @auth
								 																<a href="#" class="btn-product-icon btn-wishlist w-icon-heart wishlist" data-id="{{$product_deals['getProduct']['id']}}"
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
                                        <div class="ratings-container">
                       										 <a href="#" class="rating-reviews">Min Qty : {{$product_deals['getProduct']['maq'] ? $product_deals['getProduct']['maq'] :  $product_deals['getProduct']['maq']}}</a>
               													 </div>
                                        <div class="product-price">
                                            <ins class="new-price">MRP : {{$product_deals['getProduct']['mrp']}}</ins>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                           @endforeach
                            
                        </div>
						</div>
						
				</div>
			</div>

		</div>

	   </div>
 
	</div>

</x-guest-layout>
