@section('breadcumb','Category')
@section('pageTitle','Category-create')
@php
	if(!isset($category['image'])){
		$required="required='required'";
	}
	$backurl = url('/admin/categories');

@endphp
@section('backlink',"$backurl")

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Category {{@$category['id'] ? 'Edit' : 'Create'}}
								</div>
							  
								<form  data-parsley-validate="" name="categoryCreate" method="POST" id="categoryCreate" enctype="multipart/form-data">
									@csrf
									@if(@$category)
										<input type="hidden" name="id" value="{{@$category['id']}}}">
										<input type="hidden" name="old_image" value="{{@$category['image']}}">
									@endif
									<div class="row row-sm">
										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Name: <span class="tx-danger">*</span></label>
												<input class="form-control" name="name" placeholder="Enter Name" required="required" id="name" type="text" data-parsley-required-message="Please enter your name" value="{{@$category['name']}}">
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
												<label class="form-label">Sorting Number: <span class="tx-danger">*</span></label>
												<input class="form-control" name="sorting" placeholder="Enter sorting" required="required" id="sorting" type="text" data-parsley-required-message="Please enter sorting" value="{{@$category['sorting']}}">
												<span class="text-danger" id="sorting_error"></span>
											</div>
										</div>
										<div class="col-12"><button type="submit" class="btn btn-main-primary pd-x-20 mg-t-10 addcategory"><span class="submit">Submit </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
				


</x-app-layout>
<script type="text/javascript">
	$(document).ready(function() {
		$('.products').addClass('is-expanded');
		$('.category').addClass('active');
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
        	  $("#categoryCreate").parsley();

		$('#categoryCreate').on('submit', function(e) {
			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addcategory").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/category/store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    		$(".addcategory").prop('disabled',false);
                        window.location.href ='{{ url("admin/categories") }}';
                    },2000);
                } else {
                    notifyMsg(response.message,'error');
                }
            },
            error: function(response) {
            	  $('.loading').hide();
            	  $('.submit').show();
            	  $(".addcategory").prop('disabled',false);
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
	});
</script>
