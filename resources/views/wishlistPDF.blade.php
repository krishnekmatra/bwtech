<!DOCTYPE html>
<html>
<head>
	<title>Ekmatra Wishlist</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
	p,h6{
		font-size: 15px !important;
	}
	@page {
    margin: 100px 25px 100px 25px;
}

header {
    position: fixed;
    width: 100%;
}
</style>
</head>
<body>
	<p><center><img src="{{public_path().'/logo.png'}}" style="max-width:25%;margin-top:-30px;"></center></p><br/>
	<div class="container mt-5 mb-5">

	@foreach($wishlists['ProductWishList'] as $wishlist)
		<div class="row mt-10">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" src="{{public_path().'/product/'.$wishlist->getProduct->image }}" width="150" /> </div>
                           <!--  <div class="thumbnail text-center"> 
                            	@if(@$wishlist->getProduct->image1)
                            	<img src="{{public_path().'/product/'.$wishlist->getProduct->image1}}" width="70">
                            	@else
                            	<img src="{{public_path().'/product/'.$wishlist->getProduct->image}}" width="70">
                            	@endif 
                            	@if(@$wishlist->getProduct->image2)
                            	<img src="{{public_path().'/product/'.$wishlist->getProduct->image2}}" width="70">
                            	@else
                            		<img src="{{public_path().'/product/'.$wishlist->getProduct->image}}" width="70">
                            	@endif 
                            	@if(@$wishlist->getProduct->image3)
                            	<img src="{{public_path().'/product/'.$wishlist->getProduct->image3}}" width="70">
                            	@else
                            		<img src="{{public_path().'/product/'.$wishlist->getProduct->image}}" width="70">
                            	@endif 
                          </div> -->
                        </div>
                    </div>
                   
            </div>
             <div class="row m-0">
             	<div class="mt-2  col-12 p-4"> 
                                <h6 class="text-uppercase">{{ $wishlist['getProduct']['name'] }}</h6>
                                <div class="price d-flex flex-row align-items-center"> 
                                	<span class="act-price" style="color:#c40000 !important;">Price : {{$wishlist['margin_price']}} /- </span>
                               </div>
              </div>

                        <div class="p-2">
                        <h6 class="mt-1 mb-1 col-12 p-2">Specification</h6> 
                        	<?php $re =  \App\Models\ProductFeture::with('feature_attribute_name','feature_name')->where(['product_id' => $wishlist['product_id']])->whereHas('feature_name',function($q){
         											$q->where('search_type','basic');
         										})->get();
         									?>
                        	 @if($re)

                             <table
        style="
          width: 100%;
          border-collapse: collapse;
          border-spacing: 0;
          margin-bottom: 20px;
          padding: 5px 1rem;
        "
      >
      
        <tbody>
         

        	@foreach($re->chunk(2) as $key=>$pro_values)
        			<tr>
        			 @foreach($pro_values as $product)
        			 <?php $feature_name = explode('-',$product['feature_name']['name']); ?>
        			   <td><h6>{{( $feature_name[0]) ?  $feature_name[1] :  $feature_name[0]}}</h6>
                              		
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
             </div>
                </div>
        </div>
    </div>
	
	@endforeach
  	</div>
</body>
</html>
