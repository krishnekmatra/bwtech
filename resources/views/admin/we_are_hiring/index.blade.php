@section('breadcumb','Faq')
@section('pageTitle','Faq')
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
									<h4 class="card-title mg-b-0 mt-2 mb-2">We Are Hiring</h4>
									<div style="float: right;">

									<a href='{{url("$url/we-are-hiring/add")}}' class="btn btn-primary">Add</a>
									<a href='{{url("$url/job-post")}}' class="btn btn-primary">Applied Candidate</a>
								</div>
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
				url: '{{ url("$url/we-are-hirings") }}', // need to change here url
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
            {data: 'title', name: 'name','title' : 'Title'},
            {data: 'action', name: 'action', orderable: false, searchable: false,title:'action'},
     ]
	});

	$('#faq-list').on('click','.removeWeAreHiring',function(){
		let id = $(this).data("id") ;
		if (confirm("Are you sure you want to remove?")){
				$.ajax({
					url: "{{url('admin/we-are-hiring')}}" +"/"+id,
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
