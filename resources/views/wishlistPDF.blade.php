<!DOCTYPE html>
<html>
<head>
	<title>Ekmatra Wishlist</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
	p,h6{
		font-size: 15px !important;
		line-height: 15px;
	}
	@page {
	margin: 100px 25px 100px 25px;
}

header {
	position: fixed;
	width: 100%;
}
footer {
  position: fixed; 
  bottom: -60px; 
  left: 0px; 
  right: 0px;
  height: 50px; 
  font-size: 20px !important;
  background-color: #000;
  color: white;
  text-align: center;
  line-height: 35px;
}

</style>
</head>
<body>
	
	<div class="container mt-5 mb-5">

	@foreach($wishlists['ProductWishList'] as $wishlist)

		<div class="row">
		<div class="col-md-12"  style="height:100%;margin-bottom:10px;">
			<div class="card">
				<div class="row">
					<h5 class="text-uppercase text-left mt-2  col-12 p-4">{{$wishlist['getProduct']['name']}}</h5>
					<div class="col-md-6">
						<div class="images p-4">
							<div class="text-center p-3"> <img id="main-image" src="{{public_path().'/product/'.$wishlist->getProduct->image }}" width="235" /> </div>
						  
						</div>
					</div>
				   
			</div>
			 <div class="row m-0">
				<div class="mt-1  col-12"> 
								<h6 class="text-uppercase mb-10">Specification</h6>
							   
			  </div>

						<div class="">
							<?php $re =  \App\Models\ProductFeture::with('feature_attribute_name','feature_name')->where(['product_id' => $wishlist['product_id']])->whereHas('feature_name',function($q){
													$q->where('search_type','basic');
												})->get();
											?>
							 @if($re)

								 <table style="width: 100%;border-collapse: collapse;border-spacing: 0;margin-bottom:20px;padding: 5px 1rem;">
		  
									<tbody>
			 

										@foreach($re->chunk(2) as $key=>$pro_values)
												<tr>
												 @foreach($pro_values as $product)
												 <?php $feature_name = explode('-',$product['feature_name']['name'],2); 

												
												 ?>
												   <td><h6>{{($feature_name[0]) ? $feature_name[1] : $feature_name[0]}}</h6> 
																
																	@if($product['feature_attribute_name'])
																		<p>{{$product['feature_attribute_name']['name']}}</p>
																		@else
																		<p>{{$product['value']}}</p>
																	@endif</td>
												 @endforeach
												</tr>
									  @endforeach
			 
									</tbody>
		  					</table>
	  					@endif
						 </div>
						 @if($priceshow == 1)
						  <div class="text-right mb-10 mr-2"> 
                                	<h5 class="act-price" style="color:#c40000 !important;">Price : {{$wishlist['margin_price']}} /- </h5>
                               </div>
                        @endif
			 </div>
				</div>
		</div>
	</div>
	 <footer>
            brandworks technologies pvt ltd
          </footer>
	@endforeach

	</div>
</body>
</html>
