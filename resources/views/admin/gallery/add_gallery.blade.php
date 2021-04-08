 @extends('admin_layout')
 @section('content')
 <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thư viện ảnh cho {{ $product_name }} 
            </header>
            <form action="{{ route('insert_gallery',$product_id) }}" method="POST" enctype="multipart/form-data" style="margin: 20px">
                @csrf
                <div class="row">
                    <div class="col-lg-3" align="right">

                    </div>
                    <div class="col-lg-6">
                       <input type="file" name="image[]" class="form-control" multiple id="file">
                       <span id="error_image"></span>
                    </div>
                    <div class="col-lg-3">
                         <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn btn-success">
                    </div>
                </div>
            </form>
            <div class="panel-body">
               <input type="hidden" name="product_id" value="{{ $product_id }}" class="product_id">
               <form>
                @csrf
                <div id="load_image">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Tên hình ảnh</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                  </tbody>
              </table>
          </div>
      </form>
  </div>
</section>
</div>
</div>
@stop