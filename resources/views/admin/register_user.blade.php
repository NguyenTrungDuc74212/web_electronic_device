@extends('admin_layout')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        Đăng ký user
      </header>
      <div class="panel-body">
        <div class="position-center">
          <form role="form" action="{{ route('save-user') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="">email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="email" value="{{ old('email') }}">
              @error('email')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="">name</label>
              <input type="text" name="name" class="form-control" placeholder="nhập tên" value="{{ old('name') }}">
            </div>
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="form-group">
              <label for="">phone</label>
              <input type="text" name="phone" class="form-control" placeholder="nhập tên" value="{{ old('phone') }}">
            </div>
            @error('phone')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="form-group">
              <label for="">password</label>
              <input type="password" class="form-control" name="password" placeholder="nhập password" value="{{ old('password') }}">
              @error('password')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
             <div class="form-group">
              <label for="">re-password</label>
              <input type="password" class="form-control" name="re-password" placeholder="nhập lại password">
            </div>
            <button type="submit" class="btn btn-info">Đăng ký user</button>
          </form>
        </div>

      </div>
    </section>

  </div>
</div>
@stop