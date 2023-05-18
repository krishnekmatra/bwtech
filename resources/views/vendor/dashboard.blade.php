@section('breadcumb','Dashboard')
@section('pageTitle','Dashboard')
@php
$product = $product_deactive + $product_active;
@endphp
<x-app-layout>
	<div class="container-fluid">
				
				
				<div class="main-content-body">
					<div class="row row-sm">
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="card-order">
										<h6 class="mb-2">Products</h6>
										<h2 class="text-right "><i class="mdi mdi-cube icon-size float-left text-success text-success-shadow"></i><span>{{$product}}</span></h2>
										<p class="mb-0">Active<span class="float-right">{{$product_active}}</span></p>
										<p class="mb-0">DeActive<span class="float-right">{{$product_deactive}}</span></p>
									</div>
								</div>
							</div>
						</div>
				
					</div>
				</div>
	</div>
</x-app-layout>
