 @extends('home_layout')
 @section('content')
 @push('category_active')
 <ul class="nav navbar-nav collapse navbar-collapse">
    <li><a href="{{route('trangchu')}}" class="active">Trang chủ</a></li>
    <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>  
        <ul role="menu" class="sub-menu">
            @foreach ($category as $value)
            <li><a href="{{ route('category_home',$value->id) }}">{{ $value->name }}</a></li>
            @endforeach
        </ul>
    </li> 
    <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
    </li> 
    <li><a href="{{ route('giohang') }}">Giỏ hàng</a></li>
    <li><a href="contact-us.html">Liên hệ</a></li>
</ul>
@endpush
@push('seo-meta')
<meta name="description" content="Mua Ngay. Cam Kết 100% Chính Hãng. Bảo Hành 12 Tháng. Giao Hàng Toàn Quốc. Trả Góp LS 0%! Phân Phối Điện Thoại, Tablet, Laptop Chính Hãng. Nhiều Khuyến Mại Ưu Đãi Lớn.">
<meta name="keywords" content="Đồ điện tử, tivi, máy tính, điện thoại chính hãng">
<link  rel="canonical" href="{{ Request()->url() }}" /> {{-- lấy đường dẫn hiện tại --}}
<meta name="title" content="Home | E-Shopper"/>
{{-- thẻ share --}}
<meta property="og:image" content="" />
<meta property="og:site_name" content="http://myweb.com.local/Shopbanhanglaravel/" />
<meta property="og:description" content="Mua Ngay. Cam Kết 100% Chính Hãng. Bảo Hành 12 Tháng. Giao Hàng Toàn Quốc. Trả Góp LS 0%! Phân Phối Điện Thoại, Tablet, Laptop Chính Hãng. Nhiều Khuyến Mại Ưu Đãi Lớn." />
<meta property="og:title" content="Home | E-Shopper" />
<meta property="og:url" content="{{ Request()->url() }}" />
<meta property="og:type" content="website" />
{{-- end share --}}

<meta name="robots" content="INDEX,FOLLOW">
<meta name="author" content="">
<title>Home | E-Shopper</title>
@endpush
<div class="fb-share-button" data-href="http://myweb.com.local/Shopbanhanglaravel/trangchu" data-layout="box_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ Request()->url() }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="fb-like" data-href="{{ Request()->url() }}" data-width="200px"  data-layout="button" data-action="like" data-size="large" data-share="false"></div>  
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    <div class="row">
    @foreach ($product as $value)
    <div class="col-sm-4">
        <div class="product-image-wrapper" style="height: 400px;">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form style="height: 372px">
                        @csrf
                        <img src="{{asset('public/upload/product/'.$value->image)}}" alt="" class="img-fluid" height="191px" />
                        <input type="hidden" value="{{ $value->id }}" class="cart_product_id_{{$value->id}}">
                            <input type="hidden" value="{{ $value->name }}" class="cart_product_name_{{$value->id}}">
                            <input type="hidden" value="{{ $value->image}}" class="cart_product_image_{{$value->id}}">
                            <input type="hidden" value="{{ $value->price}}" class="cart_product_price_{{$value->id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$value->id}}">
                            <input type="hidden" value="{{$value->quantity}}" class="cart_product_storage_{{$value->id}}">
                            <h2>{{ currency_format($value->price)}}</h2>
                            <p>{{ $value->name }}</p>
                            <input type="hidden" min="1" value="1" name="soluong"/>
                            <input type="hidden" name="product_id" value="{{$value->id}}">
                            <button type="button" class="btn btn-default add-to-cart cart_thanhtoan" data-id={{ $value->id }}><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                    </form>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <form>
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
                        </form>
                        <a href="{{route('chitietsanpham',$value->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-pencil"></i>Chi tiết sản phẩm</a>
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
    @endforeach 
    </div> 
</div><!--features_items-->
<div class="fb-comments" data-href="http://myweb.com.local/Shopbanhanglaravel/" data-width="" data-numposts="20"></div>


{{-- category_tab --}}

@stop    