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
									<h4 class="card-title mg-b-0 mt-2 mb-2">Product Export</h4>
									<a href='{{url("$url/product-sample-download")}}' class="btn btn-primary">Download Sample</a>

								</div>
								
							</div>
							<div class="card-body">
								<div id="validation-errors" style="display:none">
   </div>
							 <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="file">File:</label>
			<input id="file" type="file" name="file" class="form-control">
		</div>
		
		<button class="btn btn-success" type="submit">Import File</button>
	</form>
							</div>
						</div>
					</div>
	</div>
</x-app-layout>
	<script>
        $('.products').addClass('is-expanded');
        $('.product').addClass('active');
		 $('#form').on('submit', function(e) {
        $('.error').text('');
        e.preventDefault()
        let formValue = new FormData(this);

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
    })  

	</script>