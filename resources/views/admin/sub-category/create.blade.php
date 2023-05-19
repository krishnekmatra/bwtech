@section('breadcumb','Sub-Category')
@section('pageTitle','sub-category-create')
@php
$backurl = url('admin/category')."/".$cat_id."/"."sub-cat";
@endphp
@section('backlink',"$backurl")

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Sub Category {{@$category['id'] ? 'Edit' : 'Create'}}
								</div>
							  
								<form  data-parsley-validate="" name="subCategoryCreate" method="POST" id="subCategoryCreate" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="id" value="{{@$cat_id}}">
									<input type="hidden" name="category_id" value="{{@$cat_id}}">
									<div class="row row-sm">
										<div class="col-6">
											<div class="form-group mg-b-0">
												<label class="form-label">Name: <span class="tx-danger">*</span></label>
												<input class="form-control" name="name" placeholder="Enter Name" required="required" id="name" type="text" data-parsley-required-message="Please enter your name" value="">
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>
									</div>
									<div class="row row-sm mt-3">
										@foreach($features as $feature_val)
											<div class="col-lg-3 mb-3">
												<label class="ckbox"><input type="checkbox" name="feature_id[]" value="{{$feature_val['id']}}"><span>{{$feature_val['name']}}</span></label>
												</div>
										@endforeach
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
		    
		$('.products').addClass('is-expanded');
		$('.category').addClass('active');
		$('#subCategoryCreate').on('submit', function(e) {
			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addsubcategory").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/category/sub-cat/store") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    		$(".addsubcategory").prop('disabled',false);
                        window.location.href ='{{ url("admin/category/$cat_id/sub-cat") }}';
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
