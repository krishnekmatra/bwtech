@section('breadcumb','occasion')
@section('pageTitle','occasion-create')
<?php
	$backurl = url('/admin/occasions');

?>
@section('backlink',"$backurl")

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Occasion {{@$occasion['id'] ? 'Edit' : 'Create'}}
								</div>
							  
								<form  data-parsley-validate="" name="occasionCreate" method="POST" id="occasionCreate">
									@csrf
									@if(@$occasion)
                  	<input name="id" type="hidden" value="{{@$occasion->id}}">
                  @endif
									<div class="row row-sm">
										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Name: <span class="tx-danger">*</span></label>
												<input class="form-control" name="name" placeholder="Enter Name" required="required" id="name" type="text" data-parsley-required-message="Please enter your name" value="{{@$occasion->name}}">
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>

										
										

										
										<div class="col-12"><button type="submit" class="btn btn-main-primary pd-x-20 mg-t-10 addfeature"><span class="submit">Submit </span><span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true" style="display:none"></span></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
				


</x-app-layout>
<script type="text/javascript">
	$('.products').addClass('is-expanded');
		$('.occasions').addClass('active');
	$('#occasionCreate').on('submit', function(e) {

			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addfeature").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/occasion/store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    	  $(".addfeature").prop('disabled',false);
                        window.location.href ='{{ url("admin/occasions") }}';
                    },2000);
                } else {
                    notifyMsg(response.message,'error');
                }
            },
            error: function(response) {
            		$('.loading').hide();
            	  $('.submit').show();
            	  $(".addfeature").prop('disabled',false);
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
