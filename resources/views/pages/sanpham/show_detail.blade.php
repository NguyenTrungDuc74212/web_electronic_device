@extends('home_layout')
@section('content')
<style type="text/css">
	/* Style the list */
	ul.breadcrumb {
		padding: 10px 16px;
		list-style: none;
		background-color: #eee;
	}

	/* Display list items side by side */
	ul.breadcrumb li {
		display: inline;
		font-size: 16px;
	}

	/* Add a slash symbol (/) before/behind each list item */
	ul.breadcrumb li+li:before {
		padding: 8px;
		color: black;
		content: "/\00a0";
	}

	/* Add a color to all links inside the list */
	ul.breadcrumb li a {
		color: #fe980f;
		font-size: 16px;
		text-decoration: none;
	}

	/* Add a color on mouse-over */
	ul.breadcrumb li a:hover {
		color: #fe980f;
		text-decoration: underline;
	}
</style>
<ul class="breadcrumb" style="background: none">
	<li><a href="{{ route('trangchu') }}">Trang chủ</a></li>
	<li><a href="{{ route('category_home',$product->category->slug) }}">{{$product->category->name}}</a></li>
	<li><a href="{{ route('brand_home',$product->brand->slug) }}">{{$product->brand->name}}</a></li>
	<li>{{ $product->name }}</li>
</ul>
<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<div class="view-product">
			<img src="{{ asset('public/upload/product/'.$product->image)}}" alt="" />
			<h3>ZOOM</h3>
		</div>
		@if (count($gallery)>1)
		<div id="similar-product" class="carousel slide" data-ride="carousel">

			<!-- Wrapper for slides -->
			
			<div class="carousel-inner">

				<div class="item active">
					@foreach ($gallery as $value)
					<a href=""><img src="{{ asset('public/upload/gallery/'.$value->image) }}" alt="" style="width: 27%;"></a>
					@endforeach				
				</div>
				
				<div class="item">
					@foreach ($gallery as $value)
					<a href=""><img src="{{ asset('public/upload/gallery/'.$value->image) }}" alt="" style="width: 27%;"></a>
					@endforeach
				</div>
				<div class="item">
					@foreach ($gallery as $value)
					<a href=""><img src="{{ asset('public/upload/gallery/'.$value->image) }}" alt="" style="width: 27%;"></a>
					@endforeach
				</div>
				

			</div>
			

			<!-- Controls -->
			<a class="left item-control" href="#similar-product" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="right item-control" href="#similar-product" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		@endif

	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{ $product->name }}</h2>
			<p>sản phẩm id: {{$product->id}}</p>
			<img src="images/product-details/rating.png" alt="" />
			<form>
				@csrf
				<img src="{{asset('public/upload/product/'.$product->image)}}" alt="" class="img-fluid" />
				<input type="hidden" value="{{ $product->id }}" class="cart_product_id_{{$product->id}}">
				<input type="hidden" value="{{ $product->name }}" class="cart_product_name_{{$product->id}}">
				<input type="hidden" value="{{ $product->image}}" class="cart_product_image_{{$product->id}}">
				<input type="hidden" value="{{ $product->price}}" class="cart_product_price_{{$product->id}}">
				<div class="text-center soluong" style="transform: translateY(26px) translateX(91px);">
					<label>Số lượng</label>
					<input type="number" class="cart_product_qty_{{$product->id}} text-center" style="width: 20%;" min="1" value="1">
				</div>
				<input type="hidden" value="{{ $product->quantity}}" class="cart_product_storage_{{$product->id}}">
				<h2>{{ currency_format($product->price)}}</h2>
				<p>{{ $product->name }}</p>
				<input type="hidden" min="1" value="1" name="soluong"/>
				<input type="hidden" name="product_id" value="{{$product->id}}">
				<button type="button" class="btn btn-default add-to-cart cart_thanhtoan" data-id={{ $product->id }}><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
			</form>
			<p><b>Tình trạng: </b> Còn hàng</p>
			<p><b>Điều kiện: </b>Hàng mới 100%</p>
			<p><b>Thương hiệu: </b>{{$product->brand->name}}</p>
			<p><b>Danh mục: </b>{{$product->category->name}}</p>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
			<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade" id="details" >
			<p>{!! $product->content !!}</p>
		</div>
		<div class="tab-pane fade" id="companyprofile" >
			<p>{!! $product->description !!}</p>
		</div>
		<div class="tab-pane fade active in" id="reviews" >
			<div class="col-sm-12">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>Admin</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>16-9-2020</a></li>
				</ul>
				<form>
					@csrf
					<input type="hidden" name="comment_product_id" value="{{ $product->id }}" class="comment_product_id">
					<div id="show_comments">
						
					</div>
				</form>
				<br>

				<p><b>Viết đánh giá của bạn</b></p>

				<form action="#">
					@if (session('id_customer'))
					<span>
						<input type="text" value="{{session('name_customer') }}" disabled style="margin-left: 0%;color: blue;width: 100%;" class="form-control" />
					</span>
					@else
					<span>
						<input type="text" placeholder="Tên bình luận" style="margin-left: 0%;width: 100%;" class="form-control"/>
					</span>
					@endif
					<textarea name="comment_content" class="comment_content" placeholder="Nội dung bình luận"></textarea>
					<b>Đánh giá: </b> <img src="images/product-details/rating.png" alt="" />
					<button type="button" class="btn btn-default pull-right send_comment">
						Thêm bình luận
					</button>
				</form>
			</div>
		</div>

	</div>
</div><!--/category-tab-->
<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Gợi ý sản phẩm</h2>
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				@foreach ($product_relate as $value)
				@if ($value->id!=$product->id)		
				<div class="col-sm-4">
					<div class="product-image-wrapper" style="height: 500px;">
						<div class="single-products">
							<div class="productinfo text-center">
								<a href="{{route('chitietsanpham',$value->slug)}}"><img src="{{asset('public/upload/product/'.$value->image) }}" alt="" /></a>
								<h2>{{ currency_format($value->price) }}</h2>
								<p>{{ $value->name }}</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach	
			</div>
			<div class="item">	
				@foreach ($product_relate as $value)
				@if ($value->id!=$product->id)		
				<div class="col-sm-4">
					<div class="product-image-wrapper" style="height: 500px;">
						<div class="single-products">
							<div class="productinfo text-center">
								<a href="{{route('chitietsanpham',$value->slug)}}"><img src="{{asset('public/upload/product/'.$value->image) }}" alt=""/></a>
								<h2>{{ currency_format($value->price) }}</h2>
								<p>{{ $value->name }}</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach	
			</div>
		</div>
		<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>			
	</div>
</div><!--/recommended_items-->
@stop