@section('breadcumb','Contact-Us')
@section('pageTitle','contact-us-create')

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Conatct Us {{@$contact['id'] ? 'Edit' : 'Create'}}
								</div>
							  
								<form  data-parsley-validate="" name="contactUsCreate" method="POST" id="contactUsCreate" enctype="multipart/form-data">
									@csrf
									@if(@$contact)
										<input type="hidden" name="id" value="{{@$contact['id']}}}">
									@endif
									<div class="row row-sm">
										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Email: <span class="tx-danger">*</span></label>
												<input class="form-control" name="email" placeholder="Enter Email" required="required" id="email" type="email" data-parsley-required-message="Please enter your email" value="{{@$contact['email']}}">
												<span class="text-danger" id="email_error"></span>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Phone: <span class="tx-danger">*</span></label>
												<input class="form-control" name="phone" placeholder="Enter Phone" required="required" id="phone" type="phone" data-parsley-required-message="Please enter your phone" value="{{@$contact['phone']}}">
												<span class="text-danger" id="phone_error"></span>
											</div>
										</div>
									</div>
									<div class="row row-sm mt-2">
										<div class="col-12">
											<div class="form-group mg-b-0">
												<label class="form-label">Address: <span class="tx-danger">*</span></label>
												<textarea class="form-control" name="address" placeholder="Enter Address" required="required" id="address" data-parsley-required-message="Please enter your address">{{@$contact['address']}}</textarea>
												<span class="text-danger" id="address_error"></span>
											</div>
									</div>
								</div>

									<div class="row row-sm mt-2">
										<div class="col-12">
											<div class="form-group mg-b-0">
												<label class="form-label">Description: <span class="tx-danger">*</span></label>
												<textarea class="form-control" name="description" placeholder="Enter Address" required="required" id="description" data-parsley-required-message="Please enter your description">{{@$contact['description']}}</textarea>
												<span class="text-danger" id="description_error"></span>
											</div>
									</div>
								
										
									<div class="col-12">
											<button type="submit" class="btn btn-main-primary pd-x-20 mg-t-10 addsubcategory"><span class="submit">Submit </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
									</div>
									
								</form>
							</div>
						</div>
					</div>
					
				</div>
				


</x-app-layout>
<script type="text/javascript">
	

	$(document).ready(function() {
		    

		$('#contactUsCreate').on('submit', function(e) {
			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addsubcategory").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/contact-us/store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    		$(".addsubcategory").prop('disabled',false);
                        window.location.reload();
                    },2000);
                } else {
                    notifyMsg(response.message,'error');
                }
            },
            error: function(response) {
            	  $('.loading').hide();
            	  $('.submit').show();
            	  $(".addsubcategory").prop('disabled',false);
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
