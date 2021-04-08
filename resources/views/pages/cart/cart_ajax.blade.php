@extends('home_layout')
@section('content')	
@push('seo-meta')
<meta http-equiv="audience" content="General">
<meta name="resource-type" content="Document">
<meta name="distribution" content="Global">
<title>Home | E-Shopper</title>
@endpush
<section id="cart_items">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li><a href="{{ route('trangchu') }}">Home</a></li>
			<li class="active">Giỏ hàng của bạn</li>
		</ol>
	</div>
	<div class="table-responsive cart_info">
		<table class="table table-condensed">
			<thead>
				<tr class="cart_menu">
					<td class="image">Hình ảnh</td>
					<td class="description">Tên sản phẩm</td>
					<td class="price">Giá sản phẩm</td>
					<td class="quantity">Số lượng</td>
					<td class="total">Tổng tiền</td>
					<td></td>
				</tr>
			</thead>
			@php
			$total = 0;
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
				@if (Session::get('cart'))


				@foreach (Session::get('cart') as $value)
				@php
				$subtotal = $value['product_price']*$value['product_qty'];
				$total = $total + $subtotal;
				@endphp
				<tr class="wrap-cart">
					<td class="cart_product">
						<a href="{{route('chitietsanpham',$value['product_id'])}}"><img src="{{ asset('public/upload/product/'.$value['product_image']) }}" alt="" width="50" ></a>
					</td>
					<td class="cart_description">
						<h4><a href="{{route('chitietsanpham',$value['product_id'])}}"></a></h4>
						<p>{{ $value['product_name'] }} </p>
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
						<p class="cart_total_price">
							{{ currency_format($subtotal)}}
						</p>
					</td>
					<td class="cart_delete">
						<a class="cart_quantity_delete session_id" data-href="{{ $value['session_id'] }}"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
</section> <!--/#cart_items-->
<section id="do_action">
{{-- 	<div class="heading">
		<h3>What would you like to do next?</h3>
		<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
	</div> --}}
	<div class="row">
{{-- 		<div class="col-sm-6">
			<div class="chose_area">
				<ul class="user_option">
					<li>
						<input type="checkbox">
						<label>Use Coupon Code</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Use Gift Voucher</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Estimate Shipping & Taxes</label>
					</li>
				</ul>
				<ul class="user_info">
					<li class="single_field">
						<label>Country:</label>
						<select>
							<option>United States</option>
							<option>Bangladesh</option>
							<option>UK</option>
							<option>India</option>
							<option>Pakistan</option>
							<option>Ucrane</option>
							<option>Canada</option>
							<option>Dubai</option>
						</select>

					</li>
					<li class="single_field">
						<label>Region / State:</label>
						<select>
							<option>Select</option>
							<option>Dhaka</option>
							<option>London</option>
							<option>Dillih</option>
							<option>Lahore</option>
							<option>Alaska</option>
							<option>Canada</option>
							<option>Dubai</option>
						</select>

					</li>
					<li class="single_field zip-field">
						<label>Zip Code:</label>
						<input type="text">
					</li>
				</ul>
				<a class="btn btn-default update" href="">Get Quotes</a>
				<a class="btn btn-default check_out" href="">Continue</a>
			</div>
		</div> --}}

		@if ((Session::get('cart')))
		<div class="col-sm-12">
			<div class="total_area">
				<ul>
					<li>Tổng tiền: <span>{{ currency_format($total) }}</span></li>
					@if (Session::get('coupon_ss'))
					@foreach (Session::get('coupon_ss') as $value)
					<li>Mã giảm: <span>{{ $value['coupon_value']}} {{ $value['coupon_tinhnang']==2?'%':"VNĐ" }}</span></li>
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
					<li>Phí vận chuyển:<span>Free</span></li>
					@if (Session::get('coupon_ss'))
					<li>Tiền thanh toán:<span>{{ currency_format($total_offical = $total-$coupon_total) }}</span></li>
					@else
					<li>Tiền thanh toán:<span>{{ currency_format($total_offical = $total) }}</span></li>
					@endif
					@php
					Session::put('total',$total_offical);
					@endphp
				</ul>
				@if (session('id_customer'))
				<form action="{{ route('check_coupon') }}" method="POST">
					@csrf
					<input type="text" name="coupon" class="form-control nhapma" placeholder="Nhập mã giảm giá" style="margin:0px;width:95.4%; border-radius:0px">
					<input type="submit" value="Áp dụng ưu đãi" class="btn btn-primary check_out" style="margin-left: 39px">
				</form>
				<a class="btn btn-primary check_out form-control" href="{{ route('view_checkout')}}">Thanh toán</a>
				@else
				<a class="btn btn-primary check_out form-control" href="{{ route('login_checkout')}}">Thanh toán</a>
				@endif
			</div>
		</div>
		@endif
	</div>
</section><!--/#do_action-->
@stop