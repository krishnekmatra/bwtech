<aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
						<!-- Start of Sidebar Overlay -->
						<div class="sidebar-overlay"></div>
						<a class="sidebar-close" href="#"><i class="close-icon"></i></a>

						<!-- Start of Sidebar Content -->
						<div class="sidebar-content scrollable">
							<!-- Start of Sticky Sidebar -->
							<div class="sticky-sidebar">
								<div class="filter-actions">
									<label>Filter :</label>
									<a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
								</div>
								<!-- Start of Collapsible widget -->
								@if(isset($allcategory))
								<div class="widget widget-collapsible">
									<h3 class="widget-title"><label>All Categories</label></h3>
									<ul class="widget-body filter-items search-ul">
										@foreach($category as $val)
											
											<li><a href="{{url('shop/'.$val['slug'])}}">{{$val['name']}}</a></li>
											
										@endforeach
									</ul>
								</div>
								@endif
								
								<!-- End of Collapsible Widget -->

								<!-- Start of Collapsible Widget -->
								<div class="widget widget-collapsible">
									<h3 class="widget-title"><label>Price</label></h3>
									<div class="widget-body">
									  <ul class="widget-body filter-items item-check price-item">
									  	<li data-maxprice="99" data-minprice="1"><a href="#">Below to 100</a>
											<li data-maxprice="499" data-minprice="100"><a href="#">100 to 500</a></li>
											<li data-maxprice="999" data-minprice="500"><a href="#">500 to 1000</a></li>
											<li data-maxprice="4999" data-minprice="1000"><a href="#">1000 to 5000</a></li>
											<li data-maxprice="5000" data-minprice="0"><a href="#">5000 above</a></li>
										</ul>
									</div>
								</div>
								<!-- End of Collapsible Widget -->
								
							
								
								
								<!-- End of Collapsible Widget -->
							</div>
							<!-- End of Sidebar Content -->
						</div>
						<!-- End of Sidebar Content -->
					</aside>
