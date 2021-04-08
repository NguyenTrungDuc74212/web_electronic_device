 @extends('admin_layout')
 @section('content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                     <form action="{{ route('addproduct_post') }}" method="POST" enctype= multipart/form-data>
                                    @csrf
                                <div class="form-group">
                                    <label for="">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                 <div class="form-group">
                                    <label for="">Giá sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="price" value="{{ old('price') }}">
                                    @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                  <div class="form-group">
                                    <label for="">Số lượng sản phẩm</label>
                                    <input type="number" class="form-control" min="0" name="quantity" value="{{ old('quantity') }}">
                                    @error('quantity')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="ck" name="description">{{ old('description  ') }}</textarea>
                                    @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">nội dung sản phẩm</label>
                                    <textarea class="form-control" id="ck_1" name="content">{{ old('content') }}</textarea>
                                    @error('content')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                 <div class="form-group">
                                    <label for="">hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                    @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                 <div class="form-group">
                                    <label for="">Tên danh mục</label>
                                    <select class="form-control input-sm m-bot15" name="category_id">
                                        @foreach ($category as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@stop