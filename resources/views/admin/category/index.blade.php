@section('breadcumb','Categories')
@section('pageTitle','Categories')
@include('layouts.datatable-css')
@php
$url = getAuthGaurd();
@endphp

<style>
	.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
  top:-12px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  left: 4px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>

<x-app-layout>
	<div class="row row-sm">
		<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0 mt-2 mb-2">Categories</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
									<a href='{{url("$url/category/add")}}' class="btn btn-primary">Add Category</a>
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
	<script type="text/javascript" src="{{url('backend/js/delete-data.js')}}"></script>

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
				url: '{{ url("$url/categories") }}', // need to change here url
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
            {data: 'slug', name: 'slug','title' : 'Slug'},
            {data: 'sorting', name: 'sorting','title' : 'Sorting'},
            {data: 'image', name: 'image' ,'title' : 'image'},
            {data: 'action', name: 'action', orderable: false, searchable: false,title:'action'},
            {data: 'statusaction', name: 'action', orderable: false, searchable: false,title:'Status'},
     ]
	});
	$("#category-list").on('change',"input[type='checkbox']",function(e){
	 var ischecked= $(this).is(':checked');
	 var id = $(this).val();
	 let status = '';
	 let message = '';
	 if(!ischecked){
	 		status = 0;
	 		message = "Deactive";
	 }else{
	 	status = 1;
	 	message = "Active";
	 }
	 if (confirm("Are you sure you want to " + message +' ?')){
				$.ajax({
				
        url: "{{url('admin/category/status-change')}}",
        type: "Post",
        data: {
            "id": id,
            "status" : status,
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
	$('.delete').click(function(){
		let id = $(this).data("id") ;
		url = '{{url("admin/category")}}'+"/"+id;
		let token = '{{ csrf_token() }}';
		deleteData(id,url,token,table);
	})

</script>
