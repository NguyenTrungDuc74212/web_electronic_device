@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu sản phẩm
    </div>
    @if (session('thongbao'))
    <p class="text-success text-center">{{ session('thongbao') }}</p>
    @endif
    <div class="row w3-res-tb">
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
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên thương hiệu</th>
            @can('admin')
            <th>Hiển thị</th>
            @endcan
            <th>Ngày thêm</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($brand as $value)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $value->name }}</td>
            @can('admin')
            @if ($value->status==0)
            <td><a href="{{ route('hien_brand',$value->id) }}"><span class="text-ellipsis">Ẩn</span></a></td>
            @elseif($value->status==1)
            <td><a href="{{ route('an_brand',$value->id) }}"><span class="text-ellipsis">Hiển thị</span></a></td>
            @endif
            @endcan
            <td><span class="text-ellipsis">{{ $value->created_at }}</span></td>
            <td>
              <a href="{{ route('sua_brand',$value->id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @can('admin')
              <a onclick="return confirm('Bạn có chắc xóa danh mục này không?')" href="{{ route('xoa_brand',$value->id) }}"><i class="fa fa-times text-danger text"></i></a>
              @endcan
            </td>
          </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{ $brand->perPage() }} of {{ $brand->total() }} items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          {{ $brand->appends(request()->all())}}
        </div>
      </div>
    </footer>
  </div>
</div>
@stop