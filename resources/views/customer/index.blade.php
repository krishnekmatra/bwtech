@section('breadcumb','Vendors')
@section('pageTitle','vendors')
@include('layouts.datatable-css')
@php
$url = getAuthGaurd();
@endphp
<x-app-layout>
	<div class="row row-sm">
		<div class="col-xl-12">
						<div class="card mg-b-20">
							
							<div class="card-body">
								<div class="table-responsive">
									<table id="vendor-list" class="table key-buttons text-md-nowrap"></table>
								</div>
							</div>
						</div>
					</div>
	</div>
</x-app-layout>
	@include('layouts.datatable-script');

<script type="text/javascript">
	var table ="";

	table=$('#vendor-list').DataTable({
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
				url: '{{ url("$url/customers") }}', // need to change here url
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
            {data: 'email', name: 'email' ,'title' : 'Email'},
            {data: 'phone', name: 'phone' ,'title' : 'Phone'},
          
     ]
	});

	

</script>
