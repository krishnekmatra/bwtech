<style type="text/css">
	.author-details ,.author-name{
	
    overflow: hidden;
    text-overflow: ellipsis;
	}
</style>
<x-guest-layout>
	<nav class="breadcrumb-nav">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="{{url('/')}}">Home</a></li>
				<li>My account</li>
			</ul>
		</div>
	</nav>
	 <div class="page-content pt-2">
				<div class="container">
					<div class="tab tab-vertical row gutter-lg">
						<ul class="nav nav-tabs mb-6" role="tablist">
							<li class="nav-item">
								<a href="#account-dashboard" class="nav-link active">Dashboard</a>
							</li>
							<li class="nav-item">
								<a href="#account-orders" class="nav-link">Enquiry</a>
							</li>
							<li class="nav-item">
								<a href="#rfq" id="rfqlink" class="nav-link">My RFQ</a>
							</li>
							
							<li class="nav-item">
								<a href="javascript:void(0)" class="nav-link wishlistLink">Wishlist</a>
							</li>
							
						</ul>

						<div class="tab-content mb-6">
							<div class="tab-pane active in" id="account-dashboard">
								<p class="greeting mb-4">Hello <span class="text-dark font-weight-bold">{{auth()->user()->name}}</span></p>

								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
											<div class="icon-box text-center">
												<span class="icon-box-icon icon-logout">
													<i class="w-icon-logout"></i>
												</span>
												<div class="icon-box-content">
													<p class="text-uppercase mb-0"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
														<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																					@csrf
																					</form>
													</p>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>

							<div class="tab-pane  mb-4 " id="account-orders">
								@foreach($inquiry as $value)
									<div class="main-content post-single-content row col-lg-6 col-md-8">
										
						 					<div class="post-author-detail mb-4">
												<figure class="author-media mr-4">
													<img src="{{url('product/'.$value['product']['image'])}}" alt="Author" width="105" height="105" />
												</figure>
												<div class="author-details">
													<div class="author-name-wrapper flex-wrap mb-2">
														<h4 class="author-name font-weight-bold mb-2 pr-4 mr-auto">{{$value['product']['name']}}</h4>
												  </div>
												  <p>Price : {{$value['product']['price']}}<br/>Qty:{{$value['quantity']}}</p>
											  </div>
				 							</div>
									
									</div>
										@endforeach
							</div>

							<div class="tab-pane  mb-4 " id="rfq">
								@if(count($rfq) > 0)
								@foreach($rfq as $value)
									<div class="main-content post-single-content row col-lg-6 col-md-8">
										
						 					<div class="post-author-detail mb-4">
												
												<div class="author-details">
													<div class="author-name-wrapper flex-wrap mb-2">
														<h4 class="author-name font-weight-bold mb-2 pr-4 mr-auto">{{$value['prefered_category']}}</h4>
												  </div>
												  <p>
												  	@if(@$value['prefered_category'])
												  	Prefered Category : {{$value['prefered_category']}}
												  	@endif
												  	@if(@$value['prefered_brand'])
												  	<br/>
												  	Prefered Brand : {{$value['prefered_brand']}}
												  	@endif
												  	@if(@$value['min'])
												  	<br/>
												  	Min : {{$value['min']}}
												  	@endif
												  	@if(@$value['max'])
												  	Max :{{$value['max']}}
												  	@endif
												  	@if(@$value['delivery_date'])
												  	<br/>
												  	Delivery Date :{{$value['delivery_date']}}
												  	@endif
												  </p>
												  
												  @if(@$value['quantity'])
												  	<p>Quantity : {{$value['quantity']}}</p>
												  @endif
												   @if(@$value['enquiry'])
												  	<p>Enquiry : {{$value['enquiry']}}</p>
												  @endif
											  </div>
				 							</div>
									
									</div>
										@endforeach
								@else
								<p>Data Not Found</p>
								@endif
							</div>
					  </div>
					</div>
				</div>
	 </div>

</x-guest-layout>
<script type="text/javascript">

	hash = window.location.hash;
	if(hash == "#rfq"){
		elements = $('a[href="' + hash + '"]');
		$('.nav .nav-item a').removeClass('active');
		$(".nav .nav-item a" + hash+'link').addClass('active');

		$(".tab-pane").removeClass('active in');
		$(hash).addClass('active in');
	}
	
	
	$('.wishlistLink').click(function(){
		window.location.href = "{{url('catalogue')}}";
	})
</script>