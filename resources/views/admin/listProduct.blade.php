@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    @if (session('thongbao'))
    <p class="text-success text-center">{{ session('thongbao') }}</p>
    @endif
    {{-- <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> --}}
    <div class="table-responsive" style="padding: 20px;">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr class="text-nowrap">
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Thêm thư viện ảnh</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Ngày thêm</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($product as $value)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $value->name }}</td>
            <td><a href="{{ route('add_gallery',$value->id)}}">Thêm thư viện ảnh</a></td>
            <td>{{ $value->category->name }}</td>
            <td>{{ $value->brand->name }}</td>
            <td>{{ $value->quantity }}</td>
            <td>{{ currency_format($value->price) }}</td>
            <td>
              <img src="public/upload/product/{{ $value->image }}" height="100" width="100">
            </td>
            @if ($value->status==0)
            <td><a href="{{ route('hien_product',$value->id) }}"><span class="text-ellipsis">Ẩn</span></a></td>
            @elseif($value->status==1)
            <td><a href="{{ route('an_product',$value->id) }}"><span class="text-ellipsis">Hiển thị</span></a></td>
            @endif

            <td><span class="text-ellipsis">{{ $value->created_at }}</span></td>
            <td>
              <a href="{{ route('sua_product',$value->id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @can('admin')
              <a onclick="return confirm('Bạn có chắc xóa sản phẩm này không?')" href="{{ route('xoa_product',$value->id) }}"><i class="fa fa-times text-danger text"></i></a>
              @endcan
            </td>
          </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{ $product->perPage() }} of {{ $product->total() }} items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          {{ $product->appends(request()->all())}}
        </div>
      </div>
    </footer> --}}
  </div>
</div>
@stop