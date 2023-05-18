@section('breadcumb','Banners')
@section('pageTitle','Banners')
@include('layouts.datatable-css')
@php
$url = getAuthGaurd();
@endphp

<x-app-layout>
	<div class="row row-sm">
		<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0 mt-2 mb-2">Banners</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
									<a href='{{url("$url/banner/add")}}' class="btn btn-primary">Add Banner</a>
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="category-list" class="table key-buttons text-md-nowrap"></table>
								</div>
							</div>
						</div>
					</div>
	</div>
</x-app-layout>
	@include('layouts.datatable-script');

<script type="text/javascript">
	var table;
	table = $('#category-list').DataTable({
		lengthChange: false,
		processing: true,
		serverSide: true,
		paging:true,
		ordering: false,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			infoFiltered:'',
		},
	
		ajax: {
				url: '{{ url("$url/banners") }}', // need to change here url
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
            {data: 'image', name: 'image' ,'title' : 'Image'},
            {data: 'shop_link', name: 'shop_link' ,'title' : 'Url'},
            {data:'Type', name:'Type' ,'title':'Type'},
            {data:'sorting', name:'sorting' ,'title':'Sorting'},
            {data: 'action', name: 'action', orderable: false, searchable: false,title:'action'},
     ]
	});
	$('#category-list').on('click','.removeBanner',function(){
		let id = $(this).data("id") ;
		if (confirm("Are you sure you want to remove?")){
				$.ajax({
					url: "{{url('admin/banner')}}" +"/"+id,
        	type: "DELETE",
        	data: {
            "id": id,
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
		}
	
});	
</script>
