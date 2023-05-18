<x-guest-layout>
	 <nav class="breadcrumb-nav">
	  <div class="container">
		  <ul class="breadcrumb bb-no">
			  <li><a href="{{url('/')}}">Home</a></li>
			  <li><a href="#">Enquiry</a></li>
		  </ul>
	  </div>
   </nav>
  
<div class="page-content mb-10 pb-2">
	<div class="container">
		<div class="row gutter-lg">
			 <div class="main-content post-single-content">
				 	@foreach($inquiry as $value)
				 	 <div class="post-author-detail mb-4">
	            <figure class="author-media mr-4">
	                <img src="{{url('product/'.$value['product']['image'])}}" alt="Author" width="105" height="105" />
	            </figure>
	            <div class="author-details">
	            	<div class="author-name-wrapper flex-wrap mb-2">
	               	<h4 class="author-name font-weight-bold mb-2 pr-4 mr-auto">{{$value['product']['name']}}</h4>
	              </div>
	              <p>
	              	Price : {{$value['product']['price']}}<br/>Qty:{{$value['quantity']}}
	              </p>
	            </div>
	         </div>
	        @endforeach
			 </div>
		</div>
	</div>
</div>     
</x-guest-layout>