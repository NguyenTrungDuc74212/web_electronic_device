@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua
    </div>
    @if (session('thongbao'))
    <p class="text-success text-center">{{ session('thongbao') }}</p>
    @endif

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người mua</th>
            <th>Số điện thoại</th>         
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $order->customer->name }}</td>
            <td>{{ $order->customer->phone }}</td>
          </tr> 
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    @if (session('thongbao'))
    <p class="text-success text-center">{{ session('thongbao') }}</p>
    @endif

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận hàng</th>
            <th>Địa chỉ</th>         
            <th>Số điện thoại</th>         
            <th>Email</th>         
            <th>Ghi chú</th>         
            <th>Hình thức thành toán</th>         
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $order->shipping->name }}</td>
            <td>{{ $order->shipping->address }}</td>
            <td>{{ $order->shipping->phone }}</td>
            <td>{{ $order->shipping->email }}</td>
            <td>{{ $order->shipping->notes }}</td>
            <td>{{ $order->shipping->method==2?'thanh toán tiền mặt':'thành toán bằng ATM' }}</td>
          </tr> 
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="table-agile-info" id="wrap_order_detail">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>
    @if (session('thongbao'))
    <p class="text-success text-center">{{ session('thongbao') }}</p>
    @endif
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr class="text-nowrap">
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Mã giảm Giá</th>
            <th>Số lượng</th>
            <th>Số lượng kho còn</th>
            <th>Giá</th>
          </tr>
        </thead>
        <tbody>
          @php
          $product_fee = 0;
          $all_fee=0;
          @endphp
          @foreach ($order_detail as $value2)
          <tr class="color_quantity_{{ $value2->product_id }}">
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $value2->product->name }}</td>
            <td>{{ $value2->coupon==true?$value2->coupon:"không có mã giảm giá" }}</td>
            <td class="text-nowrap">
              <input type="number" min="1" value="{{  $value2->soluong }}" class="text-center order_quantity_{{ $value2->product_id }} order_quantity" name="quantity" {{ $order->status!=1?'disabled':''}}>

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{ $value2->product_id }}">

              <input type="hidden" name="order_id" class="order_id" value="{{ $value2->order_id }}">

              <input type="hidden" class="product_price" value="{{$value2->product->price }}">

              <input type="hidden" class="product_storage_{{ $value2->product_id }}" value="{{$value2->product->quantity }}">
              @if ($order->status==1)
              <button class="btn btn-default update_quantity_order" name="update_quantity_order" data-product_id="{{ $value2->product->id }}">Cập nhật</button>
              @endif
              

            </td>
            <td class="text-center">{{ $value2->product->quantity }}</td>
            <td>{{ currency_format(($value2->product->price)*$value2->soluong)}}</td>
          </tr> 
          @php
          $feeship = $value2->feeship;
          $product_fee+=($value2->product->price)*$value2->soluong;
          @endphp
          @endforeach 
        </tbody>
        <tr>
          <td colspan="6">
            <form>
              @csrf
              <select class="form-control order_details" id="{{ $order->id }}">
                @if ($order->status==2)
                <option value="1" class="no" {{ $order->status==1?'selected':'hidden' }}>---Chưa xử lý đơn hàng---</option>
                <option value="2" class="done" {{ $order->status==2?'selected':'' }}>Đã xử lý-Đã giao hàng</option>
                <option value="0" class="cancel" {{ $order->status==0?'selected':'hidden' }}>Hủy đơn hàng-Tạm giữ</option>
                @elseif($order->status==1)
                <option value="1" class="no" {{ $order->status==1?'selected':'' }}>---Chưa xử lý đơn hàng---</option>
                <option value="2" class="done" {{ $order->status==2?'selected':'' }}>Đã xử lý-Đã giao hàng</option>
                <option value="0" class="cancel" {{ $order->status==0?'selected':'' }}>Hủy đơn hàng-Tạm giữ</option>
                @elseif($order->status==0)
                <option value="1" class="no" {{ $order->status==1?'selected':'hidden' }}>---Chưa xử lý đơn hàng---</option>
                <option value="2" class="done" {{ $order->status==2?'selected':'hidden' }}>Đã xử lý-Đã giao hàng</option>
                <option value="0" class="cancel" {{ $order->status==0?'selected':'' }}>Hủy đơn hàng-Tạm giữ</option>
                @endif
                
              </select>
            </form>
          </td>
        </tr>
      </table>
      <br>
      <div class="wrap_out text-right">
        <a href="{{ route('print_order',$order->id) }}" class="xuatdon" style="margin: 0px 21.5px">In đơn hàng(xuất ra file PDF)</a>
      </div>
      @if ($coupon_value)
      @if ($coupon_value->tinhnang==1)
      <p style="text-align:right;padding: 20px">Tổng giảm: {{currency_format($feeship-$coupon_value->number_sale) }}(Phí ship-Phiếu giảm giá)</p>
      @php
      $all_fee = $feeship-$coupon_value->number_sale;
      @endphp
      @elseif ($coupon_value->tinhnang==2)
      <p style="text-align:right;padding: 20px">Tổng giảm: {{currency_format($feeship-($coupon_value->number_sale)*($order->total)/100) }}(Phí ship-Phiếu giảm giá)</p>
      @php
      $all_fee=$feeship-($coupon_value->number_sale)*($order->total)/100;
      @endphp
      @endif
      @else
      <p style="text-align:right;padding: 20px">Phí ship: +{{currency_format($feeship)}}</p>
      @endif
      @if ($all_fee)
      <input type="hidden" name="all_fee" class="all_fee" value="{{ $all_fee }}">
      <p style="text-align:right;padding: 20px">Tổng tiền thu về: {{currency_format($product_fee+$all_fee)}}</p>
      @else
      <input type="hidden" name="all_fee" class="all_fee" value="{{ $feeship }}">
      <p style="text-align:right;padding: 20px">Tổng tiền thu về: {{currency_format($product_fee+$feeship)}}</p>
      @endif
    </div>
  </div>
</div>
@stop