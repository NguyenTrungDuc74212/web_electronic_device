@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    @if (session('thongbao'))
    <p class="text-success text-center">{{ session('thongbao') }}</p>
    @elseif(session('error'))
    <p class="text-danger text-center">{{ session('error') }}</p>
    @endif
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <form action="" method="GET">
          <select class="input-sm form-control w-sm inline v-middle" name="filter">
            <option value="">---Bộ lọc---</option>
            <option value="0"{{ Request()->input('filter')==0?'selected':'' }}>Đơn hàng mới</option>
            <option value="1">Đơn hàng trên 2 sản phẩm</option>
            <option value="2">Đơn hàng chưa xử lý</option>
            <option value="3">Đơn hàng đã xử lý</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>
        </form>               
      </div>
      <div class="col-lg-4"></div>
      <div class="col-sm-3">
        <div class="input-group">
          <form action="" method="GET">
            <input type="text" class="input-sm form-control" placeholder="Search" name="search_order" style="width: 62%" value="{{ Request()->input('search_order') }}">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
            </span>
          </form>
        </div>
      </div>
    </div>
    <div class="row w3-res-tb">
      <form action="" method="GET" autocomplete="off">
        <div class="col-lg-4">
          <p>Từ ngày: <input type="text" id="datepicker" name="date_1" class="form-control" value="{{ Request()->input('date_1') }}"></p>
        </div>
        <div class="col-lg-4">
          <p>Đến ngày: <input type="text" id="datepicker2" name="date_2" class="form-control" value="{{ Request()->input('date_2') }}"></p>
        </div>
        <div class="col-lg-4">
          <input type="submit" id="btn-order-filter" value="lọc kệt quả" class="btn btn-primary btn-sm" style="margin: 24px -12px;">
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
            </th>
            <th>Tên người đặt</th>
            <th>Tổng giá tiền</th>
            <th>Tình trạng đơn hàng</th>
            <th>Ngày đặt</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <form action="" method="GET">
            @foreach ($order as $value)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]" value={{ $value->id }}><i></i></label></td>

              <td>{{ $value->customer->name }}</td>
              <td>{{ currency_format($value->total) }}</td>
              @if ($value->status==0)
              <td>Đã hủy - tạm giữ</td>
              @elseif($value->status==1)
              <td>Chưa xử lý</td>
              @else
              <td>Đã xử lý xong</td>
              @endif
              <td><span class="text-ellipsis">{{ $value->created_at }}</span></td>
              <td>
                <a href="{{ route('view_order',$value->id)}}" class="active" ui-toggle-class="" id="order_id_{{ $value->id }}" data-id="{{ $value->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                @can('admin')
                <a onclick="return confirm('Bạn có chắc xóa đơn hàng này không?')" href="{{ route('xoa_order',$value->id) }}"><i class="fa fa-times text-danger text"></i></a>
                @endcan
              </td>
            </tr> 
            @endforeach
          </tbody>
          <td colspan="6">
            <button type="submit" class="btn btn-danger xoanhieu" name="delete_column" value="1" style="margin: 2px 2px;">Xóa theo hàng</button>
          </td>
        </table>
      </div>

    </form>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{ $order->perPage() }} of {{ $order->total() }} items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          {{ $order->appends(request()->all())}}
        </div>
      </div>
    </footer>
  </div>
</div>
@stop