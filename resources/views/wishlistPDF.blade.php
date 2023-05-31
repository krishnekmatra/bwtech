<!DOCTYPE html>
<html>
<head>
	<title>Ekmatra Wishlist</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<p><center><img src="{{public_path().'/logo.png'}}" style="max-width:25%"></center></p><br/>
	@foreach($wishlists['ProductWishList'] as $wishlist)

	<div class="row" style="margin-top:20px">
		<p>Model Name : {{ $wishlist['getProduct']['name'] }}</p>
		<p>Category Name : {{ $wishlist['getProduct']['category']['name'] }}</p>
		<p>Selling Price : {{$wishlist['margin_price']}}</p>
		<div class="row">
			<div class="col-6">
			   <img src="{{public_path().'/product/'.$wishlist->getProduct->image }}" width="100" height="100">
			</div>
			<div class="col-6">
				@if(@$wishlist->getProduct->image1)
				<img src="{{public_path().'/product/'.$wishlist->getProduct->image1 }}" width="100" height="100">
				@endif

				@if(@$wishlist->getProduct->image2)
				<br/>
				<img src="{{public_path().'/product/'.$wishlist->getProduct->image2 }}" width="100" height="100">
				@endif

				@if(@$wishlist->getProduct->image3)
				<br/>
				<img src="{{public_path().'/product/'.$wishlist->getProduct->image3 }}" width="100" height="100">
				@endif

			</div>
		</div>
	</div>
	<hr/>
	<div class="row col-12">
		@if($wishlist['productFeatures'])
											@foreach($wishlist['productFeatures'] as $pro_value)
											  @if($pro_value['feature_name']['search_type'] == 'basic')
												<div class="col-md-3 col-3 mb-2">
													{{$pro_value['feature_name']['name']}} : 
												
													
																@if($pro_value['feature_attribute_name'])
																	{{$pro_value['feature_attribute_name']['name']}}
																@else
																	{{$pro_value['value']}}
																@endif
												
												</div>
												@endif
											@endforeach
											@endif
	</div>
	@endforeach

  
</body>
</html>
