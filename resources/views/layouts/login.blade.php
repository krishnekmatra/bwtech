<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Title -->
	<title> Ekmatra</title>

	<!--- Favicon -->
	<link rel="icon" href="{{url('backend/img/brand/favicon.png')}}" type="image/x-icon"/>


	
	<!--- Style css -->
	<link href="{{url('backend/css/style.css')}}" rel="stylesheet">
	<link href="{{url('backend/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

	<!--- Sidemenu css -->
	<style type="text/css">
		.error{
			color:#a94442;
		}
	</style>
</head>
<body class="main-body">
	 {{ $slot }}
</body>
<script src="{{url('backend/plugins/notify/js/notifIt.js')}}"></script>

<script src="{{url('backend/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
	function notifyMsg(msg,type) {
		notif({
			msg: msg,
			type: type
		});
	}
</script>
</html>