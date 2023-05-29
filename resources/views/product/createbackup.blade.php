@section('breadcumb','Product')
@section('pageTitle','Product-create')
@php
	
	$url = getAuthGaurd();

	if(!isset($product['image'])){
		$required="required='required'";
	}
	$backurl = url($url."/"."products");

@endphp
@section('backlink',"$backurl")

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Product {{@$product['id'] ? 'Edit' : 'Create'}}
								</div>
							  
								<form  data-parsley-validate="" name="productCreate" method="POST" id="productCreate" enctype="multipart/form-data">
									@csrf
									@if(@$product)
										<input type="hidden" name="id" value="{{@$product['id']}}" id="product_id">
										<input type="hidden" name="old_image" value="{{@$product['image']}}">

										<input type="hidden" name="old_image1" value="{{@$product['image1']}}">

										<input type="hidden" name="old_image2" value="{{@$product['image1']}}">

										<input type="hidden" name="old_image3" value="{{@$product['image3']}}">

									@endif
									<div class="row row-sm">
										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Name: <span class="tx-danger">*</span></label>
												<input class="form-control" name="name" placeholder="Enter Name" required="required" id="name" type="text" data-parsley-required-message="Please enter your name" value="{{@$product['name']}}">
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Image: <span class="tx-danger">*</span></label>
												<div class="custom-file">

													<input class="custom-file-input" id="customFile" type="file" name="image" {{@$required}} data-parsley-required-message="Please choose file" data-parsley-fileextension='jpg,png,jpeg'  data-parsley-mime-type-message="Image should be in png,jpeg,jpg formet"><label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>

										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Image1: <span class="tx-danger">*</span></label>
												<div class="custom-file">

													<input class="custom-file-input" id="customFile" type="file" name="image1"  data-parsley-required-message="Please choose file" data-parsley-fileextension='jpg,png,jpeg'  data-parsley-mime-type-message="Image should be in png,jpeg,jpg formet"><label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>

										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Image2: <span class="tx-danger">*</span></label>
												<div class="custom-file">

													<input class="custom-file-input" id="customFile" type="file" name="image2"  data-parsley-required-message="Please choose file" data-parsley-fileextension='jpg,png,jpeg'  data-parsley-mime-type-message="Image should be in png,jpeg,jpg formet"><label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>
										
										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Image3: <span class="tx-danger">*</span></label>
												<div class="custom-file">

													<input class="custom-file-input" id="customFile" type="file" name="image3"  data-parsley-required-message="Please choose file" data-parsley-fileextension='jpg,png,jpeg'  data-parsley-mime-type-message="Image should be in png,jpeg,jpg formet"><label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>
										
										@if(isset($product['id']))
										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Image Url</label>
												<div class="custom-file">
													<input type="text" name="image_url" id="image_url" class="form-control">
												</div>
												<span class="text-danger" id="image_url_error"></span>
											</div>
										</div>
										@endif
										@if(isset($product['image']))
										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Preview: <span class="tx-danger">*</span></label>
												<div class="custom-file">

													<img src="{{url('product/'.$product['image'])}}"/ width="40" height="40px;">
												</div>
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>
										@endif
										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Supplier Model: <span class="tx-danger">*</span></label>
												<input class="form-control" name="supplier_model" placeholder="Enter Supplier Model" required="required" id="supplier_model" type="text" data-parsley-required-message="Please enter your price" value="{{@$product['supplier_model']}}">
												<span class="text-danger" id="price_error"></span>
											</div>
										</div>
										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Bw Model: <span class="tx-danger">*</span></label>
												<input class="form-control" name="bw_model" placeholder="Enter Bw Model" required="required" id="bw_model" type="text" data-parsley-required-message="Please enter your price" value="{{@$product['bw_model']}}">
												<span class="text-danger" id="price_error"></span>
											</div>
										</div>
										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Price: <span class="tx-danger">*</span></label>
												<input class="form-control" name="price" placeholder="Enter Price" required="required" id="price" type="text" data-parsley-required-message="Please enter your price" value="{{@$product['price']}}">
												<span class="text-danger" id="price_error"></span>
											</div>
										</div>

										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">MRP: <span class="tx-danger">*</span></label>
												<input class="form-control" name="mrp" placeholder="Enter MRP" required="required" id="mrp" type="text" data-parsley-required-message="Please enter your mrp" value="{{@$product['mrp']}}">
												<span class="text-danger" id="mrp_error"></span>
											</div>
										</div>


										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">MOQ: <span class="tx-danger">*</span></label>
												<input class="form-control" name="maq" placeholder="Enter MOQ" required="required" id="maq" type="text" data-parsley-required-message="Please enter your maq" value="{{@$product['maq']}}">
												<span class="text-danger" id="maq_error"></span>
											</div>
										</div>

										<div class="col-12 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Description: <span class="tx-danger">*</span></label>
												<textarea class="form-control mg-t-20" placeholder="Enter Description" required="" rows="3" name="description" id="myeditorinstance">{{@$product['description']}}</textarea>
												<span class="text-danger" id="description_error"></span>
											</div>
										</div>



										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Warranty: <span class="tx-danger">*</span></label>
												<select class="form-control" name="warrenty" id="warrenty">
													<option>Select Warranty</option>
													<option value="0">No Warranty</option>
													<option value="1">1 Years</option>
													<option value="2">2 Years</option>
													<option value="3">3 Years</option>
													<option value="4">4 Years</option>
													<option value="5">5 Years</option>
												</select>
												
												<span class="text-danger" id="warrenty_error"></span>
											</div>
										</div>

										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Category: <span class="tx-danger">*</span></label>
												<select class="form-control" name="category_id" id="category_id">
													<option>Select Category</option>
													@foreach($category as $cat)
														<option value="{{$cat['id']}}">{{$cat['name']}}</option>
													@endforeach
												</select>
												
												<span class="text-danger" id="warrenty_error"></span>
											</div>
										</div>

										

										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">SubCategory: <span class="tx-danger">*</span></label>
												<select class="form-control" name="sub_category_id" id="sub_category_id">
													@if(@$product['id'])
														@foreach($subCategory as $sub_cat)
															<option value="{{$sub_cat['id']}}">{{$sub_cat['name']}}</option>
														@endforeach
													@endif
												</select>
												
												<span class="text-danger" id="sub_category_id_error"></span>
											</div>
										</div>

										</div>
										<div class="row row-sm featuresdiv">
										</div>

										<div class="col-12"><button type="submit" class="btn btn-main-primary pd-x-20 mg-t-10 addproduct"><span class="submit">Submit </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
										
									</div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
				


