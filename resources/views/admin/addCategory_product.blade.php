 @extends('admin_layout')
 @section('content')
 <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('themdanhmucsp_post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên danh mục</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="name" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả danh mục</label>
                            <textarea class="form-control" id="ck" name="mota">{{ old('mota') }}</textarea>
                            @error('mota')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Meta keywords</label>
                            <textarea class="form-control" id="" name="meta_keywords"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Meta title</label>
                            <textarea class="form-control" id="" name="meta_title"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Meta desc</label>
                            <textarea class="form-control" id="" name="meta_desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control input-sm m-bot15" name="status">
                                <option value="0" {{ old('status')==0?'selected':''}}>Ẩn</option>
                                <option value="1" {{ old('status')==1?'selected':''}}>Hiển thị</option>
                            </select>
                            @error('status')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@stop