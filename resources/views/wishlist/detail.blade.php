<x-guest-layout>
	<style>
		.wislistDetail {
    width: 100%;
    display: flex;
}

.wislistDetail select.form-control {
    max-width: 200px;
    width: 100%;
}

.wislistDetail  input#margin {
    max-width: 200px;
    margin-left: 10px;
    margin-right: 10px;
    width: 100%;
}

.margintype {
    display: flex;
    width: 100%;
    justify-content: space-between;
}
	</style>
	<nav class="breadcrumb-nav">
				<div class="container">
					<ul class="breadcrumb bb-no">
						<li><a href="{{url('/')}}">Home</a></li>
						<li><a href="{{url('wishlist')}}">Wishlist</a></li>
						<li>{{$wishlist['name']}}</li>
					</ul>
				</div>
			</nav>
			<!-- End of Breadcrumb -->

			<!-- Start of Pgae Contetn -->
			   <div class="page-content mb-8">
                <div class="container">
                	<div class="row mb-5 align-items-center wislistDetail">
                		<div class="col-5 col-md-5 col-lg-3"><h4 class="product-name wishlist-title"><a href="javascript:void(0)">{{$wishlist['name']}}</a></h4></div>

                		<div class="col-4 col-md-4 col-lg-2">
												<div class="wishlistbtns">
														<button class=" removewishlist">
															<img src="{{url('front/images/close-icon.png')}}" alt="remove"/>
														</button>
														<button class="edit editwishlist">
															<img src="{{url('front/images/edit.png')}}" alt="close"/>
														</button>
														<a href="{{url('shop/product')}}"><button class="edit">
															<img src="{{url('front/images/icons/add.png')}}" alt="add"/>
														</button></a>
													
												</div>
                    </div>
                    	<div class="col-4 col-md-5 col-lg-5 margintype">
                    			<select class="form-control ml-2">
														<option value="">Margin Type</option>
														<option value="percent">%</option>
														<option value="rs">₹</option>
													</select>

													<input type="text" class="form-control" name="margin" id="margin" placeholder="Margin for all">

													<button class=" btn btn-dark">Apply</button>
                    	</div>
                  </div>
                  <div class="row mb-5 align-items-center wislistEditDetail">
                		<div class="col-8 col-md-5 col-lg-3">
												<input type="text" class="form-control" name="wishlist_name" id="wishlist_name" value="{{$wishlist['name']}}">
										</div>
										<div class="col-4 col-md-5 col-lg-3">
											<div class="wishlistbtns">
													<button class="save"><img src="{{url('front/images/correct.png')}}" alt="save"/></button>
													<button class="close"><img src="{{url('front/images/close-icon.png')}}" alt="close"/></button>
													
                     </div>
										</div>

                  </div>
                    <!-- Start of Vendor Map -->
                   
                    <!-- End of Vendor Map -->


                   <div class="product-wrapper row cols-lg-5 cols-md-4 cols-sm-3 cols-2">
											@foreach($wishlist['ProductWishList'] as $prod_val)
												<div class="product-wrap" id="product{{$prod_val['id']}}">
													<div class="product product-image-gap product-simple">
														<figure class="product-media">
															<a href="{{url('product')}}">
																<img src='{{url("product/".$prod_val['getProduct']['image'])}}' alt="Product" width="195" height="135" />
																 <img src='{{url("product/".$prod_val['getProduct']['image'])}}' alt="Product" width="195" height="135" />
															</a>
														   
															<div class="product-action">
																<a href="{{url('product-detail/'.$prod_val['getProduct']['slug'])}}" class="btn-product" title="Quick View">Quick View</a>
															</div>
														</figure>
														<div class="product-details">
															
															<h4 class="product-name">
																<a href="{{url('product-detail/'.$prod_val['id'])}}">{{$prod_val['getProduct']['name']}}</a>
															</h4>
														   
															<div class="product-pa-wrapper">
																<div class="product-price">
																	<ins class="new-price">Price : {{$prod_val['getProduct']['price']}}</ins>
																	<br/>
																	<ins class="new-price">Min Qty : {{$prod_val['getProduct']['maq']}}</ins>
																</div>
																<div class="product-action">
																	<a href="javascript:void(0)" class="btn-cart btn-product btn btn-link btn-underline remove
																	" data-id="{{$prod_val['id']}}" >Remove</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											@endforeach
						   		</div>
                    <!-- End of Vendor Store -->
                </div>
            </div>
</x-guest-layout>
<script type="text/javascript">
	
	$('.wislistEditDetail').hide();
	$(document).on('click', ".editwishlist", function() {
		$('.wislistEditDetail').show();
		$('.wislistDetail').hide();
	});

	$(document).on('click', ".close", function() {
		close();
	});

	function close(){
		$('.wislistEditDetail').hide();
		$('.wislistDetail').show();
	}
	$(document).on('click', ".save", function() {
		var id = "{{$wishlist['id']}}";
		var name = $('#wishlist_name').val();
		$.ajax({
       		type: "post",
          url: '{{ url("savewishlist") }}',
          data: {
            "id": id,
            "name": name,
            "_token": "{{ csrf_token() }}",
        	},
          success: function(response) {
          	$('.wishlist-title').text(name);
          	close();
          },
          
       });
	});

	$(document).on('click', ".remove", function() {
		var id = $(this).attr('data-id');
		if (confirm('Are you sure want to remove?')) {
			$.ajax({
	       		type: "post",
	          url: '{{ url("removeProductWishlist") }}',
	          data: {
	            "id": id,
	            "_token": "{{ csrf_token() }}",
	        	},
	          success: function(response) {
	          	$('.cart-count ').text(response.count);
	          	$("#product"+id).remove();
	          },
	          
	       });
		}else{
			return false;
		}
	});
	$(document).on('click', ".removewishlist", function() {
		var id = "{{$wishlist['id']}}";
		if (confirm('Are you sure want to remove?')) {
			$.ajax({
	       		type: "post",
	          url: '{{ url("removewishlist") }}',
	          data: {
	            "id": id,
	            "_token": "{{ csrf_token() }}",
	        	},
	          success: function(response) {
	          	window.location.href ='{{ url("wishlist") }}';
	          },
	          
	       });
		}else{
			return false;
		}
	});
	
</script>