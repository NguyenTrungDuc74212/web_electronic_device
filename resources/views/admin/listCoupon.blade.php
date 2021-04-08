@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
    </div>
    @if (session('thongbao'))
    <p class="text-success text-center">{{ session('thongbao') }}</p>
    @elseif(session('error'))
        <p class="text-danger text-center">{{ session('error') }}</p>
    @endif
    <form action="{{ route('send_coupon') }}" class="form-group" method="POST"  style="padding: 20px;">
      @csrf
      <label class="">Mã giảm giá:</label>
      <select class="form-control" style="width: 21.7%" name="coupon">
        @foreach ($coupon as $value)
          <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
      </select>
      <p><button class="btn btn-info" style="background: #fe980f;border-color: white;"><i class="fa fa-envelope"></i>
      Gửi mã giảm giá cho khách</button></p>
    </form>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="table_coupon">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng mã</th>
            <th>Tính năng mã</th>
            <th>Số % hoặc số tiền giảm</th>
            <th>Ngày thêm</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($coupon as $value)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->code }}</td>
            <td>{{ $value->soluong }}</td>
            <td>{{ $value->tinhnang==1?'Giảm theo tiền':'Giảm theo phần trăm' }}</td>
            @if ($value->tinhnang==1)
            <td>Giảm {{ currency_format($value->number_sale) }}</td>
            @else
            <td>Giảm {{ $value->number_sale }} %</td>
            @endif
            
            <td><span class="text-ellipsis">{{ $value->created_at }}</span></td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @can('admin')
              <a onclick="return confirm('Bạn có chắc xóa danh mục này không?')" href="{{ route('delete_coupon',$value->id) }}"><i class="fa fa-times text-danger text"></i></a>
              @endcan
            </td>
          </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop