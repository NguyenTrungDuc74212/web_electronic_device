<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('seo-meta')
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
<![endif]-->       
<link rel="icon" type="image/png" href="{{asset('public/frontend/images/logo.ico')}}">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/prettify.css')}}"> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/lightslider.css')}}"> --}}
</head><!--/head-->
<style type="text/css">
    button#fpt_ai_livechat_button {
        background: linear-gradient( 
            90deg
            , #ff5722 0%, #ff9800 99.79%) !important;
    }
}
</style>
<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav" style="display: flex;">
                                <li><a href="#"><img  alt="insta" src="{{ asset('public/frontend/images/insta.png') }}" style="width: 36px;"></a></li>
                                <li><a href="#"><img  alt="insta" src="{{ asset('public/frontend/images/gg.png') }}" style="width: 36px;margin: 0px 10px"></i></a></li>
                                <li><a href="#"><img  alt="insta" src="{{ asset('public/frontend/images/fb1.png') }}" style="width: 36px"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ route('trangchu') }}"><img src="{{asset('public/frontend/images/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                @if (session('id_customer'))
                                <li><a data-href=""><i class="fa fa-user"></i>Xin ch??o {{ session('name_customer') }}</a></li>
                                @endif
                                <li><a href="#"><i class="fa fa-star"></i>Y??u th??ch</a></li>
                                <li><a href="{{ route('giohang_ajax') }}"><i class="fa fa-shopping-cart"></i>Gi??? h??ng</a>
                                    @if (Session::get('cart'))
                                    <b class="ahihi">{{ count(Session::get('cart'))}}</b>
                                    @else
                                    @php
                                    Request()->session()->forget('coupon_ss');
                                    @endphp
                                    @endif
                                </li>
                                @if (session('id_customer'))
                                <li><a href="{{ route('view_checkout') }}"><i class="fa fa-crosshairs"></i>Thanh to??n</a></li>
                                <li><a href="{{ route('logout_checkout')}}"><i class="fa fa-lock"></i>????ng xu???t</a></li>
                                @else
                                <li><a href="{{ route('login_checkout') }}"><i class="fa fa-crosshairs"></i>Thanh to??n</a></li>
                                <li><a href="{{ route('login_checkout')}}"><i class="fa fa-lock"></i>????ng nh???p</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{route('trangchu')}}" class="{{ session('trangthai')==1?'active':''}}">Trang ch???</a></li>
                                <li class="dropdown"><a href="#" class="{{ session('trangthai')==3?'active':''}}">S???n ph???m<i class="fa fa-angle-down"></i></a>  
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($category as $value)
                                        <li><a href="{{ route('category_home',$value->slug) }}">{{ $value->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin t???c<i class="fa fa-angle-down"></i></a>
                                </li> 
                                <li><a href="{{ route('giohang_ajax') }}" class="{{ session('trangthai')==2?'active':''}}">Gi??? h??ng</a></li>
                                <li><a href="contact-us.html">Li??n h???</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{ route('timkiem') }}" autocomplete="off">
                            @csrf
                            <div class="search_box pull-right">
                                <input type="text" name="key" id="keywords" placeholder="T??m ki???m" value="{{ Request()->input('key') }}" style="width: 220px" />
                                <input type="submit" class="btn btn-primary btn-search" value="T??m Ki???m" />
                                <div id="search" style="position: absolute;right: 0;"></div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Macbook</h2>
                                    <p>Macbook Air ???????c nhi???u ng?????i y??u th??ch v?? thi???t k??? ?????p, nh??? g???n v?? trang nh??, ???????c coi l?? chi???c laptop ?????p v?? thanh l???ch nh???t th??? gi???i. ????y l?? d??ng s???n ph???m ch??? l???c, ?????y m???nh m??? m?? Apple d??nh t???i cho ng?????i d??ng to??n c???u. MacBook Air 2015 l?? m???t thi???t b??? s??? h???u con chip ????? h???a Intel HD Graphics 6000, pin si??u kh???e so v???i th??? h??? ti???n nhi???m v?? h??ng lo???t nh???ng t??nh n??ng v?? c??ng h???p d???n.</p>
                                    <button type="button" class="btn btn-default get">Mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('public/frontend/images/slide.jpg')}}" class="girl img-responsive" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>TV LG</h2>
                                    <p>Mua Tivi LG, Smart tivi LG Full HD, 4K, tivi OLED gi?? r???, c?? tr??? g??p 0%, b???o h??nh 2 n??m, l???i 1 ?????i 1, khuy???n m??i h???p d???n, giao h??ng mi???n ph?? to??n qu???c. </p>
                                    <button type="button" class="btn btn-default get">Mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('public/frontend/images/slide2.jpg')}}" class="girl img-responsive" alt="" />
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>TV samsung</h2>
                                    <p>Mua tivi Samsung gi?? r??? qu?? ngon, tr??? g??p 0%, mi???n ph?? c??ng l???p ?????t, l???i 1 ?????i 1, giao h??ng trong 4h, c?? th??? t???i nh??. Xem kh??ng mua kh??ng sao. </p>
                                    <button type="button" class="btn btn-default get">Mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('public/frontend/images/slide3.jpg')}}" class="girl img-responsive" alt="" />
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh m???c s???n ph???m</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <div class="panel panel-default">
                                @foreach ($category as $value)
                                <div class="panel-heading">      
                                    <h4 class="panel-title"><a href="{{ route('category_home',$value->slug) }}">{{ $value->name }}</a></h4>
                                </div>
                                @endforeach
                            </div>

                        </div><!--/category-products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Th????ng hi???u s???n ph???m</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($brand as $value)
                                    <li><a href="{{ route('brand_home',$value->slug) }}"> <span class="pull-right">(50)</span>{{ $value->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>B??? l???c</h2>
                            <div class="brands-name">
                                <form action="" >
                                    <ul class="nav nav-pills nav-stacked">
                                        <div class="wrap-filler">
                                            <input type="radio" name="price" value="10000000" class="btn_radio" {{ Request()->key2=='10000000'?'checked':'' }}>
                                            <span>d?????i 10.000.000 VN??</span>
                                        </div>
                                        <div class="wrap-filler">
                                            <input type="radio" name="price" value="30000000" class="btn_radio" {{ Request()->key2=='30000000'?'checked':'' }}>
                                            <span>d?????i 30.000.000 VN??</span>
                                        </div>
                                        <div class="wrap-filler">
                                            <input type="radio" name="price" value="40000000" class="btn_radio" {{ Request()->key2=='40000000'?'checked':'' }}>
                                            <span>tr??n 40.000.000 VN??</span>
                                        </div>
                                    </ul>
                                </form>
                            </div>
                        </div><!--/brands_products-->
                        
                       {{--  <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range--> --}}
                        
                       {{--  <div class="shipping text-center"><!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-- --}}

                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/iframe1.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/iframe2.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/iframe3.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{asset('public/frontend/images/map.png')}}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ???s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright ?? 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    
    {{-- <script src="{{ asset('public/frontend/js/lightslider.js')}}"></script> --}}
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}

    <script src="{{ asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js' )}}"></script> 
    {{-- m?? capcha --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{-- sweet alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=511180879841868&autoLogAppEvents=1" nonce="3pGGM3WE"></script>
    {{-- chat bot --}}
    <script>

      let __protocol = document.location.protocol;
      let __baseUrl = __protocol + '//livechat.fpt.ai/v35/src';

      let prefixNameLiveChat = 'Eshopper';
      let objPreDefineLiveChat = {
          appCode: '51d687f5f21f720858fb8b1a13edec6c',
          themes: '',
          appName: prefixNameLiveChat ? prefixNameLiveChat : 'Live support',
          thumb: '',
          icon_bot: ''
      },
      appCodeHash = window.location.hash.substr(1);
      if (appCodeHash.length == 32) {
          objPreDefineLiveChat.appCode = appCodeHash;
      }

      let fpt_ai_livechat_script = document.createElement('script');
      fpt_ai_livechat_script.id = 'fpt_ai_livechat_script';
      fpt_ai_livechat_script.src = __baseUrl + '/static/fptai-livechat.js';
      document.body.appendChild(fpt_ai_livechat_script);

      let fpt_ai_livechat_stylesheet = document.createElement('link');
      fpt_ai_livechat_stylesheet.id = 'fpt_ai_livechat_script';
      fpt_ai_livechat_stylesheet.rel = 'stylesheet';
      fpt_ai_livechat_stylesheet.href = __baseUrl + '/static/fptai-livechat.css';
      document.body.appendChild(fpt_ai_livechat_stylesheet);

      fpt_ai_livechat_script.onload = function () {
          fpt_ai_render_chatbox(objPreDefineLiveChat, __baseUrl, 'livechat.fpt.ai:443').catch(e => {
            console.log(e);
        });
      }
  </script>
  {{-- end chat bot --}}

  {{-- x??? l?? search ajax --}}
  <script type="text/javascript">
    $(document).ready(function() {
        $('#keywords').keyup(function() {
            var data = $(this).val();
            if (data !='') 
            {
               var token =$('input[name="_token"]').val();
               $.ajax({
                url: '{{ route('auto_search') }}',
                type: 'POST',
                data:{
                    data:data,
                    _token:token,
                }, /*name:bi???n var*/
                success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
                {
                 $('#search').fadeIn(); 
                 $('#search').html(data);
             }
         });
           }
           else {
                $('#search').fadeOut(); 
           }
       });
        $(document).on('click','li.value_search',function(e){
            e.preventDefault();
             $('#keywords').val($(this).text());
             $('#search').fadeOut();

        });
    });
</script>
{{-- end search ajax --}}

{{-- x??? l?? comment --}}
<script type="text/javascript">
  $(document).ready(function() {
    load_comment();

    $(document).on('click', '.pg .pagination a',function(e){
      e.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      load_comment(page);
  });
    function load_comment(page)
    {
      var comment_product_id = $('.comment_product_id').val();
      var token =$('input[name="_token"]').val();
      $.ajax({
        url: '{{ route('load_comment') }}'+"?page="+page,
        type: 'POST',
        data:{
            comment_product_id:comment_product_id,
            _token:token,
        }, /*name:bi???n var*/
        success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
        {
         $('#show_comments').html(data);
     }
 });
  }
  $('.send_comment').click(function(event) {
    var comment_product_id = $('.comment_product_id').val();
    var comment_name = $(this).prev().prev().prev().prev().children().val();
    var comment_content = $('.comment_content').val();
    var token =$('input[name="_token"]').val();
    $.ajax({
        url: '{{ route('send_comment') }}',
        type: 'POST',
        data:{
            comment_product_id:comment_product_id,
            comment_name:comment_name,
            comment_content:comment_content,
            _token:token,
        }, /*name:bi???n var*/
        success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
        {
         load_comment();
         swal({
            title: 'Th??m b??nh lu???n th??nh c??ng v?? ??ang ch??? duy???t!!!',
            icon: "warning",
            button: "Quay l???i",
        });
         $('.comment_content').val('');

     }
 });
});
});
</script>
{{-- end x??? l?? comment --}}

{{-- x??? l?? image product detail --}}
  {{-- <script>
    $('#lightSlider').lightSlider({
      gallery: true,
      item: 1,
      mode: 'fade',
      loop: true,
      slideMargin: 0,
      enableTouch: false,
      thumbItem: 12
  });
</script> --}}
{{-- end image --}}
<script type="text/javascript">
    {{-- b??? l???c --}}
    $(document).ready(function() {
        $('.btn_radio').change(function(event) {
            var value = $(this).val();
            window.location.href = `{{ route('trangchu') }}?key2=${value}`;
        });
    });
    /*end b??? l???c*/

    {{-- ph????ng th???c thanh to??n --}}
    $(document).ready(function() {
        $('.confirm-order').click(function(event) {
            event.preventDefault();
            var type = $('input[name=payment_option]:checked').val();
            if (type==2) {
                swal({
                    title: 'B???n mu???n thanh to??n b???ng ti???n m???t ch????',
                    text:"Ch??ng t??i s??? ship v?? b???n tr??? ti???n cho shipper",
                    icon: "warning",
                    buttons: ["kh??ng","ok!!!"]
                }).then((ok)=>{
                    if (ok) {
                       $(this).unbind('click').click();

                   }
                   else {

                   }

               });

            }
            else{
                swal({
                    title: 'B???n mu???n thanh to??n b???ng th??? ATM ch????',
                    text:"B???n s??? chuy???n kho???n v?? ch??ng t??i s??? x??c nh???n",
                    icon: "warning",
                    buttons: ["kh??ng","ok!!!"]
                }).then((ok)=>{
                    if (ok) {
                     $(this).unbind('click').click();
                 }
                 else {

                 }

             });
            }


        });
    });
    /*end ph????ng th???c thanh to??n*/

    {{-- t??nh ph?? v???n chuy???n --}}
    $(document).ready(function() {
      $('.choose').change(function() {
        var action = $(this).attr('id');
        var matp = $(this).val();
        var maqh = $(this).val();
        var token =$('input[name="_token"]').val();
        var result = '';
        if (action=="thanhpho") {
            result ="quanhuyen";
        }
        else if(action=="quanhuyen") {
           result ="xaphuong";
       }
       $.ajax({
        url: '{{ route('select-delivery-home') }}',
        type: 'POST',
        data:{
            _token:token,
            choose:action,
            name_tp:matp,
            name_qh:maqh,    

        }, /*name:bi???n var*/
        success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
        {
            $("#"+result).html(data);

        }

    });                                
   });
      $('.caculate_fee').click(function() {
          var matp = $('#thanhpho').val();
          var maqh = $('#quanhuyen').val();
          var maxp = $('#xaphuong').val();
          var token = $('input[name="_token"]').val();
          $.ajax({
            url: '{{ route('caculate_fee')}}',
            method: 'POST',
            data:{name_tp:matp,name_qh:maqh,name_xp:maxp,_token:token},
            success:function(data)
            {
               if (data=='l???i') {
                alert("L??m ??n ch???n ????? t??nh ph?? v???n chuy???n");
            }
            else {
               swal({
                title: 'T??nh ph?? ship th??nh c??ng!!!',
                text:"Quay l???i trang",
                icon: "success",
                button: "Ok!!!"
            }).then((ok)=>{
                if (ok) {
                    window.location.href = "{{route('view_checkout')}}";
                }

            });
        }
    }

});

      });
  });
    /*end ajax ph?? v???n chuy???n*/
    $(document).ready(function() {
      $('.cart_thanhtoan').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var cart_product_id = $('.cart_product_id_'+id).val();
        var cart_product_name = $('.cart_product_name_'+id).val();
        var cart_product_image = $('.cart_product_image_'+id).val();
        var cart_product_price = $('.cart_product_price_'+id).val();
        var cart_product_qty = $('.cart_product_qty_'+id).val();
        var quantity_storage = $('.cart_product_storage_'+id).val();
        var token = $('input[name="_token"]').val();
        alert(quantity_storage);

        if (parseInt(quantity_storage)>parseInt(cart_product_qty)) {
            $.ajax({
              url: '{{ route('cart-ajax') }}',
              type: 'POST',
              data:{cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:token,cart_product_id:cart_product_id,quantity_storage:quantity_storage}, /*name:bi???n var*/
              success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
              {
                swal({
                  title: 'Th??m gi??? h??ng th??nh c??ng!!!',
                  text:"b???n mu???n ?????n gi??? h??ng ch???!!",
                  icon: "success",
                  buttons:["kh??ng","Okee lunn"]
              }).then((ok)=>{
                if (ok) {
                    window.location.href = "{{ route('giohang_ajax') }}";
                }
                else{

                }

            });
          }
      });
        }
        else{
            swal({
              title: 'S??? l?????ng s???n ph???m kh??ng ?????!!!',
              text:"Xin vui l??ng li??n h??? v???i qu???n l?? ????? ???????c h??? tr???",
              icon: "warning",
              buttons:["Quay v??? trang ch???","Xem ti???p"],
          }).then((ok)=>{
            if (ok) {

            }
            else {
                window.location.href = "{{ route('trangchu') }}";
            }
            

        });
      }

  });
      $(document).ready(function() {
          $('.session_id').click(function(e) {
              e.preventDefault();
              $(this).parent().parent().remove();
              if ($('.wrap-cart').length==0) {
                 $('.total_area').remove();
             }
             var session_id = $(this).data('href');
             $.ajax({
              url: '{{ route('delete_cart_ajax') }}',
              type: 'GET',
              data:{session_id:session_id}, /*name:bi???n var*/
              success:function() /*d??? li???u(data) tr??? v??? b??n function*/
              {
                 swal({
                    text: 'X??a kh???i gi??? h??ng th??nh c??ng!!!',
                    icon: "success",
                    buttons: ["Kh??ng","Tr??? l???i gi??? h??ng"]
                }).then((ok)=>{
                    if (ok) {
                        window.location.href = "{{ route('giohang_ajax') }}";
                    }
                    else{

                    }

                });
            }
        });

         });
      });
      $(document).ready(function() {
          $('.capnhat').click(function() {
              var session_id = $(this).data('id');
              var token = $('input[name="_token"]').val();
              var soluong = $('.cart_quantity_input_'+session_id).val();
              var cart_product_name = $('.product_name_'+session_id).val();
              $.ajax({
                  url: '{{ route('update_cart_ajax') }}',
                  type: 'POST',
                  data:{capnhat:session_id,_token:token,quantity:soluong,cart_product_name:cart_product_name}, /*name:bi???n var*/
                  success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
                  {
                   if (data['error']=='error') {
                       swal({
                        text: `S??? l?????ng s???n ph???m ${data['product']} kh??ng ????? ????? ?????t h??ng!!!`,
                        icon: "warning",
                        button: "Tr??? l???i gi??? h??ng"
                    });
                   }
                   else{
                     swal({
                        text: 'c???p nh???t gi??? h??ng th??nh c??ng!!!',
                        icon: "success",
                        button: "Tr??? l???i gi??? h??ng"
                    }).then((ok)=>{
                        if (ok) {
                            window.location.href = "{{ Request()->url() }}";
                        }
                        else{

                        }

                    });
                }
            }
        });
          });
      });
  });
</script>

</body>
</html>