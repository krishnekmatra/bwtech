	@foreach($result as $prod_val)
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
								<ins class="new-price" style="color:#c40000 !important;">Selling Price Rs. : {{$prod_val['margin_price']}}</ins>
								<br/>
								<ins class="new-price mt-2">Applied Margin : {{$margin_price}} {{($margin_type == 'percent') ? '%' : 'Rs'}}</ins>
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