@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê bình luận
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
      <table class="table table-striped b-t b-light" id="table_comment">
        <thead class="text-nowrap">
          <tr>
            <th>Duyệt</th>
            <th>Tên người gửi</th>
            <th>Bình luận</th>
            <th>Ngày gửi</th>
            <th>Sản phẩm</th>
            <th>Quản lý</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($comments as $value)
          <tr>
            <td>
              @if ($value->status==0) {{-- status==0: là chưa duyệt --}}
              <input type="button" data-cm_status="{{ $value->status }}" data-cm_id="{{ $value->id }}" id="{{ $value->product_id }}" class="btn btn-xs btn-success comment_pass_btn" value="duyệt">
              @else
              <input type="button" data-cm_status="{{ $value->status }}" data-cm_id="{{ $value->id }}" id="{{ $value->product_id }}" class="btn btn-xs btn-danger comment_pass_btn" value="bỏ duyệt">
              @endif
            </td>
            <td>{{ $value->name }}</td>
            @if ($value->status==1)
            <td>{{ $value->comment }}
              <ul>
                @foreach ($comment_parent as $key =>$value2)
                @if ($value2->comment_parent == $value->id)
                   @foreach ($admin as $value3)
                        @if ($value3->id ==$value2->admin_id)
                          <b style="color: #FE980F">{{ $value3->name }}:</b>
                        @endif
                   @endforeach
                <li style="list-style: decimal-leading-zero;
                color: #fe980f;
                font-weight: 600;margin: 0px 55px;" contenteditable class="comment_value" data-id="{{ $value2->id }}">{{ $value2->comment }}</li>
                @endif
                @endforeach
              </ul>
              <br><button class="btn btn-xs btn-light reply_comment" data-cm_id="{{ $value->id }}" style="color: blue" id="{{ $value->product_id }}" data-admin_id="{{ Auth::id() }}">Trả lời</button>
              <textarea rows="3" class="form-control"></textarea>
            </td>
            @else
            <td>{{ $value->comment }}</td> 
            @endif
            

            <td>{{ ($value->created_at)->format('d/m/Y') }}</td>
            <td><a href="{{ route('chitietsanpham',$value->product->slug) }}" target="_blank">{{ $value->product->name }}</a></td>
            <td class="text-center">
              <a onclick="return confirm('Bạn có chắc xóa bình luận này không?')" href="{{ route('delete_comment',$value->id) }}"><i class="fa fa-times text-danger text delete_comment"></i></a>
            </td>
          </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{ $comments->perPage() }} of {{ $comments->total() }} items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          {{ $comments->appends(request()->all())}}
        </div>
      </div>
    </footer> --}}
  </div>
</div>
@stop