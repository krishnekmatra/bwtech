@section('breadcumb','Feature')
@section('pageTitle','Feature-create')
<?php
	$backurl = url('/admin/features');

?>
@section('backlink',"$backurl")

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
	<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<style>
	.tagify {
	background-color: #f5f5f5;
	border: none;
	border-radius: 4px;
	padding: 4px 8px;
	font-size: 16px;
	width: 100%;
}

.tagify__input {
	height: 2em;
	line-height: 2em;
}

.tagify__tag {
	background-color: #d9edf7;
	border-radius: 4px;
	padding: 4px 8px;
	margin-right: 4px;
	margin-bottom: 4px;
	display: inline-block;
}

.tagify__tag__removeBtn {
	color: #31708f;
	font-size: 16px;
	margin-left: 4px;
	cursor: pointer;
}

</style>

<x-app-layout>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-20">
									Feature {{@$feature['id'] ? 'Edit' : 'Create'}}
								</div>
							  
								<form  data-parsley-validate="" name="featureCreate" method="POST" id="featureCreate">
									@csrf
									@if(@$feature)
                  	<input name="id" type="hidden" value="{{@$feature->id}}">
                  @endif
									<div class="row row-sm">
										<div class="col-4">
											<div class="form-group mg-b-0">
												<label class="form-label">Name: <span class="tx-danger">*</span></label>
												<input class="form-control" name="name" placeholder="Enter Name" required="required" id="name" type="text" data-parsley-required-message="Please enter your name" value="{{@$feature['name']}}">
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group mg-b-0">
												<label class="form-label">Type: <span class="tx-danger">*</span></label>
												<select class="form-control" name="feature_type" required="required" id="feature_type">
													<option value="">Select Type</option>
													    <option value="text" {{ $feature->feature_type == 'text' ? 'selected' : '' }}>Text</option>
													      <option value="select" {{ $feature->feature_type == 'select' ? 'selected' : '' }}>Select</option>

												</select>
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>

											<div class="col-4">
											<div class="form-group mg-b-0">
												<label class="form-label">Search Type: <span class="tx-danger">*</span></label>
												<select class="form-control" name="search_type" required="required" id="search_type">
													<option value="">Select Search Type</option>
													<option value="basic" {{ $feature->search_type == 'basic' ? 'selected' : '' }}>Basic</option>
													<option value="advance" {{ $feature->search_type == 'advance' ? 'selected' : '' }}>Advance</option>
													<option value="dontshow" {{ $feature->search_type == 'dontshow' ? 'selected' : '' }}>Dont'show</option>
												</select>
												<span class="text-danger" id="name_error"></span>
											</div>
										</div>

										<div class="col-12 mt-4">
											<div class="form-group mg-b-0">
												<label class="form-label">Attribute: <span class="tx-danger">*</span></label>
													<?php
															if(count($featureAttribute) > 0){
															$featureAttributes = explode(',',$featureAttribute[0]['names']);
																foreach($featureAttributes as $feature_val){
																		$feature_explode = explode('|',$feature_val);
																		$fetureValue[]=[
																			'value' => $feature_explode[0],
																			'id'=> $feature_explode[1],

																];
																}
															}else{
																$fetureValue = [];
															}
															
													?>
													<input  name="feature_value[]" placeholder="Enter Name"  id="feature_value" type="text" data-parsley-required-message="Please enter feature value" value="{{json_encode($fetureValue)}}">
												<span class="text-danger" id="feature_value">
												<span class="text-danger" id="feature_value"></span>
											</div>
										</div>

										
										

										<input type="hidden" name="removeIds" value="" id="removeIds">

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
	$('.features').addClass('active');
	var removeIds = [];

	var input = document.getElementById('feature_value');
	
	var tagify = new Tagify(input, {
    maxTags: 1000, // maximum number of tags
    mapValueToProp: "id",
    dropdown: {
        maxItems: 1000, // maximum number of items in the dropdown
        classname: 'tags-look', // CSS class for the dropdown
        enabled: 0, // disable the dropdown
    },
    callbacks: {
        remove: onRemove, // callback when a tag is removed
    },
});
	function onRemove(elm){
			removeIds.push(elm.detail.data.id);
			implodedArray = removeIds.join(',');
			$("#removeIds").val(implodedArray);
}
	$('#featureCreate').on('submit', function(e) {
			e.preventDefault()
			let formValue = new FormData(this);
			if ( $(this).parsley().isValid() ) {
				 $(".loading").show();
				 $(".addfeature").prop('disabled',true);
				 $.ajax({
            type: "post",
            url: '{{ url("admin/feature/update") }}',
            data: formValue,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                		notifyMsg(response.message,'success');
                    
                    setTimeout(function(){
                    	  $(".addfeature").prop('disabled',false);
                        window.location.href ='{{ url("admin/features") }}';
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
