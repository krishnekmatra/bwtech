<style type="text/css">
  .form-group{
    text-align:left;
  }
</style>
<x-guest-layout>

			<nav class="breadcrumb-nav mb-10 pb-1">
				<div class="container">
					<ul class="breadcrumb">
						<li><a href="{{url('/')}}">Home</a></li>
						<li>Contact Us</li>
					</ul>
				</div>
			</nav>
			<!-- End of Breadcrumb -->

			<!-- Start of PageContent -->
			<div class="page-content contact-us">
				<div class="container">
					<section class="content-title-section mb-10">
						<h3 class="title title-center mb-3">Submit an enquiry</h3>
						<p class="text-center">Please write to us & we shall get back to you very shortly.</p>
					</section>
					<!-- End of Contact Title Section -->

					
					<!-- End of Contact Information section -->

				</div>
				<div class="container">
					<center>
					<div class="col-lg-6 mb-8">
              <form class="form enquiry-form" action="#" method="post">
              	@csrf
                  <div class="form-group">
                      <input type="text" id="name" name="name"
                          class="form-control" value="{{$user['name']}}" readonly>
                  </div>
                  <div class="form-group">
                      <input type="email" id="email" name="email"
                          class="form-control" value="{{$user['email']}}" readonly>
                  </div>
                  <div class="form-group">
                      <input type="text" id="phone" name="phone"
                          class="form-control" value="{{$user['phone']}}" readonly>
                  </div>
                  <div class="form-group">
                      <input type="text" id="quantity" name="quantity"
                          class="form-control" placeholder="Quantity">
                          <span class="error quantity_error"></span>
                  </div>
                  <div class="form-group">
                      <input type="text" id="prefered_category" name="prefered_category"
                          class="form-control" placeholder="Prefered Category">
                  </div>
                  <div class="form-group">
                      <input type="text" id="prefered_brand" name="prefered_brand"
                          class="form-control" placeholder="Prefered Brand">
                  </div>
                  <div class="form-group row">
                  	  <div class="col-6">
                      	<input type="text" id="min" name="min"
                          class="form-control" placeholder="Min">
                         <span class="error min_error"></span>
                      </div>
                      <div class="col-6">
                      	<input type="text" id="max" name="max"
                          class="form-control" placeholder="Max"/>
                          <span class="error max_error"></span>
                      </div>
                  </div>
                 <!--  <div class="form-group">
                  	 <input type="text" id="delivery_date" name="delivery_date"
                          class="form-control" placeholder="
                          Delivery Date"/>
                  </div> -->
                   <div class="form-group">
                      <input type="date" id="delivery_date" name="delivery_date"
                          class="form-control" placeholder="Delivery Date">
                  </div>
                  <div class="form-group">
                      <textarea id="enquiry" name="enquiry" cols="30" rows="5"
                          class="form-control" placeholder="your query"></textarea>
                       <span class="error enquiry_error"></span>
                  </div>
                  <button type="submit" class="btn btn-dark btn-rounded">Send Now</button>
              </form>
          </div>
        </center>
	      </div>
			</div>
</x-guest-layout>
<script type="text/javascript">
		$('.enquiry-form').on('submit', function(e) {
		e.preventDefault()
		let formValue = new FormData(this);
		$.ajax({
       		type: "Post",
          url: '{{ url("savesubmitanenquiry") }}',
          data: formValue,
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
          	if(response.success){
          		
          		notifyMsg(response.message,'success');
               setTimeout(function(){
                        window.location.href="{{url('myaccount')}}"+"#rfq";
              },2000);
          	

          	}else{
          		notifyMsg(response.message,'error');
          	}
          },
          error: function(response) {
          	let error = response.responseJSON;
            if(!error){
            		error = JSON.parse(response.responseText);
            }
            $.each( error.errors, function( key, value ) {
  								$("."+key+"_error").text(value);
						});
             $('html, body').animate({
                    scrollTop: $(".enquiry-form").offset().top - 100
            }, 777);
				}
	});
	});
</script>