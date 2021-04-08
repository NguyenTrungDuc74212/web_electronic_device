<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
	<title>Trang quản lý admin web</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="{{'public/backend/css/bootstrap.min.css'}}" >
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="{{ 'public/backend/css/style.css' }}" rel='stylesheet' type='text/css' />
	<link href="{{ 'public/backend/css/style-responsive.css' }}" rel="stylesheet"/>
	<!-- font CSS -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ 'public/backend/css/font.css' }}" type="text/css"/>
	<link href="{{ 'public/backend/css/font-awesome.css' }}" rel="stylesheet"> 
	<!-- //font-awesome icons -->
	<script src="{{ 'public/backend/js/jquery2.0.3.min.js' }}"></script>
</head>
<body>
	<div class="log-w3">
		<div class="w3layouts-main">
			@php
				Request()->session()->forget('token');
			@endphp
			<h2>Đăng Nhập</h2>
			@if (session('thongbao'))
			<div class="text-danger">
				{{ session('thongbao') }}
			</div>
			@elseif(session('thongbao_2'))
			<div class="text-success">
				{{ session('thongbao_2') }}
			</div>
			@endif
			<form action="{{ route('login') }}" method="POST">
				@csrf
				<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
				<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
				<span><input type="checkbox" name="check" />Nhớ mật khẩu</span>
				<h6><a href="{{ route('form_forgot_pass') }}">Quên mật khẩu?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
				<div class="soical text-center">
					<a href="{{ route('facebook') }}" style="" class="btn btn-primary"><i class="fa fa-facebook-official" aria-hidden="true"></i>
					Login Facebook</a>
					<a href="{{ route('google') }}" style="" class="btn btn-default"><i class="fa fa-google" aria-hidden="true"></i>
					Login Google</a>
				</div>
				{{-- <a href="" class="text-center">Login Google</a> --}}
			</form>

			{{-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> --}}
		</div>
	</div>
	<script src="{{ 'public/backend/js/bootstrap.js '}}"></script>
	<script src="{{ 'public/backend/js/jquery.dcjqaccordion.2.7.js' }}"></script>
	<script src="{{ 'public/backend/js/scripts.js '}}"></script>
	<script src="{{ 'public/backend/js/jquery.slimscroll.js '}}"></script>
	<script src="{{ 'public/backend/js/jquery.nicescroll.js '}}"></script>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
	<script src="{{ 'public/backend/js/jquery.scrollTo.js '}}"></script>
</body>
</html>
