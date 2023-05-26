@section('breadcumb','Products')
@section('pageTitle','Products')
@php
$url = getAuthGaurd();
	$backurl = url($url."/"."products");

@endphp
@section('backlink',"$backurl")

<x-app-layout>
	<div class="row row-sm">
		<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0 mt-2 mb-2">Product Import</h4>
									<div class="row">
										<select class="form-control col-6" name="subcat" id="subcat">
											<option value="">Select Sub Category</option>
											@foreach($subcategory as $value)
												<option value="{{$value['id']}}">{{$value['name']}}</option>
											@endforeach
										</select>
										&nbsp;
										<a href='javascript:void(0)' class="btn btn-primary col-5 download">Download</a>
									</div>


								</div>
								
							</div>
							<div class="card-body">
								<div id="validation-errors" style="display:none">
   </div>
							 <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data"  data-parsley-validate="" >
								@csrf
								<div class="row row-sm mb-3">
									<div class="col-6">
										<div class="form-group mg-b-0">
											<label for="file">File:</label>
											<input id="file" type="file" name="file" class="form-control" required data-parsley-required-message="Please select file" >
										</div>
									</div>
									<div class="col-6">
										<div class="form-group mg-b-0">
											<label for="file">Type:</label>
											<select name="type" id="type" class="form-control" required data-parsley-required-message="Please select type">
												<option value="">Select value</option>
												<option value="add">Add</option>
												<option value="edit">Edit</option>
											</select>
										</div>
									</div>

									<div class="col-6 mt-2 showCategory" style="display:none">
										<div class="form-group mg-b-0">
											<label for="file">Category:</label>
											<select name="product_subcategory_id" id="product_subcategory_id" class="form-control"  data-parsley-required-message="Please select subcategory">
												<option value="">Select  Category</option>
											@foreach($subcategory as $value)
												<option value="{{$value['id']}}">{{$value['name']}}</option>
											@endforeach
											</select>
										</div>
									</div>
								</div>
									
								<button class="btn btn-success" type="submit">Import File</span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
							</form>
							</div>
						</div>
					</div>
	</div>
</x-app-layout>
	<script>
		$('.products').addClass('is-expanded');
		$('.product').addClass('active');
		$('#type').change(function(){
			var val = $(this).val();
			if(val === 'edit'){
				$(".showCategory").show();
			}else{
				$(".showCategory").hide();
			}
		});
		$('#form').on('submit', function(e) {
			
			$('.error').text('');
			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				$(".loading").show();
				$.ajax({
				   
					type: "post",
					enctype: 'multipart/form-data',
					url: '{{ url("$url/import") }}',
					data: formValue,
					cache: false,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response.success) {
							notifyMsg(response.message,'success');
							setTimeout(function(){
								 window.location.href ='{{ url("$url/products") }}';
							},2500);
						} else {
						   if(response.type == 'bulk_upload'){
							 $(".loading").hide();
								$("#validation-errors").show();
								let errorLi = '<ul>';

								$.each(response.message, function( key, value) {
								   errorLi += '<li>'+value.errors+' in row '+ value.row+'</li>';
								});

								errorLi += '</ul>';

								$('#validation-errors').html('<div class="alert alert-danger" style="overflow: auto;max-height: 110px;scroll-behavior: auto;">'+errorLi+'</div');
								$("#file").val(null);
								$('#file').attr('value', '');


							 }else{
								 $(".loading").hide();
								$("#validation-errors").hide();
								notifyMsg(response.message,'error');
							 }

							 window.scroll({top: 0,left: 0,behavior: 'smooth'});
						   
						}
					},
					error: function(response) {
					 console.log(response);
					   
					},
				});
			}
	  })  
		$('.download').click(function(){
			var subcat = $("#subcat").val();
			if(subcat === ''){
				 notifyMsg("Please Select Subcategory",'error');
				 return false;
			}
			window.location.href = '{{url("$url/product-sample-download-subcat")}}'+'/'+subcat;
		})
	
	</script>