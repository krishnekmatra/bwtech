@section('breadcumb','Subscription')
@section('pageTitle','Subscription')
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
									<h4 class="card-title mg-b-0 mt-2 mb-2">Subscription</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="faq-list" class="table key-buttons text-md-nowrap"></table>
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
	table = $('#faq-list').DataTable({
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
				url: '{{ url("$url/subscription/list") }}', // need to change here url
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
            {data: 'email', name: 'email','title' : 'Email'},
     ]
	});

	
</script>
