@section('breadcumb','Enquiry')
@section('pageTitle','Enquiry-Detail')
<?php
	if(@$inquiry['product']){
			$backurl = url('/admin/inquiry');
	}else{
		$backurl = url('/admin/rfq');
	}
?>
@section('backlink',"$backurl")

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Enquiry Detail
								</div>
							  	<div class="row row-sm mb-3">
										<div class="col-4">
											<label class="form-label">Client Name <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['customer']['name']}}</label>
										</div>

										<div class="col-4">
											<label class="form-label">Client Number <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['customer']['phone']}}</label>
										</div>

										<div class="col-4">
											<label class="form-label">Client Email <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['customer']['email']}}</label>
										</div>
								</div>
								@if(@$inquiry['product'])
								<div class="row row-sm">
										<div class="col-4 mb-3">
											<label class="form-label">Product Name <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['product']['name']}}</label>
										</div>

										<div class="col-4 mb-3">
											<label class="form-label">Product Price <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['product']['price']}}</label>
										</div>

										<div class="col-4 mb-3">
											<label class="form-label">Product Image <span class="tx-danger"></span></label>
											<img src="{{url('product/'.$inquiry['product']['image'])}}" height="50px" width="50px"/>
										</div>

										
								</div>
								@endif
								@if(@$inquiry['product']['createdBy'])
								<div class="row row-sm">
										<div class="col-4 mb-3">
											<label class="form-label">Vendor Name <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['product']['createdBy']['name']}}</label>
										</div>

										<div class="col-4 mb-3">
											<label class="form-label">Vendor Number <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['product']['createdBy']['phone']}}</label>
										</div>

										<div class="col-4 mb-3">
											<label class="form-label">Vendor Email <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['product']['createdBy']['email']}}</label>
										</div>

										
								</div>
								@endif
								<div class="row row-sm">
										<div class="col-4 mb-3">
											<label class="form-label">Quantity <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['quantity']}}</label>
										</div>
										
										@if($inquiry['min'])
										<div class="col-4 mb-3">
											<label class="form-label">Min <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['min']}}</label>
										</div>
									@endif
									
										@if($inquiry['max'])
										<div class="col-4 mb-3">
											<label class="form-label">Max <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['max']}}</label>
										</div>
									@endif
									@if($inquiry['prefered_category'])
										<div class="col-4 mb-3" >
											<label class="form-label">Prefered Category <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['prefered_category']}}</label>
										</div>
									@endif
									@if($inquiry['prefered_brand'])
										<div class="col-4 mb-3">
											<label class="form-label">Prefered Brand <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['prefered_brand']}}</label>
										</div>
									@endif
									@if($inquiry['delivery_date'])
										<div class="col-4 mb-3">
											<label class="form-label">Delivery Date <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['delivery_date']}}</label>
										</div>
									@endif
									<div class="col-4 mb-3">
											<label class="form-label">Created Date <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['created_at']}}</label>
										</div>
									<div class="col-12 mb-3">
											<label class="form-label">Enquiry <span class="tx-danger"></span></label>
											<label class="form-label">{{$inquiry['enquiry']}}</label>
										</div>

										
								</div>
							</div>
						</div>
					</div>
					
				</div>
				


</x-app-layout>
<script type="text/javascript">
	var classname = "{{$inquiry['type']}}"; 
	$('.inquiries').addClass('is-expanded');
	$('.'+classname).addClass('active');
</script>