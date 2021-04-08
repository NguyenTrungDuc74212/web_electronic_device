 @extends('admin_layout')
 @section('content')
 <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mã giảm giá
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('save_coupon') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên mã giảm giá</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên mã giảm giá" name="name" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mã giảm giá</label>
                            <input type="text" name="code" class="form-control" placeholder="Nhập mã" value="{{ old('code') }}">
                             @error('code')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Số lượng mã</label>
                            <input type="number" name="soluong" class="form-control" min="1" value="{{ old('soluong') }}">
                             @error('soluong')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label>Tính năng mã</label>
                            <select class="form-control" name="tinhnang">
                                <option value="">---Chọn tính năng---</option>
                                <option value="1" {{ old('tinhnang')==1?'selected':'' }}>Giảm theo tiền</option>
                                <option value="2" {{ old('tinhnang')==2?'selected':'' }}>Giảm theo phần trăm</option>
                            </select>
                             @error('tinhnang')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nhập số % hoặc số tiền giảm</label>
                            <input type="text" name="number_sale" class="form-control" placeholder="Nhập" value="{{ old('number_sale') }}">
                            @error('number_sale')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @can('admin')
                        <button type="submit" class="btn btn-info">Thêm mã giảm giá</button>
                        @endcan
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@stop