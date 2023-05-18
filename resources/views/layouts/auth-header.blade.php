<div class="main-header  side-header">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="app-sidebar__toggle mobile-toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icons" data-eva="menu-outline"></i></a>
							<a class="close-toggle" href="#"><i class="header-icons" data-eva="close-outline"></i></a>
						</div>
						<div class="responsive-logo">
							<a href="index.html"><img src="{{url('logo.png')}}" class="logo-1"></a>
							<a href="index.html"><img src="{{url('logo.png')}}" class="logo-11"></a>
							<a href="index.html"><img src="{{url('logo.png')}}" class="logo-2"></a>
							<a href="index.html"><img src="{{url('logo.png')}}" class="logo-12"></a>
						</div>
						
					</div>
					<div class="main-header-right">
						
						<div class="nav nav-item  navbar-nav-right ml-auto">
							
							
							<div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#"><i class="fe fe-bell"></i><span class=" pulse"></span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary-gradient text-left d-flex">
										<div class="">
											<h6 class="menu-header-title text-white mb-0">7 new Notifications</h6>
										</div>
										<div class="my-auto ml-auto">
											<a class="badge badge-pill badge-warning float-right" href="#">Mark All Read</a>
										</div>
									</div>
									<div class="main-notification-list Notification-scroll">
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-success-transparent">
												<i class="la la-shopping-basket text-success"></i>
											</div>
											<div class="ml-3">
												<h5 class="notification-label mb-1">New Order Received</h5>
												<div class="notification-subtext">1 hour ago</div>
											</div>
											<div class="ml-auto" >
												<i class="las la-angle-right text-right text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-danger-transparent">
												<i class="la la-user-check text-danger"></i>
											</div>
											<div class="ml-3">
												<h5 class="notification-label mb-1">22 verified registrations</h5>
												<div class="notification-subtext">2 hour ago</div>
											</div>
											<div class="ml-auto" >
												<i class="las la-angle-right text-right text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-primary-transparent">
												<i class="la la-check-circle text-primary"></i>
											</div>
											<div class="ml-3">
												<h5 class="notification-label mb-1">Project has been approved</h5>
												<div class="notification-subtext">4 hour ago</div>
											</div>
											<div class="ml-auto" >
												<i class="las la-angle-right text-right text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-pink-transparent">
												<i class="la la-file-alt text-pink"></i>
											</div>
											<div class="ml-3">
												<h5 class="notification-label mb-1">New files available</h5>
												<div class="notification-subtext">10 hour ago</div>
											</div>
											<div class="ml-auto" >
												<i class="las la-angle-right text-right text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-warning-transparent">
												<i class="la la-envelope-open text-warning"></i>
											</div>
											<div class="ml-3">
												<h5 class="notification-label mb-1">New review received</h5>
												<div class="notification-subtext">1 day ago</div>
											</div>
											<div class="ml-auto" >
												<i class="las la-angle-right text-right text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3" href="#">
											<div class="notifyimg bg-purple-transparent">
												<i class="la la-gem text-purple"></i>
											</div>
											<div class="ml-3">
												<h5 class="notification-label mb-1">Updates Available</h5>
												<div class="notification-subtext">2 days ago</div>
											</div>
											<div class="ml-auto" >
												<i class="las la-angle-right text-right text-muted"></i>
											</div>
										</a>
									</div>
									<div class="dropdown-footer">
										<a href="#">VIEW ALL</a>
									</div>
								</div>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">

								<a class="profile-user d-flex" href="#"><img src="{{url('backend/img/faces/6.jpg')}}" alt="user-img" class="rounded-circle mCS_img_loaded"><span></span></a>

								<div class="dropdown-menu">
									<div class="main-header-profile header-img">
										<div class="main-img-user"><img alt="" src="{{url('backend/img/faces/6.jpg')}}"></div>
										<h6>{{ Auth::guard(getAuthGaurd())->user()->name }}</h6><span>{{ucfirst(getAuthGaurd())}}</span>
									</div>
									<a class="dropdown-item" href="#"><i class="far fa-user"></i> My Profile</a>
									
								
									<a class="dropdown-item" href="#"><i class="fas fa-sliders-h"></i> Account Settings</a>
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            			@csrf
                        			</form>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>