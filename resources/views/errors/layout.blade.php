<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="UTF-8">
			<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>@yield('title')</title>
			<link rel="icon" href="{{url('backend/img/brand/favicon.png')}}" type="image/x-icon"/>
			<link href="{{url('backend/css/style.css')}}" rel="stylesheet">
					<link href="{{url('backend/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
							<link href="{{url('backend/switcher/demo.css')}}" rel="stylesheet">	</head>


	</head>
	<body class="main-body">
		<div class="main-error-wrapper  page page-h ">
			<h1 class="">@yield('messages')<span class="tx-20">error</span></h1>
			<h2>Oopps. The page you were looking for doesn't exist.</h2>
			<h6>You may have mistyped the address or the page may have moved.</h6>
			<a class="btn btn-outline-indigo" href="index.html">Back to Home</a>
		</div>
				<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
				<script src="{{url('backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
						<script src="{{url('backend/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
						<script src="{{url('backend/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>



	</body>


</html>