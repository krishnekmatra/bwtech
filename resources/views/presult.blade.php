@if(count($product) > 0)
	<div class="product-wrapper row cols-lg-4 cols-md-3 cols-2 product_page">
			@foreach($product as $prod_val)
				<div class="product-wrap">
					<div class="product text-center">
						<figure class="product-media">
							<a href="{{url('product-detail/'.$prod_val['slug'])}}">
								<img src='{{url("product/".$prod_val['image'])}}' alt="Product" width="195" height="135"/>
							</a>
							
							<div class="product-action-vertical">
								  <a class="mt-2 multipproductcheckbox">
								 <input type="checkbox" class="multipleProduct" name="multipleProduct" value="{{$prod_val['id'] ? $prod_val['id'] : $prod_val['getProduct']['id']}}" data-price="{{$prod_val['price'] ? $prod_val['price'] : $prod_val['getProduct']['price']}}"/>
								</a>
								@auth
								 <a href="#" class="btn-product-icon btn-wishlist w-icon-heart wishlist" data-id="{{$prod_val['id']}}" data-price="{{$prod_val['price'] ? $prod_val['price'] : $prod_val['getProduct']['price']}}"
                                                title="Add to wishlist"></a>
                                @else
                                <a href="{{url('login')}}" class="btn-product-icon btn-wishlist w-icon-heart  sign-in"></a>
                                @endif
                                <a href="{{url('product-detail/'.$prod_val['slug'])}}" class="btn-product-icon  w-icon-search mt-2"
                                                title="Quickview"></a>
                               
                               
							</div>
						
						</figure>
						<div class="product-details">
							
							<h4 class="product-name">
								<a href="{{url('product-detail/'.$prod_val['slug'])}}">{{$prod_val['name'] ? $prod_val['name'] : $prod_val['getProduct']['name']}}</a>
							</h4>
						    
								<div class="product-price">
									<ins class="new-price">Price : {{$prod_val['price'] ? $prod_val['price'] : $prod_val['getProduct']['price']}}</ins>
								</div>
								
								
						</div>
					</div>
				</div>
			@endforeach
	</div>
	<div class="toolbox toolbox-pagination justify-content-between">
								<p class="showing-info mb-2 mb-sm-0">
									Showing<span>{{ $product->firstItem()}}-{{ $product->lastItem()}} of {{$product->total()}}</span>Products
								</p>
								@if ($product->lastPage() > 1)
								<ul class="pagination">
									<li class="prev {{ ($product->currentPage() == 1) ? ' disabled' : '' }}">
										@if($product->currentPage() != 1)
										<a data-value="{{$product->currentPage()-1}}" href="javascript:void(0)" aria-label="Previous" tabindex="-1" aria-disabled="true">
											<i class="w-icon-long-arrow-left"></i>Prev
										</a>
										@else
										<a href="javascript:void(0)" aria-label="Previous" tabindex="-1" aria-disabled="true">
											<i class="w-icon-long-arrow-left"></i>Prev
										</a>
										@endif
									</li>
									  @for ($i = 1; $i <= $product->lastPage(); $i++)
									  	<li class="page-item {{ ($product->currentPage() == $i) ? ' active' : '' }} ">
												<a class="page-link" href="javascript:void(0)"  data-value="{{$i}}">{{$i}}</a>
										</li>
									  @endfor
									
								
									<li class="next {{ ($product->currentPage() == $product->lastPage()) ? ' disabled' : '' }}">
										@if ($product->currentPage() != $product->lastPage())
										<a href="javascript:void" aria-label="Next" data-value="{{$product->currentPage()+1}}">
											Next<i class="w-icon-long-arrow-right"></i>
										</a>
										@else
												<a href="javascript:void(0)" aria-label="Next">
											Next<i class="w-icon-long-arrow-right"></i>
										</a>
										@endif
									</li>
								</ul>
								@endif
	</div>
@else
	<div class="product-wrapper row">
		<p>Data Not Found...</p>
	</div>
@endif