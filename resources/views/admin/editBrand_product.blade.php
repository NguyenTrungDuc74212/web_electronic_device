 @extends('admin_layout')
 @section('content')
 <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa thương hiệu sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('luu_brand',$brand->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Tên thương hiệu</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="name" value="{{ old('name',$brand->name) }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Meta keywords</label>
                            <textarea class="form-control" id="" name="meta_keywords">{!!$brand->meta_keywords  !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Meta title</label>
                            <textarea class="form-control" id="" name="meta_title">{!!$brand->meta_title !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả danh mục</label>
                            <textarea class="form-control" id="ck" name="mota">{!! old('mota',$brand->mota) !!}</textarea>
                            @error('mota')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control input-sm m-bot15" name="status">
                                <option value="0" {{ old('status',$brand->status)==0?'selected':''}}>Ẩn</option>
                                <option value="1" {{ old('status',$brand->status)==1?'selected':''}}>Hiển thị</option>
                            </select>
                            @error('status')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info">Lưu thương hiệu</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@stop