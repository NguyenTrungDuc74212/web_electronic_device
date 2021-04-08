@extends('admin_layout')
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
	Liệt kê users
</div>
@if (session('thongbao'))
<p class="text-success text-center">{{ session('thongbao') }}</p>
@elseif(session('error'))
<p class="text-danger text-center">{{ session('error') }}</p>
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
			<tr class="text-nowrap">
				<th style="width:20px;">
					<label class="i-checks m-b-none">
						<input type="checkbox"><i></i>
					</label>
				</th>
				<th>Tên user</th>
				<th>email</th>
				<th>phone</th>
				<th>admin</th>
				<th>auhthor</th>
				<th>user</th>
				<th>Thời gian đăng nhập gần nhất</th>
				<th>Thao tác</th>
				<th style="width:30px;"></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($admin as $value)
			<form action="{{ route('assign_role') }}" method="POST">
				@csrf
				<tr>
					<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
					<input type="hidden" name="email" value="{{ $value->email }}">
					<td>{{ $value->name }}</td>
					<td>{{ $value->email }}</td>
					<td>{{ $value->phone }}</td>
					<td><input type="checkbox" name="admin" {{ $value->hasRole('admin')?'checked':'' }}></td>
					<td><input type="checkbox" name="author" {{ $value->hasRole('author')?'checked':'' }}></td>
					<td><input type="checkbox" name="user" {{ $value->hasRole('user')?'checked':'' }}></td>
					@if ($value->date_access!=null)
					<td>{{ $value->date_access}}</td>
					@endif
					<td class="text-nowrap">
						<button type="submit" class="btn btn-success">Assign roles</button>
						<button type="submit" name="xoa" value="xoa_bai" class="btn btn-danger">Delete</button>
					</td>
				</tr> 
			</form>
			@endforeach

		</tbody>
	</table>
</div>
<footer class="panel-footer">
	<div class="row">

		<div class="col-sm-5 text-center">
			<small class="text-muted inline m-t-sm m-b-sm">showing {{ $admin->perPage() }} of {{ $admin->total() }} items</small>
		</div>
		<div class="col-sm-7 text-right text-center-xs">                
			{{ $admin->appends(request()->all())}}
		</div>
	</div>
</footer>
</div>
</div>
@stop