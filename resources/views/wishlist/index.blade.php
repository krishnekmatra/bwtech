	<style type="text/css">
	.whislist-empty {
	align-items: center;
	justify-content: center;
	flex-direction: column;
	display: block;
  margin-left: auto;
  margin-right: auto;
	}
.grow {
	-webkit-animation: grow 1s linear 0s infinite alternate;
	-moz-animation: grow 1s linear 0s infinite alternate;
	-ms-animation: grow 1s linear 0s infinite alternate;
	-o-animation: grow 1s linear 0s infinite alternate;
	animation: grow 1s linear 0s infinite alternate;
}

@-webkit-keyframes grow {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(1.2);
		-o-transform: scale(1.2);
		-ms-transform: scale(1.2);
		-webkit-transform: scale(1.2);
		transform: scale(1.2);
	}
}
@-moz-keyframes grow {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(1.2);
		-o-transform: scale(1.2);
		-ms-transform: scale(1.2);
		-webkit-transform: scale(1.2);
		transform: scale(1.2);
	}
}
@-ms-keyframes grow {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(1.2);
		-o-transform: scale(1.2);
		-ms-transform: scale(1.2);
		-webkit-transform: scale(1.2);
		transform: scale(1.2);
	}
}
@-o-keyframes grow {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(1.2);
		-o-transform: scale(1.2);
		-ms-transform: scale(1.2);
		-webkit-transform: scale(1.2);
		transform: scale(1.2);
	}
}
@keyframes grow {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(1.2);
		-o-transform: scale(1.2);
		-ms-transform: scale(1.2);
		-webkit-transform: scale(1.2);
		transform: scale(1.2);
	}
}

/*shrink*/

