{{-- @extends('home_layout')
@section('content')
<section id="cart_items">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li><a href="{{ route('trangchu') }}">Home</a></li>
			<li class="active">Thanh toán giỏ hàng</li>
		</ol>
	</div>

	<div class="review-payment">
		<h2>Xem lại giỏ hàng</h2>
	</div>
    	<div class="table-responsive cart_info">
		<table class="table table-condensed">
			<thead>
				<tr class="cart_menu">
					<td class="image">Hình ảnh</td>
					<td class="description">Mô tả</td>
					<td class="price">Giá</td>
					<td class="quantity">Số lượng</td>
					<td class="total">Tổng tiền</td>
					<td></td>
				</tr>
			</thead>
			@php
			{{$cart = Session::get('cart');$total=0;}}
			@endphp
			<tbody>
				@if (session('thongbao'))
				<div class="alert-success text-center" style="padding: 15px">
					<p>{{ session('thongbao') }}</p>
				</div>
				@endif
				@foreach ($cart as $value)
				@php
				$subtotal = $value['product_price']*$value['product_qty'];
				$total = $total + $subtotal;
				@endphp
				<td class="cart_product">
					<a href="{{route('chitietsanpham',$value['product_id']) }}"><img src="{{ asset('public/upload/product/'.$value['product_image']) }}" alt="" width="50" ></a>
				</td>
				<td class="cart_description">
					<h4><a href="">{{ $value['product_name'] }}</a></h4>
					<p>Web ID: {{ $value['session_id'] }}</p>
				</td>
				<td class="cart_price">
					<p>{{ currency_format($value['product_price']) }}</p>
				</td>
				<td class="cart_quantity">
					<div class="cart_quantity_button">
						<form>
							@csrf
							<input class="cart_quantity_input_{{ $value['session_id'] }} text-center" type="number" name="quantity" value="{{ $value['product_qty'] }}" autocomplete="off" min="1">
							<input type="button" name="update" value="Cập nhật" class="btn btn-default btn-sm capnhat" data-id="{{ $value['session_id'] }}">
						</form>

					</div>
				</td>
				<td class="cart_total">
					<p class="cart_total_price">{{currency_format($subtotal)}}</p>
				</td>
				<td class="cart_delete">
					<a class="cart_quantity_delete session_id" data-href="{{ $value['session_id'] }}"><i class="fa fa-times"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
		</tbody>
	</table>
</div>
  <form action="{{ route('dathang')}}" method="POST">
  	@csrf
	<div class="payment-options">
		@if (count(Session::get('cart'))>0)
		<span>
			<label><input name="payment_option" value="1" type="radio">
			Trả bằng thẻ ATM</label>
		</span>
		<span>
			<label><input name="payment_option" value="2" type="radio">
			Nhận tiền mặt</label>
		</span>
			<input type="submit" name="send_order_place" value="Đặt hàng" class="btn btn-primary btn-sm dathang form-control">
		@endif
		{{-- <span>
			<label><input type="checkbox"> Paypal</label>
		</span> --}}
	</div>
	</form>
</section> <!--/#cart_items-->
@stop --}}