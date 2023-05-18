@section('breadcumb','Banner')
@section('pageTitle','Banner-create')
@php
	if(!isset($banner['image'])){
		$required="required='required'";
	}
	$url = url('/admin/banners');
@endphp

@section('backlink',"$url")

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Banner {{@$banner['id'] ? 'Edit' : 'Create'}}
								</div>
							  
								<form  data-parsley-validate="" name="bannerCreate" method="POST" id="bannerCreate" enctype="multipart/form-data">
									@csrf
									@if(@$banner)
										<input type="hidden" name="id" value="{{@$banner['id']}}}">
										<input type="hidden" name="old_image" value="{{@$banner['image']}}">
									@endif
									<div class="row row-sm">
										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Shop Url: <span class="tx-danger">*</span></label>
												<input class="form-control" name="shop_link" placeholder="Enter Shop Url" required="required" id="shop_link" type="text" data-parsley-required-message="Please enter  name" value="{{@$banner['shop_link']}}">
												<span class="text-danger" id="shop_link_error"></span>
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
												<input class="form-control" name="sorting" placeholder="Enter sorting" required="required" id="sorting" type="text" data-parsley-required-message="Please enter sorting" value="{{@$banner['sorting']}}">
												<span class="text-danger" id="sorting_error"></span>
											</div>
										</div>
										
										<div class="col-6 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Type <span class="tx-danger">*</span></label>
												<select class="form-control"  name="type" data-parsley-required-message="Please select type" required>
													<option value="">Select Type</option>
													@foreach($type as $val)
														@if(@$banner['type'] && $banner['type'] == $val)
														<option value="{{$val}}" selected="selected">{{$val}}</option>
														@else
														<option value="{{$val}}">{{$val}}</option>
														@endif
													@endforeach
												</select>
												
												<span class="text-danger" id="type_error"></span>
											</div>
										</div>

										
										<div class="col-12"><button type="submit" class="btn btn-main-primary pd-x-20 mg-t-10 addbanner"><span class="submit">Submit </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
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
        	  $("#bannerCreate").parsley();

		$('#bannerCreate').on('submit', function(e) {
			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addbanner").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/banner/store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    		$(".addbanner").prop('disabled',false);
                        window.location.href ='{{ url("admin/banners") }}';
                    },2000);
                } else {
                    notifyMsg(response.message,'error');
                      $('.loading').hide();
            	  $('.submit').show();
            	  $(".addbanner").prop('disabled',false);
                }
            },
            error: function(response) {
            	  $('.loading').hide();
            	  $('.submit').show();
            	  $(".addbanner").prop('disabled',false);
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
