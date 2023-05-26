@section('breadcumb','Products')
@section('pageTitle','Products')
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
									<h4 class="card-title mg-b-0 mt-2 mb-2">Product</h4>
									<div style="float: right;">
									<span class="activeinactive" style="display:none">
										<a class="export btn  btn-primary"  style="display:none;color:#fff" onclick="submitForm()">Export
											<form id="editProductExport"  method="POST" action='{{url("$url/ProductEditExport")}}'  style="display: none;">
												@csrf
												<input type="hidden" name="product_export_id" id="product_export_id">
												<input type="hidden" name="product_subcategory_id" id="product_subcategory_id">
										</form>
										</a>
										<a href='javascript:void(0)' class="btn btn-success activebtn">Active</a>

										<a href='javascript:void(0)' class="btn btn-danger inactivebtn">InActive</a>
									</span>
									<a href='{{url("$url/product-import")}}' class="btn btn-primary">Product Import</a>

									<a href='{{url("$url/product/add")}}' class="btn btn-primary">Add Product</a>
									<a href='{{url("$url/product/image")}}' class="btn btn-primary">Upload Image</a>
									
								</div>
								</div>
								
							</div>
							<div class="card-body">
								<select class="form-control col-4" name="category" id="category">
										<option value=''>Select Category</option>
										@foreach($category as $cat_val)
											<option value="{{$cat_val['id']}}">{{$cat_val['name']}}</option>
										@endforeach
									</select>
								<div class="table-responsive">
									<table id="product-list" class="table key-buttons text-md-nowrap"></table>
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
		var checkedVal = [];

	$(function() {
		getTable();
	});

		$(".activeinactive").on('click',".activebtn",function(e){
			setActiveInactiveProduct(1,'Active');
		});

		$(".activeinactive").on('click',".inactivebtn",function(e){
			setActiveInactiveProduct(0,'InActive');
		});

		function setActiveInactiveProduct(status,message){
			 if (confirm("Are you sure you want to " + message +' ?')){
	  		$.ajax({
					
		        url: "{{url('admin/product/changeStatus')}}",
		        type: "Post",
		        data: {
		            "checkedVal" : checkedVal,
		            "status" : status,
		            "_token": "{{ csrf_token() }}",
		        },

		        success: function(response) {
			        if (response.success) {
			        	notifyMsg(response.message,'success');
			        	 $(".activeinactive").hide();

			            table.ajax.reload(null, false);

			        } else {
			        	notifyMsg(response.message,'error');
			        }
		        }
	     });
  	 }
		}
		$('#product-list').on('click','.removeProduct',function(){
				let id = $(this).data("id") ;
				if (confirm("Are you sure you want to remove?")){
						$.ajax({
							url: "{{url('admin/product/remove')}}",
		        	type: "Post",
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

		$("#product-list").on('change',".activeproducts",function(e){
    	 var ischecked= $(this).is(':checked');
    		if(ischecked){
    			   checkedVal.push($(this).val());
    		}else{
    			    var index = checkedVal.indexOf($(this).val());
							checkedVal.splice(index, 1);
    		}
    		var array = checkedVal.join(',');
    		$("#product_export_id").val(array);
    		
	});
	if(checkedVal.length == 0){
    				$('.activeinactive').hide();
    				$('.export').hide();
  }else{
    				$('.activeinactive').show();
    				$('.export').show();
  }	
	function submitForm(){
		let product_subcategory_id = $("#product_subcategory_id").val();
		if(product_subcategory_id === ''){
			notifyMsg("Please select Category",'error');
			return false;
		}
		var productCheckedVal = []
		$('input:checkbox.activeproducts:checked').each(function () {
			productCheckedVal.push(this.value);
		});
		var array = productCheckedVal.join(',');
		if(array === ''){
			notifyMsg("Please select at least one product",'error');
			return false;
		}
	 	$("#product_export_id").val(array);
	 	document.getElementById('editProductExport').submit();
 }
$("#product-list").on('change',".allCheckbox",function(e){
	
	 if (!$(this).prop("checked")) {
	 	$('.activeinactive').hide();
	 	$('.export').hide();
	 }else{
	 	$('.activeinactive').show();
	 		$('.export').show();
	 }
	$(".activeproducts").attr('checked', this.checked);


});

$("#product-list").on('change',".switch input[type=checkbox]",function(e){
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
				
        url: "{{url('admin/product/status-change')}}",
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
$('#product-list').on('click', '.changestaus', function(){
		let id = $(this).data("id") ;
		let status = $(this).data('status');
		let message = $(this).data('msg');
		if (confirm("Are you sure you want to " + message +' ?')){
				$.ajax({
				
        url: "{{url('admin/product/status-change')}}",
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
   $('#category').on('change', function() {
$("#product-list .allCheckbox").prop("checked",true);

   	var cat_id =  $('#category').val();
   	$("#product_subcategory_id").val(cat_id);
   		table.ajax.reload(null, false);

   });
	function getTable() {
		table = $('#product-list').DataTable({
		lengthChange: false,
		processing: true,
		responsive: true,
		serverSide: true,
		paging:true,
		ordering: false,

		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			infoFiltered:'',
		},
	
		ajax: {
				url: '{{ url("$url/products") }}', // need to change here url
				type: "GET",
				async:false,
				data: function(d) {
                    d.category = $('#category').val();
                },
				
		},

		 columns: [
		 			{
        			"title": "Serial",
        			render: function (data, type, row, meta) {
        				return meta.row + meta.settings._iDisplayStart + 1;
        			}
        		},
 						{
 							data:'select_product',
 							name:'select_product',
 							title:'<input type="checkbox" class="allCheckbox" name="allCheckbox">'
 						},
             {
            	data: 'name', 
            	name: 'name',
            	'title' : 'Name'},
            {
            	data:'category_name' ,
            	name:'category_name',
            	'title' : 'Category Name'
            },
            {
            	data:'subcategory_name',
            	name:'subcategory_name',
            	title:'Subcategory Name'
            },
            {
            		data:'createdBy',
            		name: 'createdBy',
            		title: 'Created By'
            },
            {
            	data: 'image', 
            	name: 'image' ,
            	'title' : 'image'
            },
            {
            	data: 'action', 
            	name: 'action', 
            	orderable: false, 
            	searchable: false,
            	title:'action'
            },{
            	data:'statusChange',
            	name:'statusChange',
            	orderable: false, 
            	searchable: false,
            	title:'status'

            }
     ]
	});
	}

</script>
