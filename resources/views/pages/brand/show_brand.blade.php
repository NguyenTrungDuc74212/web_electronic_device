 @extends('home_layout')
 @section('content')
 @push('seo-meta')
 <meta name="title" content="{{ $brand_id->meta_title }}"/>
 <meta name="description" content="{!! $brand_id->mota !!}">
 <meta name="keywords" content="{{ $brand_id->meta_keywords }}">
 <link  rel="canonical" href="{{ Request()->url() }}" /> {{-- lấy đường dẫn hiện tại --}}
 <meta name="robots" content="INDEX,FOLLOW">
 <meta name="author" content="">
 <title>{!! $brand_id->meta_title !!}</title>
 @endpush
 <div class="features_items"><!--features_items-->
    <h2 class="title text-center">Thương hiệu {{ $brand_name->name }}</h2>  
    @foreach ($product as $value)
    @if ($value->status==1)
    <div class="col-sm-4">
        <div class="product-image-wrapper" style="height: 400px;">
            <div class="single-products">
                <div class="productinfo text-center">
                   <form action="{{ route('giohang_post')}}" method="POST" style="height: 372px;">
                    @csrf
                    <img src="{{asset('public/upload/product/'.$value->image)}}" alt="" class="img-fluid" height="191px"/>
                    <input type="hidden" value="{{ $value->id }}" class="cart_product_id_{{$value->id}}">
                    <input type="hidden" value="{{ $value->name }}" class="cart_product_name_{{$value->id}}">
                    <input type="hidden" value="{{ $value->image}}" class="cart_product_image_{{$value->id}}">
                    <input type="hidden" value="{{ $value->price}}" class="cart_product_price_{{$value->id}}">
                    <input type="hidden" value="1" class="cart_product_qty_{{$value->id}}">

                    <h2>{{ currency_format($value->price)}}</h2>
                    <p>{{ $value->name }}</p>
                    <input type="hidden" min="1" value="1" name="soluong"/>
                    <input type="hidden" name="product_id" value="{{$value->id}}">
                    <button type="button" class="btn btn-default add-to-cart cart_thanhtoan" data-id={{ $value->id }}><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                </form>
            </div>
            <div class="product-overlay">
                <div class="overlay-content">
                   <form action="{{ route('giohang_post')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $value->id }}" class="cart_product_id_{{$value->id}}">
                    <input type="hidden" value="{{ $value->name }}" class="cart_product_name_{{$value->id}}">
                    <input type="hidden" value="{{ $value->image}}" class="cart_product_image_{{$value->id}}">
                    <input type="hidden" value="{{ $value->price}}" class="cart_product_price_{{$value->id}}">
                    <input type="hidden" value="1" class="cart_product_qty_{{$value->id}}">

                    <h2>{{ currency_format($value->price)}}</h2>
                    <p>{{ $value->name }}</p>
                    <input type="hidden" min="1" value="1" name="soluong"/>
                    <input type="hidden" name="product_id" value="{{$value->id}}">
                    <button type="button" class="btn btn-default add-to-cart cart_thanhtoan" data-id={{ $value->id }}><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                    <a href="{{route('chitietsanpham',$value->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-pencil"></i>Chi tiết sản phẩm</a>
                </form>
            </div>
        </div>
        <img src="{{('public/frontend/images/new.png')}}" class="new" alt="" />
    </div>
    <div class="choose">
        <ul class="nav nav-pills nav-justified">
            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
        </ul>
    </div>
</div>
</div>
@endif
@endforeach
<footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{ $product->perPage() }} of {{ $product->total() }} items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          {{ $product->appends(request()->all())}}
        </div>
      </div>
    </footer>  
</div><!--features_items-->


{{-- category_tab --}}

@stop    