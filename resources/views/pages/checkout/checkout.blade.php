@extends('home_layout')
@section('content')
@push('seo-meta')
<title>Đăng nhập hoặc đăng ký để thanh toán giỏ hàng|E-shoppoer</title>
@endpush
<section id="cart_items">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li><a href="{{ route('trangchu') }}">Home</a></li>
			<li class="active">Thanh toán giỏ hàng của bạn</li>
		</ol>
	</div>

	<div class="register-req">
		<p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và để xem lại lịch sử mua hàng</p>
	</div><!--/register-req-->
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
				@elseif(session('error'))
				<div class="alert-danger text-center" style="padding: 15px">
					<p>{{ session('error') }}</p>
				</div>

				@endif
				@if ($cart)
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
							<input type="hidden" class="product_name_{{ $value['session_id'] }}" value="{{ $value['product_name'] }}">
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
			@endif
		</tbody>
	</table>
	@if (Session::get('cart'))
	<div class="col-sm-12">
		<div class="total_area" style="margin: 20px 0px;">
			<ul>
				<li>Tổng tiền: <span>{{ currency_format($total) }}</span></li>
				@if (Session::get('coupon_ss'))
				@foreach (Session::get('coupon_ss') as $value)
				<li>Mã giảm: <span>-{{ $value['coupon_value']}} {{ $value['coupon_tinhnang']==2?'%':"VNĐ" }}</span></li>
				<li>Tổng giảm: 
					
					@if ($value['coupon_tinhnang']==2)
					<span>{{ currency_format($coupon_total = ($total*$value['coupon_value'])/100) }}</span>
					@elseif($value['coupon_tinhnang']==1)
					<span>{{ currency_format($coupon_total=$value['coupon_value']) }}</span>
					@endif
				</li>
				@endforeach
				@endif
				<li>Thuế:<span></span></li>
				<li>Phí vận chuyển:
					@if (Session::get('fee'))
					<span>{{currency_format( Session::get('fee')) }}</span>
					@endif 

				</li>
				@if (Session::get('coupon_ss'))
				<li>Tiền thanh toán:<span>{{ currency_format($total_offical = $total-$coupon_total+Session::get('fee') )}}</span></li>
				@else
				<li>Tiền thanh toán:<span>{{ currency_format($total_offical = $total+Session::get('fee')) }}</span></li>
				@endif
				@php
				Session::put('total',$total_offical);
				@endphp
			</ul>
			<form>
				@csrf
				<div class="form-group">
					<label for="">Chọn thành phố</label>
					<select class="form-control input-sm m-bot15 choose" name="name_tp" id="thanhpho">
						<option value="" class="reset_op">---chọn thành phố---</option>
						@foreach ($city as $value)
						<option value="{{ $value->matp }}">{{ $value->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">Chọn quận huyện</label>
					<select class="form-control input-sm m-bot15 choose" name="name_qh" id="quanhuyen">
						<option value="" class="reset_op">---chọn quận huyện---</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Chọn xã phường</label>
					<select class="form-control input-sm m-bot15 choose" name="name_xp" id="xaphuong">
						<option value="" class="reset_op">---chọn xã phường---</option>
					</select>
				</div>
				<input type="button" value="Tính phí vận chuyển" class="btn btn-primary check_out form-control caculate_fee" style="margin: 0px">
			</form>
			<form action="{{ route('check_coupon') }}" method="POST">
				@csrf
				<input type="text" name="coupon" class="form-control nhapma" placeholder="Nhập mã giảm giá">
				<input type="submit" value="Áp dụng ưu đãi" class="btn btn-primary check_out form-control" style="margin: 0px">
			</form>
		</div>
	</div>
	@endif
</div>
<div class="text-center" style="color: #FE980F">
	<h2 style="margin:22px 0px;">Nhập thông tin vận chuyển</h2>
</div>
<div class="shopper-informations">
	<div class="row">
		<div class="col-sm-12 clearfix">
			<div class="bill-to">
				<div class="form-one" style="width: 100%;">
					<form action="{{ route('save_checkout')}}" method="POST">
						@csrf
						<input type="email" name="email" placeholder="Email" value="">
						@error('email')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<input type="text" name="name" placeholder="Họ và tên">
						@error('name')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<input type="text" name="address" placeholder="Địa chỉ">
						@error('address')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<input type="text" name="phone" placeholder="Số phone">
						@error('phone')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<div class="order-message">
							<textarea name="notes"  placeholder="Ghi chú đơn hàng của bạn" style="height: 200px"></textarea>
						</div>
						@error('notes')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<div class="payment-options" style="margin: 0px">
							@if (count(Session::get('cart'))>0)
							<span>
								<label><input class="type" name="payment_option" value="1" type="radio">
								Trả bằng thẻ ATM</label>
							</span>
							<span>
								<label><input class="type" name="payment_option" value="2" type="radio">
								Nhận tiền mặt</label>
							</span>
							@error('payment_option')
							<p class="text-danger">{{ $message }}</p>
							@enderror
							@endif
		{{-- <span>
			<label><input type="checkbox"> Paypal</label>
		</span> --}}
	</div>
	@if ((Session::get('cart'))&&Session::get('fee'))
	<input type="submit" name="send_order" value="Xác nhận đơn hàng" class="btn btn-primary btn-sm confirm-order">
	@else
	<input type="submit" name="send_order" value="Xác nhận đơn hàng" class="btn btn-primary btn-sm" disabled>
	@endif

</form>
</div>
</div>
</div>				
</div>
</div>
</section> <!--/#cart_items-->
@stop