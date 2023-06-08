 <header class="header header-border">
			<div class="header-top">
				<div class="container">
					<div class="header-left">
						<p class="welcome-msg">Welcome to Bwtech Store!</p>
					</div>
					<div class="header-right">
					   
						<!-- End of DropDown Menu -->

					  
						<span class="divider d-lg-show"></span>
							<a href="{{url('vendor/login')}}" class="d-lg-show">Sell on Bwtech</a>
						@auth
								<a href="{{url('myaccount')}}" class="d-lg-show">My Account</a>
							
							@else
								<a href="{{url('login')}}" class="d-lg-show login sign-in"><i class="w-icon-account"></i>Sign In</a>
							@endauth
					</div>
				</div>
			</div>
			<!-- End of Header Top -->

			<div class="header-middle">
				<div class="container">
					<div class="header-left mr-md-4">
						<a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
						</a>
						<a href="{{url('/')}}" class="logo ml-lg-0">
							<img src="{{url('front//images/demos/demo12/logo.png')}}" alt="logo" width="120" height="45" />
						</a>
						<form method="get" action="{{url('search')}}"
									class="input-wrapper header-search hs-expanded hs-round d-none d-md-flex">
									<div class="select-box bg-white">
											<select id="category"  onchange="location = this.value;" id="select_cat_id">
													<option value="">All Categories</option>
													 @foreach($category as $value)
														<option value="{{url('shop/'.$value['slug'])}}">{{$value['name']}}</option>
													@endforeach
											</select>
									</div>
									<input type="text" class="form-control bg-white pt-0 pb-0" name="q" id="search"
											placeholder="Search in..." required />
									<button class="btn btn-search" type="submit">
											<i class="w-icon-search"></i>
									</button>
							</form>
					</div>
					<div class="header-right ml-4">
						<div class="header-call d-xs-show d-lg-flex align-items-center">
							<a href="tel:#" class="w-icon-call"></a>
							<div class="call-info d-lg-show">
								<h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
									<a href="https://portotheme.com/cdn-cgi/l/email-protection#daf9" class="text-capitalize">Live Chat</a></h4>
								<a href="tel:#" class="phone-number font-weight-bolder ls-50">{{$contact}}</a>
							</div>
						</div>
							<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
									<div class="cart-overlay"></div>
									@auth

										<a href="{{url('catalogue')}}" class=" label-down link">
											<i class="w-icon-cart">
												<span class="cart-count text-white">{{\Session::get('wishlistCount')}}</span>
											</i>

									</a>
									@else
									<a href="{{url('login')}}" class="  login sign-in wishlistAuth">
											<i class="w-icon-cart"></i>
									</a>
									@endauth
									
									<!-- End of Dropdown Box -->
							</div>
					  
					</div>
				</div>
			</div>
			<!-- End of Header Middle -->


			<div class="header-bottom sticky-content fix-top sticky-header">
				<div class="container">
					<div class="inner-wrap">
						<div class="header-left">
							 <div class="dropdown category-dropdown has-border" data-visible="true">
								<a href="#" class="category-toggle" role="button" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="true" data-display="static"
									title="Browse Categories">
									<i class="w-icon-category"></i>
									<span>Browse Categories</span>
								</a>

								<div class="dropdown-box">
									<ul class="menu vertical-menu category-menu">
										@foreach($category as $cat)
										<li>
											<a href="{{url('shop/'.$cat['slug'])}}">
												<i><img src="{{url('category/'.$cat['image'])}}" alt="Categroy" width="15" height="15" /></i>{{$cat['name']}}
											</a>
										
										</li>
										@endforeach
										
									   
										
										
									   
									</ul>
								</div>
							</div>
							<nav class="main-nav">
								<ul class="menu active-underline">
									
									<li class="shopby">
										<a href="javascript:void(0)">Shop By</a>

										<!-- Start of Megamenu -->
										<ul class="megamenu">
											<li>
												<h4 class="menu-title">Occasions</h4>
												<ul>
													@foreach($occasions as $value)
													<li><a href="{{url('shop-by/occasions/'.$value['slug'])}}">{{$value['name']}}</a></li>
													@endforeach
											   </ul>
											</li>
											<li>
												<h4 class="menu-title">Price</h4>
												<ul>
													<li><a href="{{url('shop-by/price/1-99')}}">Under 100</a></li>
													<li><a href="{{url('shop-by/price/100-499')}}">100 t0 500</a></li>
													<li><a href="{{url('shop-by/price/500-999')}}">500 to 1000</a></li>
													<li><a href="{{url('shop-by/price/1000-4999')}}">1000 to 5000</a></li>
													<li><a href="{{url('shop-by/price/0-5000')}}">5000 above</a></li>
													
												</ul>
											</li>
											
										   
										</ul>
										<!-- End of Megamenu -->
									</li>
									<li class="whatwedo">
                                        <a href="blog.html">What We Do</a>
                                        <ul>
                                            <li><a href="{{url('what-we-do/brandstore')}}">Brand Store</a></li>
                                            <li><a href="{{url('what-we-do/send')}}">Send</a></li>
                                            
                                        </ul>
                                    </li>
								
									
									 <li class="aboutus">
										<a href="{{url('about-us')}}">About Us</a>
									</li>
									 <li class="wearehiring">
										<a href="{{url('we-are-hiring')}}">We are hiring</a>
									</li>
								   
								   
								</ul>
							</nav>
						</div>
						<div class="header-right">
						   @auth
							<a class="d-lg-show mr-2 btn btn-dark btn-outline p15" style="padding:15px" href="{{url('submitanenquiry')}}">Request for Quotations</a >
							@else
								<a class="d-lg-show mr-2 btn btn-dark btn-outline sign-in requestforquotation p15" style="padding:15px" href="{{url('login')}}">Request for Quotations</a>
							@endauth
							<a href="{{url('contact-us')}}" class="d-lg-show mr-2 btn btn-dark btn-outline p15" style="padding:15px" >Contact Us</a>
						</div>
					</div>
				</div>
			</div>
		</header>