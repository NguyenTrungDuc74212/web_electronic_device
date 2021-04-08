@extends('home_layout')
@section('content')
@push('seo-meta')
<title>Đăng nhập hoặc đăng ký để thanh toán giỏ hàng|E-shoppoer</title>
@endpush
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			@if(!session('id_customer'))
			<div class="col-sm-3 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Đăng nhập tài khoản</h2>
					@if (session('thongbao_thatbai'))
					<p class="text-danger">{{ session('thongbao_thatbai') }}</p>
					@endif
					<form action="{{ route('login_customer')}}">
						@csrf
						<input type="text" placeholder="Tài khoản" name="email" />
						<input type="password" placeholder="Mật khẩu" name="password"/>
						<span>
							<input type="checkbox" class="checkbox"> 
							Ghi nhớ đăng nhập
						</span>
						<br>
						<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
						<br/>
						@if($errors->has('g-recaptcha-response'))
						<span class="invalid-feedback text-danger" style="display:block">
							<strong>{{$errors->first('g-recaptcha-response')}}</strong>
						</span>
						@endif
						<button type="submit" class="btn btn-primary">Đăng nhập</button>
					</form>
					<ul class="login-soical" style="margin: 10px;padding: 0px;">
						<li style="display: inline;margin: 5px;">
							<a href="{{ route('login_customer_google') }}">
							<img width="20%" alt="Đăng nhập tài khoản google" src="{{ asset('public/frontend/images/gg2.png') }}">
						</a>
						</li>
						<li style="display: inline;">
							<a href="">
							<img width="20%" alt="Đăng nhập tài khoản fb" src="{{ asset('public/frontend/images/fb1.png') }}">
						</a>
						</li>
					</ul>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">Hoặc</h2>
			</div>
			@endif
			<div class="col-sm-5">
				<div class="signup-form"><!--sign up form-->
					<h2>Đăng ký!</h2>
					<p>Điền thông tin gửi hàng</p>
					@if (session('thongbao'))
					<p class="text-success">{{ session('thongbao') }}</p>
					@endif
					<form action="{{ route('them_khachhang') }}" method="POST">
						@csrf
						<input type="text" placeholder="Họ và tên" name="name" />
						@error('name')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<input type="email" placeholder="email" name="email" />
						@error('email')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<input type="password" placeholder="Mật khẩu" name="password" />
						@error('password')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<input type="password" name="re_password" placeholder="Nhập lại mật khẩu"/>
						@error('re_password')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<input type="text" placeholder="Phone" name="phone" />
						@error('phone')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<br>
						<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
						<br/>
						@if($errors->has('g-recaptcha-response'))
						<span class="invalid-feedback text-danger" style="display:block">
							<strong>{{$errors->first('g-recaptcha-response')}}</strong>
						</span>
						@endif
						<button type="submit" class="btn btn-primary">Đăng ký</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
@stop