@section('breadcumb','Occasions')
@section('pageTitle','Occasions')
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
									<h4 class="card-title mg-b-0 mt-2 mb-2">Occasions</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
									<a href='{{url("$url/occasion/add")}}' class="btn btn-primary">Add Occasions</a>
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="occasion-list" class="table key-buttons text-md-nowrap"></table>
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
	table = $('#occasion-list').DataTable({
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
				url: '{{ url("$url/occasions") }}', // need to change here url
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
            {data: 'action', name: 'action', orderable: false, searchable: false,title:'action'},
     ]
	});

	$('#occasion-list').on('click','.removeOccasions',function(){
		let id = $(this).data("id") ;
		if (confirm("Are you sure you want to remove?")){
				$.ajax({
					url: "{{url('admin/occasion')}}" +"/"+id,
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
