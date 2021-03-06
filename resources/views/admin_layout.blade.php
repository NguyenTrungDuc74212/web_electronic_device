<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>ADMIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}" >
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{ asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet"> 
{{-- <link rel="stylesheet" href="{{ asset('public/backend/css/morris.css') }}" type="text/css"/> --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<!-- calendar -->
<link rel="stylesheet" href="{{ asset('public/backend/css/monthly.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="{{ asset('public/backend/js/jquery2.0.3.min.js' )}}"></script>
<script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
{{-- <script src="{{ asset('public/backend/js/morris.js') }}"></script> --}}
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
<a href="{{ route('trangchuadmin')}}" class="logo">
ADMIN
</a>
<div class="sidebar-toggle-box">
<div class="fa fa-bars"></div>
</div>
</div>
<!--logo end-->

<!--  notification end -->

<div class="top-nav clearfix">
<!--search & user info start-->
<ul class="nav pull-right top-menu">
<li>
<input type="text" class="form-control search" placeholder=" Search">
</li>
<!-- user login dropdown start-->
<li class="dropdown">
<a data-toggle="dropdown" class="dropdown-toggle" href="#">
<img alt="" src="http://myweb.com.local/Shopbanhanglaravel/public/backend/images/2.png">
@if (Auth::check())
<span class="username">{{ Auth::user()->name}}</span>
@endif
<b class="caret"></b>
</a>
<ul class="dropdown-menu extended logout">
<li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
<li><a href="{{ route('dangxuat') }}"><i class="fa fa-key"></i> ????ng xu???t</a></li>
</ul>
</li>
<!-- user login dropdown end -->

</ul>
<!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
<div id="sidebar" class="nav-collapse">
<!-- sidebar menu start-->
<div class="leftside-navigation" tabindex="5000" style="overflow: hidden; outline: none;">
<ul class="sidebar-menu" id="nav-accordion">
<li>
<a class="active" href="{{ route('trangchuadmin') }}">
<i class="fa fa-dashboard"></i>
<span>T???ng quan</span>
</a>
</li>
<li class="sub-menu dcjq-parent-li">
<a href="javascript:;" class="dcjq-parent">
<i class="fa fa-book"></i>
<span>????n h??ng</span>
<span class="dcjq-icon"></span></a>
<ul class="sub" style="display: none;">
<li><a href="{{ route('manage-order') }}">Qu???n l?? ????n h??ng</a></li>
</ul>
</li>
<li class="sub-menu dcjq-parent-li">
<a href="javascript:;" class="dcjq-parent">
<i class="fa fa-book"></i>
<span>M?? gi???m gi??</span>
<span class="dcjq-icon"></span></a>
<ul class="sub" style="display: none;">
    <li><a href="{{ route('view_insert_coupon') }}">Th??m m?? gi???m gi??</a></li>
    <li><a href="{{ route('list_coupon') }}">Li???t k?? m?? gi???m gi??</a></li>
</ul>
</li>
<li class="sub-menu dcjq-parent-li">
<a href="javascript:;" class="dcjq-parent">
    <i class="fa fa-book"></i>
    <span>V???n chuy???n</span>
    <span class="dcjq-icon"></span></a>
    <ul class="sub" style="display: none;">
        <li><a href="{{ route('add_delivery') }}">Qu???n l?? v???n chuy???n</a></li>
        {{-- <li><a href="">gi??</a></li> --}}
    </ul>
</li>
<li class="sub-menu dcjq-parent-li">
    <a href="javascript:;" class="dcjq-parent">
        <i class="fa fa-book"></i>
        <span>Danh m???c s???n ph???m</span>
        <span class="dcjq-icon"></span></a>
        <ul class="sub" style="display: none;">
            <li><a href="{{ route('themdanhmucsp') }}">Th??m danh m???c s???n ph???m</a></li>
            <li><a href="{{ route('dsdanhmuc') }}">Li???t k?? danh m???c s???n ph???m</a></li>
        </ul>
    </li>
    <li class="sub-menu dcjq-parent-li">
        <a href="javascript:;" class="dcjq-parent">
            <i class="fa fa-book"></i>
            <span>Th????ng hi???u s???n ph???m</span>
            <span class="dcjq-icon"></span></a>
            <ul class="sub" style="display: none;">
                <li><a href="{{ route('add_brand') }}">Th??m th????ng hi???u s???n ph???m</a></li>
                <li><a href="{{ route('list_brand') }}">Li???t k?? th????ng hi???u s???n ph???m</a></li>
            </ul>
        </li>
        <li class="sub-menu dcjq-parent-li">
            <a href="javascript:;" class="dcjq-parent">
                <i class="fa fa-book"></i>
                <span>S???n ph???m</span>
                <span class="dcjq-icon"></span></a>
                <ul class="sub" style="display: none;">
                    <li><a href="{{ route('add_product') }}">Th??m s???n ph???m</a></li>
                    <li><a href="{{ route('list_product') }}">Li???t k?? s???n ph???m</a></li>
                </ul>
            </li>
            <li class="sub-menu dcjq-parent-li">
            <a href="javascript:;" class="dcjq-parent">
                <i class="fa fa-book"></i>
                <span>Qu???n l?? b??nh lu???n</span>
                <span class="dcjq-icon"></span></a>
                <ul class="sub" style="display: none;">
                    <li><a href="{{ route('list_comments') }}">Li???t k?? b??nh lu???n</a></li>
                </ul>
            </li>
            @can('admin')
            <li class="sub-menu dcjq-parent-li">
                <a href="javascript:;" class="dcjq-parent">
                    <i class="fa fa-book"></i>
                    <span>Users</span>
                    <span class="dcjq-icon"></span></a>
                    <ul class="sub" style="display: none;">
                        <li><a href="{{ route('register-user') }}">????ng k?? user</a></li>
                        <li><a href="{{ route('list_user') }}">Ph???n quy???n users</a></li>
                    </ul>
                </li>
            @endcan
            </ul>            
        </div>
        <!-- sidebar menu end-->
        <div id="ascrail2000" class="nicescroll-rails" style="width: 3px; z-index: auto; cursor: default; position: absolute; top: 0px; left: 237px; height: 302px; opacity: 0; display: block;"><div style="position: relative; top: 0px; float: right; width: 3px; height: 147px; background-color: rgb(139, 92, 126); border: 0px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 0px;"></div></div><div id="ascrail2000-hr" class="nicescroll-rails" style="height: 3px; z-index: auto; top: 299px; left: 0px; position: absolute; cursor: default; display: none; width: 237px; opacity: 0;"><div style="position: relative; top: 0px; height: 3px; width: 240px; background-color: rgb(139, 92, 126); border: 0px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 0px;"></div></div></div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- //market-->
            @yield('content')
            <!-- //market-->


            <!-- tasks -->

            <!-- //tasks -->

        </section>
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
              <p>?? 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
          </div>
      </div>
      <!-- / footer -->
  </section>
  <!--main content end-->
</section>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    CKEDITOR.replace('ck');
    CKEDITOR.replace('ck_1');
});
</script>



{{-- x??? l?? ph???n comment --}}
<script type="text/javascript">
  $('.comment_pass_btn').click(function(event) {
      var comment_status = $(this).data('cm_status');
      var comment_id = $(this).data('cm_id');
      var comment_product_id = $(this).attr('id');
     
      $.ajax({
            url: '{{ route('allow_comment') }}',
            type: 'POST',
             headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{
                comment_status:comment_status,
                comment_id:comment_id,
                comment_product_id:comment_product_id,

            }, /*name:bi???n var*/
            success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
            {
              if (data=='1') {
                swal({
                  title: 'Duy???t comment th??nh c??ng!!!',
                  text:"Comment s??? xu???t hi???n tr??n website c???a b???n",
                  icon: "success",
                  button:"quay l???i",
                    }).then((ok)=>{
                    location.reload();  
                });
              }
              else if(data=='2')
              {
                swal({
                  title: 'B??? duy???t comment th??nh c??ng!!!',
                  text:"Comment s??? b??? ???n tr??n website c???a b???n",
                  icon: "success",
                  button:"quay l???i",
                    }).then((ok)=>{
                    location.reload();
                });
              }
            }
                    
        });    
  });
  $('.reply_comment').click(function(event) {
     var rep_comment = $(this).next().val();
     var comment_id = $(this).data('cm_id');
     var product_id = $(this).attr('id');
     var admin_id = $(this).data('admin_id');

     if (rep_comment=='') {
                swal({
                  title: 'Tr??? l???i comment th???t b???i!!!',
                  text:"B???n ph???i nh???p gi?? tr??? v??o ?? n??y ",
                  icon: "warning",
                  button:"quay l???i",
                    });
                return false;
     }

     $.ajax({
            url: '{{ route('reply_comment') }}',
            type: 'POST',
             headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{
                rep_comment:rep_comment,
                comment_id:comment_id,
                product_id:product_id,
                admin_id:admin_id,

            }, /*name:bi???n var*/
            success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
            {
                swal({
                  title: 'Tr??? l???i comment th??nh c??ng!!!',
                  text:"Comment s??? ???????c hi???n tr??n website c???a b???n",
                  icon: "success",
                  button:"quay l???i",
                    }).then((ok)=>{
                      location.reload();
                    });
                 
            }     
        });    

  });
  $(document).on('blur','.comment_value',function(){
         var comment_value = $(this).text();
        var comment_id = $(this).data('id');
         $.ajax({
            url: '{{ route('edit_comment') }}',
            type: 'POST',
             headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{
                comment_value:comment_value,
                comment_id:comment_id,

            }, /*name:bi???n var*/
            success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
            {
                swal({
                  title: 'S???a comment th??nh c??ng!!!',
                  text:"Comment s??? b??? ???n tr??n website c???a b???n",
                  icon: "success",
                  button:"quay l???i",
                    }).then((ok)=>{
                      location.reload();
                    });    
            }          
        });    
  });
</script>
{{-- end x??? l?? ph???n comment --}}



{{-- x??? l?? update s??? l?????ng sp trong order --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.update_quantity_order').click(function(event) {
            var token =$('input[name="_token"]').val();
            var order_product_id = $(this).data('product_id');
            var order_quantity = $('.order_quantity_'+order_product_id).val();
            var all_quantity = [];
            var all_price = [];
            var all_fee = $('.all_fee').val();
            var order_id = $('.order_id').val();
            var total_update = $('.total_update').val();

            $('.order_quantity').each(function() { /*l???p qua object*/
                all_quantity.push($(this).val());
            });
            $('.product_price').each(function() {
                all_price.push($(this).val());
            });

            $.ajax({
            url: '{{ route('update_order_qty') }}',
            type: 'POST',
            data:{
                _token:token,
                 order_product_id:order_product_id,
                 order_quantity:order_quantity,
                 order_id:order_id,
                 all_quantity:all_quantity,
                 all_price:all_price,
                 all_fee:all_fee,

            }, /*name:bi???n var*/
            success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
            {
                alert('C???p nh???t s??? l?????ng th??nh c??ng');
                location.reload();  
                
            }
        });
        });
    });
