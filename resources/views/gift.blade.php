<x-guest-layout>
	   
			<div class="container pb-2">
				<!-- End Of Category Wrapper -->

				<nav class="breadcrumb-nav">
				<div class="container">
					<ul class="breadcrumb bb-no">
						<li><a href="{{url('/')}}">Home</a></li>
						<li><a>{{$main_name}}</a></li>
					</ul>
				</div>
			</nav>

				<div class="container">
				<div class="shop-content row gutter-lg">
					<!-- Start of Sidebar, Shop Sidebar -->
					<!-- End of Shop Sidebar -->
					@include('filter-view')
					<!-- Start of Main Content -->
					<div class="main-content">
						  @include('toolbox')
						
						<div id="tag_container">
							@include('presult')
						</div>
						
					</div>
				</div>
			</div>

		</div>

	   </div>
 
	</div>

</x-guest-layout>

<script type="text/javascript">
	$('.shopby').addClass('active');
  var brand_array = [];
  var page_count = 1;
  var warranty = '';
  var max_price = '';
  var min_price = '';
  var min_qty = '';
  var max_qty = '';
  var page_limit = '';
  var sort_by = 'created_at';
  var order_by = 'desc';
  var cat_id  = $("#cat_id").val();
  var type = "{{$type}}";
  var range = "{{$value}}";
  if(type == 'price'){
  	var split = range.split('-');
  	console.log(split);
   $('[data-maxprice='+split[1]+']').addClass('active');

  }
	$('.brand-item li').click(function(e){
		event.preventDefault();
      
		var id = $(this).attr('data-id');
		page_count = 1;
	
		var getClass = this.className;
		if(getClass == 'active'){
			removeBrand(id);
		}else{
				brand_array.push(id);		
		}
		getData(page_count);
  });

	$('#limit_product').change(function(e){
			var id = $(this).val();
			page_limit = id;
			page_count = 1;
			getData(page_count);
	});
  $('.price-item li').click(function(e){
  		page_count = 1;
  	

  		if(type == 'price'){
  			let url="{{url('shop-by/price/')}}" + "/"+$(this).attr('data-minprice')+'-'+$(this).attr('data-maxprice');
  			history.pushState('data', '',url);
  			range = $(this).attr('data-minprice') +'-'+$(this).attr('data-maxprice')
  		}else{
  				min_price = $(this).attr('data-minprice');
  				max_price = $(this).attr('data-maxprice');
  		}

  		var getClass = this.className;
  		if(getClass == 'active'){
  			min_price = '';
  			max_price = '';
  			
  			$('.price-item ul li').removeClass('active');
  		}else{
  			sort_by = "price"
				order_by = "asc";
  			$('.price-item li').removeClass('active');
				$(this).parent('.price-item li').addClass('active');
  		}
  		
			getData(page_count);
  });

  function removeBrand(id){
  	brand_array.splice($.inArray(id, brand_array), 1);
  	return brand_array;
  }
	
	$('.filter-clean').click(function(){
		brand_array = [];
  	page_count = 1;
   	warranty = '';
  	max_price = '';
  	min_price = '';
  	min_qty = '';
    max_qty = '';
    page_limit = $('#page_limit').val();
    sort_by = 'created_at';
    order_by = 'desc';
    getData(page_count);
	});

	$('.qty-item li').click(function(){
		page_count = 1;

		var id = $(this).attr('data-value');
	
		min_qty = $(this).attr('data-minqty');
		max_qty = $(this).attr('data-maxqty');
		var getClass = this.className;

		if(getClass == 'active'){
			$('.qty-item ul li').removeClass('active');
			$(this).parent('.qty-item ul li').removeClass('active');
			min_qty = '';
    	max_qty = '';
		}else{
			$('.qty-item li').removeClass('active');
			$(this).parent('.qty-item li').addClass('active');
		}
		
			getData(page_count);
	});

	$('.warranty-item li').click(function(){
		page_count = 1;

		var id = $(this).attr('data-value');
	  var getClass = this.className;

		if(getClass == 'active'){
			warranty = '';
			$('.warranty-item ul li').removeClass('active');
			$(this).parent('.warranty-item ul li').removeClass('active');
		}else{
			
			warranty = id;
			$('.warranty-item li').removeClass('active');
			$(this).parent('.warranty-item li').addClass('active');	
			
		}
		getData(page_count);
		

	});

	$(document).on('click', '.pagination a',function(event){
			event.preventDefault();
			$('.page-item li').removeClass('active');
			$(this).parent('.page-item li').addClass('active');
			var page = $(this).attr('data-value');
			page_count = page;
			getData(page_count);
			event.preventDefault();
	});

	function getData(page){
		$.ajax(
		{
				url:"{{route('shopByFilter')}}",
				type: "Post",
				async: false,
				cache: false,
				data :{
					'page' : page,
					"_token": "{{ csrf_token() }}",
					"brand_array" : brand_array,
					"warranty" : warranty,
					"max_price" : max_price,
					"min_price" : min_price,
					"min_qty" : min_qty,
					"max_qty" : max_qty,
					"page_limit" : page_limit,
					"sort_by" : sort_by,
					"order_by" : order_by,
					"occasion_id" : "{{$occasion_id}}",
					"feature_attribute_id" : "{{$feature_attribute_id}}",
					"range":range,
					"type" : type	
				},
				datatype: "html"
		}).done(function(data){
				$("#tag_container").html(data);
				 setTimeout(function () {
                $('html, body').animate({
                    scrollTop: $("#tag_container").offset().top - 500
                }, 777);
            }, 100);


		}).fail(function(jqXHR, ajaxOptions, thrownError){
				alert('No response from server');
		});
		 return false;
	}

	$('#orderby').change(function(){
		sort_by = $(this).val();
		order_by = $(this).find(':selected').attr('data-order')
		page_count = 1;
		getData(page_count);
	})

</script>
