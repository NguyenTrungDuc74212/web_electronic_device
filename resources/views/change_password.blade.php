<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
	<title>Quên mật khẩu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}" >
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="{{asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
	<link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet"/>
	<!-- font CSS -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css"/>
	<link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet"> 
	<!-- //font-awesome icons -->
	<script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
</head>
<body>
	<style type="text/css">
		.w3layouts-main input[type="submit"]{
			margin: 8px auto;
		}
	</style>
	<div class="log-w3">
		<div class="w3layouts-main">
			<h2>Đổi mật khẩu</h2>
			@if (session('error'))
			<div class="text-danger">
				{{ session('error') }}
			</div>
			@elseif(session('thongbao'))
			<div class="text-success">
				{{ session('thongbao') }}
			</div>
			@endif
			<form action="{{ route('change_password') }}" method="POST">
				@csrf
				<input type="email" class="ggg" name="email" placeholder="E-MAIL" value="{{ old('email') }}">
				@error('email')
				<div class="text-danger">{{ $message }}</div>
				@enderror
				<input type="password" class="ggg" name="password" placeholder="nhập mật khẩu mới" required="">
				@error('password')
				<div class="text-danger">{{ $message }}</div>
				@enderror
				<input type="password" class="ggg" name="re_password" placeholder="nhập lại mật khẩu mới" required="">
				@error('re_password')
				<div class="text-danger">{{ $message }}</div>
				@enderror
				<div class="clearfix"></div>
				<input type="submit" value="Reset mật khẩu" name="">
				{{-- <a href="" class="text-center">Login Google</a> --}}
			</form>
			<div class="text-center">
				<a href="{{ route('login_view') }}" class="text-center">Đăng nhập</a>
			</div>

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
