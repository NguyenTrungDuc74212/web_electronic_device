 @extends('admin_layout')
 @section('content')
 <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                 <form action="{{ route('luu_product',$product->id) }}" method="POST" enctype= multipart/form-data>
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="" name="name" value="{{ old('name',$product->name)}}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Giá sản phẩm</label>
                        <input type="text" class="form-control" id="" name="price" value="{{ old('price',$product->price)}}">
                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng sản phẩm</label>
                        <input type="number" class="form-control" min="0" name="quantity" value="{{ old('quantity',$product->quantity) }}">
                        @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="ck" name="description">{{ old('description',$product->description)}}</textarea>
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">nội dung sản phẩm</label>
                        <textarea class="form-control" id="ck_1" name="content">{{ old('content',$product->content)}}</textarea>
                        @error('content')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">hình ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="image">
                        <input type="text" name="img_old" value="{{ $product->image }}" class="form-control">
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <select class="form-control input-sm m-bot15" name="category_id">
                            @foreach ($category as $value)
                            <option {{ $product->category_id==$value->id?'selected':""}} value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach 
                        </select>
                        @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tên thương hiệu</label>
                        <select class="form-control input-sm m-bot15" name="brand_id">
                          @foreach ($brand as $value)
                          <option {{ $product->brand_id == $value->id?"selected":"" }} value="{{ $value->id }}">{{ $value->name }}</option>
                          @endforeach 
                      </select>
                      @error('brand_id')
                      <p class="text-danger">{{ $message }}</p>
                      @enderror
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
                <button type="submit" class="btn btn-info">Lưu sản phẩm</button>
            </form>
        </div>

    </div>
</section>

</div>
</div>
@stop