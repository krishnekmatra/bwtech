@section('breadcumb','Occasions')
@section('pageTitle','Occasions')
@include('layouts.datatable-css')
@php
$url = getAuthGaurd();
$backurl = url('/admin/occasions');

@endphp
@section('backlink',"$backurl")

<x-app-layout>
	<div class="row row-sm">
		<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0 mt-2 mb-2">Occasions</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
									<a  href="#" class="btn btn-primary assignDeal">Assign Occasion</a>
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="product-occasion-list" class="table key-buttons text-md-nowrap"></table>
								</div>
							</div>
						</div>
					</div>
	</div>
</x-app-layout>
	@include('layouts.datatable-script');
<script type="text/javascript" src="{{url('backend/js/delete-data.js')}}"></script>

<script type="text/javascript">
	$('.products').addClass('is-expanded');
		$('.occasions').addClass('active');
	var table;
	var uncheckedVal = [];
	table = $('#product-occasion-list').DataTable({
		lengthChange: false,
		processing: true,
		serverSide: true,
		paging:true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			infoFiltered:'',
		},
	
		ajax: {
				url: '{{ url("$url/product/occasion/$id") }}', // need to change here url
				type: "GET",
				async:false,
		},
		 columns: [
		 	{
        			"title": "Serial",
        			render: function (data, type, row, meta) {
        				return meta.row + meta.settings._iDisplayStart + 1;
        			}
        	},
            {data:'select_product',name:'select_product'},
            {data: 'name', name: 'name','title' : 'Name'},
            {data: 'image', name: 'image','title' : 'Image'},	
     	]
	});

	$("#product-occasion-list").on('change',"input[type='checkbox']",function(e){
    	 var ischecked= $(this).is(':checked');
    		if(!ischecked){
    			  uncheckedVal.push( $(this).val());
    		}
	});
	
	$(".assignDeal").click(function(){
		var checkedVal = [];
 		$('.selectProducts:checkbox:checked').each(function(){
			checkedVal.push($(this).val());
  		});
  	
  		
  		$.ajax({
				
        url: "{{url('admin/product/occasion-save')}}",
        type: "Post",
        data: {
            "id": "{{$id}}",
            "checkedVal" : checkedVal,
            "uncheckedVal" : uncheckedVal,
            "_token": "{{ csrf_token() }}",
        },

        success: function(response) {
	        if (response.success) {
	        	notifyMsg(response.message,'success');
	            table.ajax.reload(null, false);

	        } else {
	        	notifyMsg(response.message,'error');
	        }
        }
      });
	})
	
</script>
