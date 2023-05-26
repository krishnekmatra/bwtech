@section('breadcumb','Features')
@section('pageTitle','Features')
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
									<h4 class="card-title mg-b-0 mt-2 mb-2">Features</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
									<a href='{{url("$url/feature/add")}}' class="btn btn-primary">Add Features</a>
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="feature-list" class="table key-buttons text-md-nowrap"></table>
								</div>
							</div>
						</div>
					</div>
	</div>
</x-app-layout>
	@include('layouts.datatable-script');
<script type="text/javascript" src="{{url('backend/js/delete-data.js')}}"></script>

<script type="text/javascript">
	var table;
	table = $('#feature-list').DataTable({
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
				url: '{{ url("$url/features") }}', // need to change here url
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
            {data: 'name', name: 'name','title' : 'Name'},
            {data: 'feature_type', name: 'feature_type','title' : 'Type'},
            {data: 'search_type', name: 'search_type','title' : 'Search Type'},
            {data: 'action', name: 'action', orderable: false, searchable: false,title:'action'},
     ]
	});
	$('#feature-list').on('click','.deleteFeature',function(){
		let id = $(this).data("id") ;
		if (confirm("Are you sure you want to remove?")){
			$.ajax({
					url: "{{url('admin/feature')}}" +"/"+id,
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
	// $('.delete').click(function(){
	// 	let id = $(this).data("id") ;
	// 	url = '{{url("admin/feature")}}'+"/"+id;
	// 	let token = '{{ csrf_token() }}';
	// 	deleteData(id,url,token,table);
	// })
</script>