</script>
{{-- end x??? l?? --}}


{{-- x??? l?? ????ng nhi???u h??nh ???nh --}}

<script type="text/javascript">
  $(document).ready(function() {
    load_image();
    function load_image()
    {
      var product_id = $('.product_id').val();
      var token =$('input[name="_token"]').val();
      $.ajax({
                url: '{{ route('select_gallery') }}',
                type: 'POST',
                data:{
                    product_id:product_id,
                    _token:token,

                }, /*name:bi???n var*/
                success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
                {
                     $('#load_image').html(data);
                }
            });
    }
    $('#file').change(function(event) {
      var files = $('#file')[0].files;
      var error = '';
     if (files.length>5) {
       error+='<p class="text-danger">B???n ch??? ???????c ch???n t???i ??a 5 ???nh</p>';
     }
     else if(files.length=='')
     {
      error+='<p class="text-danger">B???n kh??ng ???????c b??? tr???ng ???nh</p>';
     }

     if (error=='') {
     }
     else {
       $('#file').val('');
       $('#error_image').html(error);
     }

    });

    $(document).on('blur','.edit_gallery_name',function(){
          var gallery_id = $(this).data('gallery_id');
          var gallery_text =$(this).text();
          var token =$('input[name="_token"]').val();
          $.ajax({
                url: '{{ route('update_gallery') }}',
                type: 'POST',
                data:{
                    gallery_id:gallery_id,
                    gallery_text:gallery_text,
                    _token:token,

                }, /*name:bi???n var*/
                success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
                {
                    load_image();
                }
            });
    });
    $(document).on('click','.delete-image',function(e){
      e.preventDefault();
          var gallery_id = $(this).data('id');
          var token =$('input[name="_token"]').val();
          swal({
          title: 'B???n c?? mu???n x??a h??nh ???nh n??y kh??ng!!!',
          icon: "warning",
          buttons:["kh??ng","ok"],
      }).then((ok)=>{
             if (ok) {
               $.ajax({
                url: '{{ route('delete_gallery') }}',
                type: 'POST',
                data:{
                    gallery_id:gallery_id,
                    _token:token,

                }, /*name:bi???n var*/
                success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
                {
                  swal({
                  title: 'X??a th??nh c??ng',
                  icon: "success",
                  button:"quay l???i",
                   });
                  load_image();
                }
            });
          }
          else {
            swal({
                  title: 'images have been verity safe',
                  icon: "success",
                  button:"quay l???i",
                  });
          }
      });
          
    });
    $(document).on('change','.file_name',function(){
          var image_id = $(this).data('image_id');
          var file =document.getElementById('file_name_'+image_id).files[0];

          form_data = new FormData(); 
          form_data.append('file',document.getElementById('file_name_'+image_id).files[0]);
          form_data.append('image_id',image_id);
          $.ajax({
                url: '{{ route('update_image') }}',
                type: 'POST',
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data, /*name:bi???n var*/
                contentType:false,
                cache:false,
                processData:false,
                success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
                { 
                  swal({
                  title: '???? upload ???nh th??nh c??ng',
                  icon: "success",
                  button:"quay l???i",
                  });
                   load_image();
                }
            });
    });
  });
