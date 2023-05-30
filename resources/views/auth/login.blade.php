
<div class="login-popup">
		<div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
				<ul class="nav nav-tabs text-uppercase" role="tablist">
						<li class="nav-item">
								<a href="#sign-in" class="nav-link sign-in active">Sign In</a>
						</li>
						<!-- <li class="nav-item">
								<a href="#sign-up" class="nav-link  sign-up">Sign Up</a>
						</li> -->
				</ul>
				<div class="tab-content">
						<div class="tab-pane active" id="sign-in">
								<form  name="loginForm" method="POST" id="loginForm" autocomplete="off" action="">
									@csrf
									<input type="hidden" class="form-control" name="status" id="status" value="1">
									<div class="form-group">
											<label>Email address *</label>
											<input type="text" class="form-control" name="email" id="email" required  autocomplete="none">
											<span class="error" id="email1_error"></span>
									</div>
									<div class="form-group mb-0">
											<label>Password *</label>
											<input type="password" class="form-control" name="password" id="password" required  autocomplete="false">
											<span class="error" id="password_error"></span>
									</div>
									<div class="form-checkbox d-flex align-items-center justify-content-between">
											<input type="checkbox" class="custom-checkbox" id="remember" name="remember" required="">
											<a href="javascript:void(0)" id="lastPassword">Last your password?</a>
									</div>
									<a href="#" class="btn btn-primary" onClick="signin()">Sign In</a>
								</form>
						</div>
						<!-- <div class="tab-pane" id="sign-up">
								<form  name="registerForm" method="POST" id="registerForm">
									@csrf
								<div class="form-group">
										<label>Your Name *</label>
										<input type="text" class="form-control" name="name" id="name" required>
										<span class="error" id="name_error"></span>
								</div>
								<div class="form-group">
										<label>Phone *</label>
										<input type="text" class="form-control" name="phone" id="phone" required>
										<span class="error" id="phone_error"></span>
								</div>
								<div class="form-group">
										<label>Your Email address *</label>
										<input type="text" class="form-control" name="email_1" id="email_1" required>
										<span class="error" id="email_error"></span>
								</div>
								<div class="form-group mb-5">
										<label>Password *</label>
										<input type="password" class="form-control" name="password_1" id="password_1" required>
										<span class="error" id="password_1_error"></span>
								</div>
								
							
								<a href="#" class="btn btn-primary" onClick="signup()">Sign Up</a>
						</div> -->
				</div>
				
		</div>
</div>
