@section('breadcumb','Dashboard')
@section('pageTitle','Dashboard')
@php
$sum = $total_vendor + $total_customer;
$product = $product_deactive + $product_active;
$total_inquiry = $inquiry_rfq + $inquiry;
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

						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="card-order">
										<h6 class="mb-2">New users</h6>
										<h2 class="text-right "><i class="mdi mdi-account-multiple icon-size float-left text-primary text-primary-shadow"></i><span>{{$sum}}</span></h2>
										<p class="mb-0">Vendor<span class="float-right">{{$total_vendor}}</span></p>
										<p class="mb-0">Customer<span class="float-right">{{$total_customer}}</span></p>
									</div>
								</div>
							</div>
						</div>
					<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="card-order">
										<h6 class="mb-2">Enquiry</h6>
										<h2 class="text-right "><i class="mdi mdi-help icon-size float-left text-deanger text-danger-shadow"></i><span>{{$total_inquiry}}</span></h2>
										<p class="mb-0">RFQ<span class="float-right">{{$inquiry_rfq}}</span></p>
										<p class="mb-0">Enquiry<span class="float-right">{{$inquiry}}</span></p>
									</div>
								</div>
							</div>
						</div>
					
					</div>
				</div>
	</div>
</x-app-layout>
