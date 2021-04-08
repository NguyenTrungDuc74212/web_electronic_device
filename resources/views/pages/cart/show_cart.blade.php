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
					<td class="description">Mô tả</td>
					<td class="price">Giá</td>
					<td class="quantity">Số lượng</td>
					<td class="total">Tổng tiền</td>
					<td></td>
				</tr>
			</thead>
			@php
			{{$content = Cart::content();}}
			@endphp
			<tbody>
				@if (session('thongbao'))
				<div class="alert-success text-center" style="padding: 15px">
					<p>{{ session('thongbao') }}</p>
				</div>
				@endif
				@foreach ($content as $value)
				<td class="cart_product">
					<a href="{{route('chitietsanpham',$value->id) }}"><img src="{{ asset('public/upload/product/'.$value->options->image) }}" alt="" width="50" ></a>
				</td>
				<td class="cart_description">
					<h4><a href="">{{ $value->name }}</a></h4>
					<p>Web ID: {{ $value->id }}</p>
				</td>
				<td class="cart_price">
					<p>{{ currency_format($value->price) }}</p>
				</td>
				<td class="cart_quantity">
					<div class="cart_quantity_button">
						<form action="{{ route('update_soluong') }}" method="POST">
							@csrf
							<input class="cart_quantity_input" type="text" name="quantity" value="{{ $value->qty }}" autocomplete="off" size="2">
							<input type="hidden" name="rowId_cart" value="{{ $value->rowId }}">
							<input type="submit" name="update" value="Cập nhật" class="btn btn-default btn-sm">
						</form>
					</div>
				</td>
				<td class="cart_total">
					<p class="cart_total_price">{{currency_format($value->subtotal)}}</p>
				</td>
				<td class="cart_delete">
					<a class="cart_quantity_delete" href="{{ route('xoa_hang',$value->rowId) }}"><i class="fa fa-times"></i></a>
				</td>
			</tr>
			@endforeach
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
		@if (Cart::count()>0)
		<div class="col-sm-12">
			<div class="total_area">
				<ul>
					<li>Tổng <span>{{ Cart::subtotal().'VNĐ' }}</span></li>
					<li>Thuế <span>{{ Cart::tax().'VNĐ' }}</span></li>
					<li>Phí vận chuyển <span>Free</span></li>
					<li>Thành tiền <span>{{ Cart::total().'VNĐ' }}</span></li>
				</ul>
				@if (session('id_customer'))
				<a class="btn btn-default check_out form-control" href="{{ route('view_checkout')}}">Thanh toán</a>
				@else
				<a class="btn btn-default check_out form-control" href="{{ route('login_checkout')}}">Thanh toán</a>
				@endif
			</div>
		</div>
		@endif
	</div>
</section><!--/#do_action-->
@stop