</script>

{{-- end x??? l?? ????ng nhi???u h??nh ???nh --}}




{{-- x??? l?? h??ng t???n (tr???ng th??i ????n h??ng,...) --}}
<script type="text/javascript">
  $(document).ready(function() {
      $('.order_details').change(function() {
          var order_status = $(this).val();
          var order_id = $(this).attr('id');
          var token =$('input[name="_token"]').val();

          var quantity = [];
          var order_product_id =[];
          $('input[name="quantity"]').each(function() {
              quantity.push($(this).val());
          });
          $('input[name="order_product_id"]').each(function() {
              order_product_id.push($(this).val());
          });


          j = 0;
          for (var i = 0; i < order_product_id.length; i++) {
              var order_quantity = $('.order_quantity_'+order_product_id[i]).val();
              var product_storage_quantity = $('.product_storage_'+order_product_id[i]).val();   
              if (parseInt(order_quantity)>parseInt(product_storage_quantity))
              {
                 j = j+1;
                 if (j==1) 
                 {
                     alert(`C?? ${j} s???n ph???m ???? h???t h??ng trong kho`);
                    $('.color_quantity_'+order_product_id[i]).css('background','red');
                  }  
                
              }
          }
        if (j==0) {
              $.ajax({
                url: '{{ route('update_order_status') }}',
                type: 'POST',
                data:{
                    _token:token,
                     order_status:order_status,
                     order_id:order_id,
                     quantity:quantity,
                     order_product_id:order_product_id,

                }, /*name:bi???n var*/
                success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
                {
                    alert('thay ?????i t??nh tr???ng ????n h??ng th??nh c??ng');
                    location.reload();  
                }
            });
        } 


      });
  });