.shrink {
	-webkit-animation: shrink 1s linear 0s infinite alternate;
	-moz-animation: shrink 1s linear 0s infinite alternate;
	-ms-animation: shrink 1s linear 0s infinite alternate;
	-o-animation: shrink 1s linear 0s infinite alternate;
	animation: shrink 1s linear 0s infinite alternate;
}
@-webkit-keyframes shrink {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(0.8);
		-o-transform: scale(0.8);
		-ms-transform: scale(0.8);
		-webkit-transform: scale(0.8);
		transform: scale(0.8);
	}
}
@-moz-keyframes shrink {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(0.8);
		-o-transform: scale(0.8);
		-ms-transform: scale(0.8);
		-webkit-transform: scale(0.8);
		transform: scale(0.8);
	}
}
@-ms-keyframes shrink {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(0.8);
		-o-transform: scale(0.8);
		-ms-transform: scale(0.8);
		-webkit-transform: scale(0.8);
		transform: scale(0.8);
	}
}
@-o-keyframes shrink {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(0.8);
		-o-transform: scale(0.8);
		-ms-transform: scale(0.8);
		-webkit-transform: scale(0.8);
		transform: scale(0.8);
	}
}
@keyframes shrink {
	0% {
		-moz-transform: scale(1);
		-o-transform: scale(1);
		-ms-transform: scale(1);
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	100% {
		-moz-transform: scale(0.8);
		-o-transform: scale(0.8);
		-ms-transform: scale(0.8);
		-webkit-transform: scale(0.8);
		transform: scale(0.8);
	}
}


.animate-charcter
{
	 text-transform: uppercase;
	background-image: linear-gradient(
		-225deg,
		#231557 0%,
		#44107a 29%,
		#cd8c9e 67%,
		#9a2948 100%
	);
	background-size: auto auto;
	background-clip: border-box;
	background-size: 200% auto;
	color: #fff;
	background-clip: text;
	text-fill-color: transparent;
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;
	animation: textclip 2s linear infinite;
	display: inline-block;
font-size: 20px;
margin:0;
text-transform: capitalize;
}

@keyframes textclip {
	to {
		background-position: 200% center;
	}
}

h6.nothing {
		color: #020101;
		font-family: Poppins, sans-serif;
		font-size: 14px;
		text-transform: capitalize;
		letter-spacing: 0;
}
	</style>

<x-guest-layout>
	
	<nav class="breadcrumb-nav mb-10">
		<div class="container">
			<ul class="breadcrumb">
					<li><a href="{{url('/')}}">Home</a></li>
					<li>Wishlist</li>
			</ul>
		 </div>
	</nav>
	@if(count($wishlist) > 0)
	<div class="page-content mb-10">
								<div class="container">
										<h3 class="wishlist-title">My Catalogue</h3>
										<div class="row cols-sm-3 cart-table">
															 
																@foreach($wishlist as $value)
																<div class="store-wrap mb-4 removetr{{$value['id']}}">
																		<div class="store store-grid store-wcfm">
																				<div class="store-header">
																						<figure class="store-banner">
																								<img src="{{url('front/background.png')}}" alt="Vendor" width="200" height="100" style="background-color: #40475E">
																						</figure>
																				</div>
																				<!-- End of Store Header -->
																				<div class="store-content">
																						<h4 class="store-title">
																								<a href="vendor-dokan-store.html">{{$value['name']}}</a>
																						</h4>
																					 
																						<ul class="seller-info-list list-style-none pl-0">
																								<li class="store-email">
																										<a>
																											 
																												<span class="wishlistspan">Count :<b class="bold-wishlist-font">{{$value['product_wish_list_count']}}</b> </span>
																										</a>
																								</li>
																								
																						</ul>
																				</div>
																				<!-- End of Store Content -->
																			 
																				<div class="store-footer">
																					 @if($value['product_wish_list_count'] > 0)
																						<a href="#" data-id="{{$value['id']}}" class="download"><figure class="seller-brand">
																								<div class="icon-box text-center">
																								<span class="icon-box-icon icon-download">
																										<i class="w-icon-download"></i>
																								</span>
																								
																						</div>

																						</figure></a>
																						@endif
																						<a href="{{url('catalogue/view/'.$value['id'])}}" class="btn btn-inquiry btn-rounded btn-icon-left">View Catalogue</a>
																						<a href="#" class="btn btn-rounded btn-visit removecart" data-id="{{$value['id']}}">Remove</a>
																				</div>
																				<!-- End of Store Footer -->
																		</div>
																		<!-- End of Store -->
																</div>
																@endforeach
											</div>
									
									
								</div>
	</div>
@endif
	<div class="page-content show  text-center mb-10">
		<center>
	<div class="container row">
		
		<div class="col-12 align-items-center justify-center">
			<div class="whislist-empty text-center">
				<h4 class="animate-charcter mt-5"> Nothing is here </h4>
				<h6 class="nothing mt-10">No items in your collections yet </h6>
				<div class="grow mt-10"> 
					<svg data-v-4dd4f8ba="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 118" fill="none" width="128" height="118"><circle cx="49.6404" cy="68.6404" r="48.6404" fill="#9a2948"></circle>
						<line x1="17.216" y1="37.877" x2="42.1935" y2="37.877" stroke="#cd8c9e" stroke-width="2.62921" stroke-linecap="round"></line>
						<line x1="17.216" y1="26.0455" x2="51.3958" y2="26.0455" stroke="#cd8c9e" stroke-width="2.62921" stroke-linecap="round"></line>
						<line x1="17.216" y1="49.7085" x2="30.362" y2="49.7085" stroke="#cd8c9e" stroke-width="2.62921" stroke-linecap="round"></line>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M57.622 90.234C57.8092 90.4303 58.0587 90.5285 58.3394 90.5285C58.6201 90.5285 58.8696 90.4303 59.0567 90.234L70.7216 78.0309C70.7216 78.0145 70.7294 78.0063 70.7372 77.9981C70.745 77.99 70.7528 77.9818 70.7528 77.9654C73.9965 74.4975 73.9653 68.8703
						70.6904 65.4351C67.3843 61.9999 61.9885 61.9999 58.7136 65.4024L58.3394 65.795L57.9963
						65.4351C54.6902 61.9999 49.2944 61.9999 45.9884 65.4351C42.6823 68.903 42.6823 74.5302
						45.9884 77.9981L46.0195 78.0309L57.622 90.234ZM58.3395 87.9765L47.4232 76.5258C46.1756
						75.2499 45.5206 73.5487 45.5206 71.7493C45.5206 69.9172 46.2068 68.2159 47.4232
						66.94C49.9183 64.29 54.0353 64.29 56.5617 66.94L57.6221 68.0523C57.8092 68.2486 58.0588
						68.3468 58.3395 68.3468C58.6202 68.3468 58.8697 68.2486 59.0568 68.0523L60.1173
						66.94C62.6124 64.29 66.7294 64.29 69.2558 66.94C71.7821 69.5573 71.7821 73.8758 69.2558
						76.5258L69.2246 76.5586L58.3395 87.9765Z" fill="#cd8c9e"></path>
						<path d="M57.622 90.234L57.3838 90.4605L57.3841 90.4608L57.622 90.234ZM59.0567 90.234L58.8192
						90.0069L58.8189 90.0072L59.0567 90.234ZM70.7216 78.0309L70.9592 78.258L71.0502
						78.1627V78.0309H70.7216ZM70.7372 77.9981L70.9751 78.2249L70.9751 78.2249L70.7372
						77.9981ZM70.7528 77.9654L70.5128 77.7409L70.4241 77.8357V77.9654H70.7528ZM70.6904
						65.4351L70.9283 65.2083L70.9272 65.2072L70.6904 65.4351ZM58.7136 65.4024L58.4769
						65.1745L58.4758 65.1756L58.7136 65.4024ZM58.3394 65.795L58.1015 66.0218L58.3394
						66.2713L58.5773 66.0218L58.3394 65.795ZM57.9963 65.4351L58.2342 65.2083L58.2331
						65.2072L57.9963 65.4351ZM45.9884 65.4351L45.7515 65.2072L45.7505 65.2083L45.9884
						65.4351ZM45.9884 77.9981L45.7505 78.2249L45.7505 78.2249L45.9884 77.9981ZM46.0195
						78.0309L46.2577 77.8044L46.2574 77.8041L46.0195 78.0309ZM47.4232 76.5258L47.661
						76.299L47.6581 76.2961L47.4232 76.5258ZM58.3395 87.9765L58.1016 88.2033L58.3395
						88.4528L58.5773 88.2033L58.3395 87.9765ZM47.4232 66.94L47.661 67.1668L47.6624
						67.1653L47.4232 66.94ZM56.5617 66.94L56.7995 66.7132V66.7132L56.5617 66.94ZM57.6221
						68.0523L57.3842 68.2791L57.6221 68.0523ZM59.0568 68.0523L58.8189 67.8256L59.0568
						68.0523ZM60.1173 66.94L60.3551 67.1668L60.3565 67.1653L60.1173 66.94ZM69.2558 66.94L69.0179
						67.1668L69.0193 67.1682L69.2558 66.94ZM69.2558 76.5258L69.0179 76.2991L69.0179
						76.2991L69.2558 76.5258ZM69.2246 76.5586L69.4625 76.7853L69.4625 76.7853L69.2246
						76.5586ZM58.3394 90.1998C58.1393 90.1998 57.9789 90.1321 57.8599 90.0072L57.3841
						90.4608C57.6394 90.7285 57.978 90.8571 58.3394 90.8571V90.1998ZM58.8189 90.0072C58.6998
						90.1321 58.5394 90.1998 58.3394 90.1998V90.8571C58.7007 90.8571 59.0394 90.7285 59.2946
						90.4608L58.8189 90.0072ZM70.484 77.8038L58.8192 90.0069L59.2943 90.4611L70.9592
						78.258L70.484 77.8038ZM70.4993 77.7714C70.4861 77.7852 70.3929 77.8761 70.3929
						78.0309H71.0502C71.0502 78.0804 71.037 78.1305 71.0117 78.1746C70.9917 78.2096 70.9672
						78.2331 70.9751 78.2249L70.4993 77.7714ZM70.4241 77.9654C70.4241 77.9159 70.4374 77.8658
						70.4626 77.8217C70.4826 77.7867 70.5071 77.7632 70.4993 77.7714L70.9751 78.2249C70.9882
						78.2111 71.0814 78.1202 71.0814 77.9654H70.4241ZM70.4525 65.6619C73.6074 68.9712 73.6373
						74.4004 70.5128 77.7409L70.9928 78.1899C74.3557 74.5946 74.3232 68.7695 70.9283
						65.2083L70.4525 65.6619ZM58.9504 65.6303C62.0952 62.363 67.276 62.3613 70.4536
						65.663L70.9272 65.2072C67.4927 61.6385 61.8819 61.6368 58.4769 65.1745L58.9504
						65.6303ZM58.5773 66.0218L58.9515 65.6292L58.4758 65.1756L58.1015 65.5682L58.5773
						66.0218ZM57.7584 65.6619L58.1015 66.0218L58.5773 65.5682L58.2342 65.2083L57.7584
						65.6619ZM46.2252 65.663C49.4019 62.3622 54.5827 62.3622 57.7595 65.663L58.2331
						65.2072C54.7977 61.6377 49.1869 61.6377 45.7516 65.2072L46.2252 65.663ZM46.2262
						77.7714C43.0412 74.4304 43.0412 69.0029 46.2262 65.6619L45.7505 65.2083C42.3234 68.8032
						42.3234 74.63 45.7505 78.2249L46.2262 77.7714ZM46.2574 77.8041L46.2262 77.7714L45.7505
						78.2249L45.7817 78.2576L46.2574 77.8041ZM57.8602 90.0076L46.2577 77.8044L45.7814
						78.2573L57.3838 90.4605L57.8602 90.0076ZM47.1853 76.7526L58.1016 88.2033L58.5773
						87.7497L47.661 76.2991L47.1853 76.7526ZM45.1919 71.7493C45.1919 73.6292 45.8769 75.4146
						47.1882 76.7556L47.6581 76.2961C46.4742 75.0852 45.8492 73.4681 45.8492
						71.7493H45.1919ZM47.1853 66.7132C45.9099 68.051 45.1919 69.8338 45.1919
						71.7493H45.8492C45.8492 70.0005 46.5037 68.3808 47.661 67.1668L47.1853 66.7132ZM56.7995
						66.7132C54.1445 63.9282 49.8096 63.926 47.1839 66.7147L47.6624 67.1653C50.027 64.6539
						53.9261 64.6517 56.3238 67.1668L56.7995 66.7132ZM57.86 67.8256L56.7995 66.7132L56.3238
						67.1668L57.3842 68.2791L57.86 67.8256ZM58.3395 68.0181C58.1394 68.0181 57.979 67.9504 57.86
						67.8256L57.3842 68.2791C57.6395 68.5469 57.9781 68.6754 58.3395 68.6754V68.0181ZM58.8189
						67.8256C58.6999 67.9504 58.5395 68.0181 58.3395 68.0181V68.6754C58.7008 68.6754 59.0394
						68.5469 59.2947 68.2791L58.8189 67.8256ZM59.8794 66.7132L58.8189 67.8256L59.2947
						68.2791L60.3551 67.1668L59.8794 66.7132ZM69.4936 66.7132C66.8386 63.9282 62.5037 63.926
						59.878 66.7147L60.3565 67.1653C62.7211 64.6539 66.6202 64.6517 69.0179 67.1668L69.4936
						66.7132ZM69.4936 76.7526C72.1403 73.9764 72.1423 69.4572 69.4922 66.7117L69.0193
						67.1682C71.422 69.6574 71.424 73.7752 69.0179 76.2991L69.4936 76.7526ZM69.4625
						76.7853L69.4937 76.7526L69.0179 76.2991L68.9867 76.3318L69.4625 76.7853ZM58.5773
						88.2033L69.4625 76.7853L68.9867 76.3318L58.1016 87.7497L58.5773 88.2033Z" fill="#c40000"></path><mask id="path-7-inside-1_2194_48850" fill="white"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.5293 13.146C3.5293 10.2418 5.88358 7.88757 8.78772 7.88757H61.1419C64.0461 7.88757
							66.4004 10.2418 66.4004 13.146V52.995C66.4004 53.7211 65.8118 54.3096 65.0858
							54.3096C64.3597 54.3096 63.7712 53.7211 63.7712 52.995V13.146C63.7712 11.6939 62.594
							10.5168 61.1419 10.5168H8.78772C7.33565 10.5168 6.15851 11.6939 6.15851
							13.146V77.8575C6.15851 79.3096 7.33565 80.4867 8.78772 80.4867H35.6221C36.3481 80.4867
							36.9367 81.0753 36.9367 81.8013C36.9367 82.5274 36.3481 83.1159 35.6221
							83.1159H8.78772C5.88357 83.1159 3.5293 80.7617 3.5293 77.8575V13.146Z"></path></mask><path fill-rule="evenodd" clip-rule="evenodd" d="M3.5293 13.146C3.5293 10.2418 5.88358 7.88757 8.78772 7.88757H61.1419C64.0461 7.88757
						66.4004 10.2418 66.4004 13.146V52.995C66.4004 53.7211 65.8118 54.3096 65.0858
						54.3096C64.3597 54.3096 63.7712 53.7211 63.7712 52.995V13.146C63.7712 11.6939 62.594
						10.5168 61.1419 10.5168H8.78772C7.33565 10.5168 6.15851 11.6939 6.15851
						13.146V77.8575C6.15851 79.3096 7.33565 80.4867 8.78772 80.4867H35.6221C36.3481 80.4867
						36.9367 81.0753 36.9367 81.8013C36.9367 82.5274 36.3481 83.1159 35.6221
						83.1159H8.78772C5.88357 83.1159 3.5293 80.7617 3.5293 77.8575V13.146Z" fill="#c40000"></path><path d="M8.78772 6.57297C5.15754 6.57297 2.21469 9.51581 2.21469 13.146H4.8439C4.8439 10.9679
						6.60961 9.20218 8.78772 9.20218V6.57297ZM61.1419
						6.57297H8.78772V9.20218H61.1419V6.57297ZM67.715 13.146C67.715 9.51581 64.7721 6.57297
						61.1419 6.57297V9.20218C63.3201 9.20218 65.0858 10.9679 65.0858 13.146H67.715ZM67.715
						52.995V13.146H65.0858V52.995H67.715ZM65.0858 55.6242C66.5378 55.6242 67.715 54.4471 67.715
						52.995H65.0858V55.6242ZM62.4566 52.995C62.4566 54.4471 63.6337 55.6242 65.0858
						55.6242V52.995H65.0858H62.4566ZM62.4566 13.146V52.995H65.0858V13.146H62.4566ZM61.1419
						11.8314C61.868 11.8314 62.4566 12.42 62.4566 13.146H65.0858C65.0858 10.9679 63.32 9.20218
						61.1419 9.20218V11.8314ZM8.78772 11.8314H61.1419V9.20218H8.78772V11.8314ZM7.47312
						13.146C7.47312 12.42 8.06169 11.8314 8.78772 11.8314V9.20218C6.60961 9.20218 4.8439 10.9679
						4.8439 13.146H7.47312ZM7.47312 77.8575V13.146H4.8439V77.8575H7.47312ZM8.78772
						79.1721C8.06169 79.1721 7.47312 78.5836 7.47312 77.8575H4.8439C4.8439 80.0356 6.60961
						81.8013 8.78772 81.8013V79.1721ZM35.6221 79.1721H8.78772V81.8013H35.6221V79.1721ZM38.2513
						81.8013C38.2513 80.3493 37.0742 79.1721 35.6221 79.1721V81.8013H38.2513ZM35.6221
						84.4305C37.0742 84.4305 38.2513 83.2534 38.2513 81.8013H35.6221V84.4305ZM8.78772
						84.4305H35.6221V81.8013H8.78772V84.4305ZM2.21469 77.8575C2.21469 81.4877 5.15754 84.4305
						8.78772 84.4305V81.8013C6.60961 81.8013 4.8439 80.0356 4.8439 77.8575H2.21469ZM2.21469
						13.146V77.8575H4.8439V13.146H2.21469Z" fill="#95979D" mask="url(#path-7-inside-1_2194_48850)"></path>
					<circle cx="118.556" cy="53.2415" r="8.54494" fill="#cd8c9e"></circle>
					<circle cx="97.522" cy="12.4888" r="12.4888" fill="#cd8c9e"></circle>
					</svg>
				</div>
			</div>
		</div>
	
	</div>
	</center>
</div>
</x-guest-layout>
<script type="text/javascript">
	var page_count = "{{count($wishlist)}}";
	shodata(page_count);

	$(".cart-table").on("click", ".removecart", function() {
		var id = $(this).attr('data-id');
		var whichtr = $(this).closest("div");
		var rowCount = $(".cart-table .store-wrap").length;
		if (confirm('Are you sure want to remove?')) {
			$.ajax({
					type: "post",
					url: '{{ url("removewishlist") }}',
					data: {
							"id": id,
							"_token": "{{ csrf_token() }}",
					},
					success: function(response) {
						$('.cart-count ').text(response.count);
								$('.removetr'+id).remove();

								if(rowCount == 1){

								shodata(response.count);
									$(".cart-table").hide();
								}  
					},
			});
		}else{
			return false;
		}
});
	function shodata(count){
		if(count > 0 ){
				$(".show").hide();
		}else{
				$(".show").show();
		}
	}
	$('.download').click(function(){
			var id = $(this).attr('data-id');
			$('#download_id').val(id);
			 Wolmart.popup({
						items:{
							src:'.productPrice-popup'
							},
							type:'inline',
							mainClass:'mfp-productPrice mfp-fadein-popup',
							callbacks:{
								beforeClose:function(){
									
								}
							}
					});
	});
	$('.productPriceClose').click(function(){
			 $('.mfp-close').trigger('click');
	});

</script>