@section('breadcumb','Faq')
@section('pageTitle','faq-create')
@php
	if(!isset($faq['image'])){
		$required="required='required'";
	}
	$url = url('/admin/faqs');
@endphp

@section('backlink',"$url")

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Faq {{@$faq['id'] ? 'Edit' : 'Create'}}
								</div>
							  
								<form  data-parsley-validate="" name="faqCreate" method="POST" id="faqCreate" enctype="multipart/form-data">
									@csrf
									@if(@$faq)
										<input type="hidden" name="id" value="{{@$faq['id']}}}">
									@endif
									<div class="row row-sm">
										<div class="col-12">
											<div class="form-group mg-b-0">
												<label class="form-label">Title: <span class="tx-danger">*</span></label>
												<input class="form-control" name="title" placeholder="Enter Title" required="required" id="title" type="text" data-parsley-required-message="Please enter  title" value="{{@$faq['title']}}">
												<span class="text-danger" id="title_error"></span>
											</div>
										</div>

										<div class="col-12 mt-2">
											<div class="form-group mg-b-0">
												<label class="form-label">Description: <span class="tx-danger">*</span></label>
												<textarea class="form-control" name="description" placeholder="Enter description" required="required" id="description" data-parsley-required-message="Please enter your description">{{@$faq['description']}}</textarea>
												<span class="text-danger" id="description_error"></span>
											</div>
										</div>

									
									

										
										<div class="col-12"><button type="submit" class="btn btn-main-primary pd-x-20 mg-t-10 addfaq"><span class="submit">Submit </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
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
		$('.pages').addClass('is-expanded');
		$('.faq').addClass('active');
		$('#faqCreate').on('submit', function(e) {
			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addfaq").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/faq/store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    		$(".addfaq").prop('disabled',false);
                        window.location.href ='{{ url("admin/faqs") }}';
                    },2000);
                } else {
                    notifyMsg(response.message,'error');
                      $('.loading').hide();
            	  $('.submit').show();
            	  $(".addfaq").prop('disabled',false);
                }
            },
            error: function(response) {
            	  $('.loading').hide();
            	  $('.submit').show();
            	  $(".addfaq").prop('disabled',false);
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