</script>
{{-- end h??ng t???n --}}


{{-- x??? l?? ph?? ship --}}
<script type="text/javascript">
$(document).ready(function() {
    fetch_delivery();
    function fetch_delivery()
    {
        var token =$('input[name="_token"]').val();
        $.ajax({
            url: '{{ route('load_delivery') }}',
            type: 'POST',
            data:{
                _token:token, 

            }, /*name:bi???n var*/
            success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
            {
                $(".load-delivery").html(data);

            }
        });
    }
    $(document).on('blur','.feeship_edit',function(){
        var id= $(this).data('id');
        var feeship = $(this).text();
        var feeship_o=(feeship.substring(0,feeship.length).trim()).replace(".","").replace("??",'');
        var token =$('input[name="_token"]').val();
        $.ajax({
            url: '{{ route('update_delivery') }}',
            type: 'POST',
            data:{
                _token:token,
                id:id,
                feeship:feeship_o,

            }, /*name:bi???n var*/
            success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
            {
               fetch_delivery();       
           },
           error: function() {
            swal({
              title: 'L???i!!!',
              text:"Nh???p kh??ng ????ng d??? li???u ho???c ch??a nh???p",
              icon: "error",
              button:"quay l???i",
          }).then((ok)=>{
            window.location.href="{{ route('add_delivery') }}";

        });
      }
  });

    });
    $(document).on('click','.xoa-delivery',function(){
       var id = $(this).data('href');
       var token =$('input[name="_token"]').val();
       swal({
          title: 'B???n c?? mu???n x??a ph?? ship kh??ng!!!',
          icon: "warning",
          buttons:["kh??ng","ok"],
      }).then((ok)=>{
        if (ok) {
            $.ajax({
                url: '{{ route('delete_delivery') }}',
                type: 'POST',
                data:{
                    id:id,
                    _token:token,   
                }, /*name:bi???n var*/
                success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
                {


                },
            });
            swal('B???n ???? x??a th??nh c??ng!!',{
                icon:'success',
            });
            fetch_delivery();
        }
        else {
            swal('Your feeship is safe!!!',{
                icon:'success',
            });
            fetch_delivery();
        }
    });

  });

    $('.add_delivery').click(function() {
        var thanhpho = $('#thanhpho').val();
        var quanhuyen = $('#quanhuyen').val();
        var xaphuong = $('#xaphuong').val();
        var phiship = $('.phiship').val();
        var token =$('input[name="_token"]').val();
        $.ajax({
            url: '{{ route('insert_delivery') }}',
            type: 'POST',
            data:{
                _token:token,
                name_tp:thanhpho,    
                name_qh:quanhuyen,    
                name_xp:xaphuong,
                feeship:phiship,   

            }, /*name:bi???n var*/
            success:function(data) /*d??? li???u(data) tr??? v??? b??n function*/
            {
                swal({
                  title: 'Th??m ph?? ship th??nh c??ng!!!',
                  icon: "success",
                  button:"quay l???i",
              }).then((ok)=>{
                fetch_delivery();
                $('.reset_op').attr("selected","selected");
                $('.phiship').val("");

            });

          },
          error: function() {
            swal({
              title: 'L???i!!!',
              text:"Nh???p kh??ng ????ng d??? li???u ho???c ch??a nh???p",
              icon: "error",
              button:"quay l???i",
          }).then((ok)=>{
            window.location.href="{{ route('add_delivery') }}";

        });
      }

  });

    });  

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
        url: '{{ route('select-delivery') }}',
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
});
</script>
{{-- end ph?? ship --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('public/backend/js/scripts.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset( 'public/backend/js/jquery.scrollTo.js') }}"></script>

{{-- x??? l?? ph???n date_search --}}
<script type="text/javascript">
  $( function() {
    $( "#datepicker").datepicker({
      dateFormat: "yy-mm-dd",
    });
    $( "#datepicker2").datepicker({
      dateFormat: "yy-mm-dd",
    });
    $( "#datepicker3").datepicker({
      dateFormat: "yy-mm-dd",
    });
    $( "#datepicker4").datepicker({
      dateFormat: "yy-mm-dd",
    });
  } );
</script>
{{-- end date_search --}}
<script type="text/javascript">
  $(document).ready( function () {
    $('#myTable').DataTable();
    $('#table_comment').DataTable();
    $('#table_coupon').DataTable();
} );
</script>
<!-- morris JavaScript -->  

<script>
$(document).ready(function() {
//BOX BUTTON SHOW AND CLOSE
jQuery('.small-graph-box').hover(function() {
jQuery(this).find('.box-button').fadeIn('fast');
}, function() {
jQuery(this).find('.box-button').fadeOut('fast');
});
jQuery('.small-graph-box .box-close').click(function() {
jQuery(this).closest('.small-graph-box').fadeOut(200);
return false;
});


</script>
<!-- //calendar -->
</body>
</html>
