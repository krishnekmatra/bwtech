@section('breadcumb','Vendor')
@section('pageTitle','vendor-create')
@php
	if(!isset($vendor['image'])){
		$required="required='required'";
	}
	$backurl = url('/admin/vendors');

@endphp
@section('backlink',"$backurl")

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Vendor {{(@$vendor['id'] ? 'Update' : 'Creation')}}
								</div>
							  
								<form  data-parsley-validate="" name="vendorCreate" method="POST" id="vendorCreate">
									@csrf
									@if(@$vendor)
										<input type="hidden" name="id" value="{{@$vendor['id']}}">
										<input type="hidden" name="old_image" value="{{@$category['image']}}">
									@endif
									<div class="row row-sm">
										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Name: <span class="tx-danger">*</span></label>
												<input class="form-control" name="name" placeholder="Enter Name" required="required" id="name" type="text" data-parsley-required-message="Please enter your name" value="{{@$vendor['name']}}">
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>

									<!-- 	<div class="col-6">
											<div class="form-group">
												<label class="form-label">Company Name: <span class="tx-danger">*</span></label>
												<input class="form-control" name="company_name" placeholder="Enter company name" required="" type="text" data-parsley-required-message="Please enter company name" value="{{@$vendor['company_name']}}">
												<span class="text-danger" id="company_name_error"></span>
											</div>
										</div>
 -->
										 <div class="col-6">
											<div class="form-group">
												<label class="form-label">Email: <span class="tx-danger">*</span></label>
												<input class="form-control" name="email" placeholder="Enter Email" required="" type="email" data-parsley-required-message="Please enter your email" value="{{@$vendor['email']}}">
												<span class="text-danger" id="email_error"></span>
											</div>
										</div>

										 <div class="col-6">
											<div class="form-group">
												<label class="form-label">Phone: <span class="tx-danger">*</span></label>
												<input class="form-control" name="phone" placeholder="Enter phone number" required="Firstname is Required" type="text" data-parsley-required-message="Please enter your phone number" value="{{@$vendor['phone']}}">
												<span class="text-danger" id="phone_error"></span>
											</div>
										</div>

										 <div class="col-6">
											<div class="form-group">
												<label class="form-label">Role: <span class="tx-danger">*</span></label>
												<select name="role_id" required class="form-control" id="role_id">
													<option value="">Select Role</option>
													@foreach($role as $value)
														<option value="{{$value->id}}">{{$value['name']}}</option>
													@endforeach
												</select>
												
											</div>
										</div>

										<!--  <div class="col-6">
											<div class="form-group">
												<label class="form-label">Address</label>
												<textarea class="form-control" name="address" placeholder="Enter Address" rows="4">{{@$vendor['address']}}</textarea>
											</div>
										</div> -->
										<!-- <div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Image: <span class="tx-danger">*</span></label>
												@if(@$vendor['image'])
														<img src="{{url('vendor/'.$vendor['image'])}}" width="50px" height="50px">
													@endif
												<div class="custom-file">

													<input class="custom-file-input" id="customFile" type="file" name="image" {{@$required}} data-parsley-required-message="Please choose file" data-parsley-fileextension='jpg,png,jpeg'  data-parsley-mime-type-message="Image should be in png,jpeg,jpg formet"><label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<span class="text-danger" id="image_error"></span>
											</div>
										</div> -->
										<div class="col-12"><button type="submit" class="btn btn-main-primary pd-x-20 mg-t-10 addvendor"><span class="submit">Submit </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
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
	$('.users').addClass('is-expanded');
	$('.vendors').addClass('active');
	var role_id = '{{@$vendor["role_id"]}}';
	if(role_id){
		$("#role_id").val(role_id);
	}
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
  });
	$('#vendorCreate').on('submit', function(e) {
			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addvendor").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/user/store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    	 $(".addvendor").prop('disabled',false);
                        window.location.href ='{{ url("admin/users") }}';
                    },2000);
                } else {
                    notifyMsg(response.message,'error');
                }
            },
            error: function(response) {
            	 $('.loading').hide();
            	  $('.submit').show();
            	  $(".addvendor").prop('disabled',false);
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
</script>
