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
								@if(@$subCategory)
								<div class="widget widget-collapsible">
									<h3 class="widget-title"><label>All Categories</label></h3>
									<ul class="widget-body filter-items search-ul">
										@foreach($subCategory as $val)
											@if(@$subcategory_name)
												 @if($val['name'] == $subcategory_name)
												 <?php $color = "style = 'color:#9a2948'"?>
												 @else
												 <?php $color ="";?>
												 @endif
											@else
											<?php $color ="";?>
										   	@endif
											<li class="active"><a href="{{url('shop/'.$cat_slug.'/'.$val['slug'])}}" <?php echo $color;?>>{{$val['name']}}</a></li>
											
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
								@if(@$features)
								@foreach($features as $val)
								<div class="widget widget-collapsible">
									<h3 class="widget-title"><label>{{$val['featureName']['name']}}</label></h3>
									@if($val['featureName']['FeatureAttributes'])
									<ul class="widget-body filter-items item-check mt-1 brand-item">
											@foreach($val['featureName']['FeatureAttributes'] as $attribute)
											<li data-id="{{$attribute['id']}}"><a href="javascript:void(0)">{{$attribute['name']}}</a></li>
											@endforeach
									</ul>
									@endif
								</div>
								@endforeach
								@endif

								<!-- Start of Collapsible Widget -->
								@if(@$brand)
								<div class="widget widget-collapsible">
									<h3 class="widget-title"><label>Brand</label></h3>
									<ul class="widget-body filter-items item-check mt-1 brand-item">
										@foreach($brand as $val)
										@if(@$val['feature_attributes'])
												<li data-id="{{$val['feature_attributes']['id']}}"><a href="javascript:void(0)">{{$val['feature_attributes']['name']}}</a></li>
										@endif
										@endforeach
									</ul>
								</div>
								@endif
								<!-- End of Collapsible Widget -->
								<div class="widget widget-collapsible">
									<h3 class="widget-title"><label>Minimum qty</label></h3>
									<ul class="widget-body filter-items item-check qty-item">
										<li data-minqty="1" data-maxqty="50"><a href="#">Under 50</a></li>
										<li data-minqty="50" data-maxqty="100"><a href="#">50-100</a></li>
										<li data-minqty="100" data-maxqty="150"><a href="#">100-150</a></li>
										<li data-maxqty="150" data-minqty="0" data-maxqty="100"><a href="#">150 & up</a></li>
									</ul>
								</div>

								<!-- Start of Collapsible Widget -->
								<div class="widget widget-collapsible">
									<h3 class="widget-title"><label>Warranty</label></h3>
									<ul class="widget-body filter-items item-check warranty-item">
										<li data-value="0"><a href="#">No Warranty</a></li>
										<li data-value="1"><a href="#">1 year</a></li>
										<li data-value="2"><a href="#">2 years</a></li>
										<li data-value="3"><a href="#">3 years</a></li>
										<li data-value="4"><a href="#">4 years</a></li>
										<li data-value="5"><a href="#">5 years</a></li>
									</ul>
								</div>
								<!-- End of Collapsible Widget -->
							</div>
							<!-- End of Sidebar Content -->
						</div>
						<!-- End of Sidebar Content -->
					</aside>
