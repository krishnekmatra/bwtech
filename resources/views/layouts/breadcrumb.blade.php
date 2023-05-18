<div class="breadcrumb-header justify-content-between">
	<div>
		<h4 class="content-title mb-2">Hi, welcome back!</h4>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">@yield('breadcumb')</a></li>
			</ol>
		</nav>
	</div>
	<div class="d-flex my-auto">
						<div class=" d-flex right-page">
							<div class="d-flex justify-content-center mr-5">
								<div class="">
										@hasSection('backlink')

										<a href="@yield('backlink')" class="btn btn-danger btn-icon"><i class="typcn typcn-arrow-back-outline"></i></a>
										@endif

								</div>
							
							</div>
							
						</div>
					</div>
</div>