</x-app-layout>
<script src="https://cdn.tiny.cloud/1/jt3z58u40lxaj1gi0twobfw8nvzfru0jajan8pdr61moyggc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
   tinymce.init({
   	 height: 200,
     selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
     plugins: 'powerpaste advcode table lists checklist',
     toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
   });
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.products').addClass('is-expanded');
		$('.product').addClass('active');
     window.ParsleyValidator
        .addValidator('fileextension', function (value, requirement) {
        		var tagslistarr = requirement.split(',');
            var fileExtension = value.split('.').pop();
						var arr=[];
						$.each(tagslistarr,function(i,val){
   						 arr.push(val);
						});
            if(jQuery.inArray(fileExtension, arr)!='-1') {
              console.log("is in array");
              return true;
            } else {
              console.log("is NOT in array");
              return false;
            }
        }, 32)
        .addMessage('en', 'fileextension', 'Please choose jpeg,png,jpg file formate');
        $("#productCreate").parsley();
     
    
     var cat_id = '{{@$product["category_id"]}}';
     var warrenty = '{{@$product["warrenty"]}}';
     if(warrenty){
     	 $('#warrenty').val(warrenty);
     }
		 if(cat_id){
		 		 $('#category_id').val(cat_id);
		 		 var sub_category_id = '{{@$product["sub_category_id"]}}';
		 		 $('#sub_category_id').val(sub_category_id);
		 		 getFeatures(sub_category_id);
		 		 var feature_attribute_id = '{{@$product["feature_attribute_id"]}}';
		 		 $('#feature_attribute_id').val(feature_attribute_id);

		 }
		 $('#sub_category_id').change(function(e){
		 		var id = $("#sub_category_id").val();
		 		getFeatures(id);
		 });
		 function getFeatures(id){
			 	$.ajax({
		      	url: '{{url("$url/product/subCategoryFeatures")}}',
		        type: "POST",
		        data: {
		        	subcategory_id: id,
		          _token: '{{ csrf_token() }}',
		          product_id : $("#product_id").val()
		        },
		        dataType: 'html',
		      
	       }).done(function(result){
	       		   $(".featuresdiv").html(result);

	       });
		 } 
		 $('#productCreate').on('submit', function(e) {
			e.preventDefault()
			let formValue = new FormData(this);


			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addproduct").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("$url/product/store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    		$(".addproduct").prop('disabled',false);
                        window.location.href ='{{ url("$url/products") }}';
                    },2000);
                } else {
                	 $(".loading").hide();
				 $(".addproduct").prop('disabled',false);
                    notifyMsg(response.message,'error');
                }
            },
            error: function(response) {
            	  $('.loading').hide();
            	  $('.submit').show();
            	  $(".addproduct").prop('disabled',false);
                let error = response.responseJSON;
                if(!error){
                    error = JSON.parse(response.responseText);
                }
                $.each( error.errors, function( key, value ) {
  								$("#"+key+"_error").text(value);
								});

            },
        });
	    }
	});
		 $("#category_id").on('change', function() {
			getSubCategory(this.value);
		 });
		function getSubCategory(id){
			$.ajax({
      	url: '{{ url("product/subcategory") }}',
        type: "POST",
        data: {
        	category_id: id,
          _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function(result) {
        	$('#sub_category_id').html('<option value="">Select Subcategory</option>');
            $.each(result, function(key, value) {
                $("#sub_category_id").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
            $('#brand').html('<option value="">Select Brands</option>');
        }
       });
		}
		

		
	});
</script>
