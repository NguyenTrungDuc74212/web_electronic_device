@extends('home_layout')
@section('content')
<section id="cart_items">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li><a href="{{ route('trangchu') }}">Home</a></li>
			<li class="active" style="color: #1db93e">Success</li>
		</ol>
	</div>
		<div class="review-payment text-center">
				<h2 class="title text-center">Thông báo</h2>  
				<p>Cảm ơn bạn đã đặt hàng ở E-shopper, chúng tôi sẽ liên hệ với bạn sớm nhất</p>
		</div>
	
</section>

@stop