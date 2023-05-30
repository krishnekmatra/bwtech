F@php
$url = getAuthGaurd();
@endphp
<aside class="main-sidebar app-sidebar sidebar-scroll">
			<div class="main-sidebar-header">
				<a class="desktop-logo logo-light active" href="{{url('')}}" class="text-center mx-auto"><img src="{{url('logo.png')}}" class="main-logo"></a>
				<a class="desktop-logo icon-logo active"href="index.html"><img src="{{url('backend/img/brand/favicon.png')}}" class="logo-icon"></a>
				<a class="desktop-logo logo-dark active" href="index.html"><img src="{{url('backend/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="index.html"><img src="{{url('backend/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div><!-- /logo -->
			<div class="main-sidebar-loggedin">
				<div class="app-sidebar__user">
					<div class="dropdown user-pro-body text-center">
						<div class="user-pic">
							<img src="{{url('backend/img/faces/6.jpg')}}" alt="user-img" class="rounded-circle mCS_img_loaded">
						</div>
						<div class="user-info">
							<h6 class=" mb-0 text-dark"> {{ Auth::guard(getAuthGaurd())->user()->name }}</h6>
							<span class="text-muted app-sidebar__user-name text-sm">{{ucfirst(getAuthGaurd())}}</span>
						</div>
					</div>
				</div>
			</div><!-- /user -->
			<div class="sidebar-navs">
				<ul class="nav  nav-pills-circle">
					
				   
				  
					<li class="nav-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout">
						<a class="nav-link text-center m-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="fe fe-power"></i>
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</li>
				</ul>
			</div>
			<div class="main-sidebar-body">
				<ul class="side-menu ">
					<li class="slide">
						<a class="side-menu__item" href='{{url("$url/dashboard")}}'><i class="side-menu__icon fe fe-airplay"></i><span class="side-menu__label">Dashboard</span></a>
					</li>
					<li class="slide products">
						<a class="side-menu__item" data-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-briefcase menu-icons"></i><span class="side-menu__label">Products</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
						
							@if($url == 'admin')
							<li><a class="slide-item category" href="{{url("$url/categories")}}">Category</a></li>

							<li><a class="slide-item features" href="{{url("$url/features")}}">Features</a></li>

							<li><a class="slide-item deals" href="{{url("$url/deals")}}">Deals</a></li>

							<li><a class="slide-item occasions" href="{{url("$url/occasions")}}">Occasions</a></li>

							
							@endif
							<li><a class="slide-item product" href="{{url("$url/products")}}">Product</a></li>
							
							
							
						</ul>
					</li>
					@if($url == 'admin')
					<li class="slide pages">
						<a class="side-menu__item" data-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon side-menu__icon fe fe-compass"></i><span class="side-menu__label">Pages</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item faq" href="{{url("$url/faqs")}}">FAQ</a></li>
							<li><a class="slide-item" href='{{url("$url/contact-us/add")}}'>Contact Us </a></li>
							<li><a class="slide-item wearehiring" href='{{url("$url/we-are-hirings")}}'>We Are Hiring </a></li>
							<li><a class="slide-item" href='{{url("$url/subscription/list")}}'>Subscription </a></li>
							<li><a class="slide-item" href='{{url("$url/leads")}}'>Leads </a></li>
							
							
							
						</ul>
					</li>
				
					<li class="slide">
						<a class="side-menu__item {{ request()->is($url.'/banners',$url.'/banner/add',$url.'/banner/edit/*',$url.'/banners/*')? 'active' : '' }}" href='{{url("$url/banners")}}'><i class="side-menu__icon fe fe-database"></i><span class="side-menu__label">Banners</span></a>
					</li>
					<li class="slide users">
						<a class="side-menu__item " data-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon  fe fe-user menu-icons"></i><span class="side-menu__label">Users</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item vendors" href="{{url("$url/users")}}">User</a></li>
							<!-- <li><a class="slide-item" href='{{url("$url/customers")}}'>Customers </a></li> -->
							
						</ul>
					</li>

					<li class="slide inquiries">
						<a class="side-menu__item " data-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-mail menu-icons"></i><span class="side-menu__label">Inquiries</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item inquiry" href="{{url("$url/inquiry")}}">Inquiry</a></li>
							<li><a class="slide-item rfq" href='{{url("$url/rfq")}}'>RFQ </a></li>
							
						</ul>
					</li>
					
					
					
					
					
				
					@endif
					
					
				  
				</ul>
			</div>
		</aside>