<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*frontend*/
Route::get('/','homeController@index')->name('trangchu');
Route::get('trangchu','homeController@index')->name('trangchu');
Route::get('/timkiem','homeController@index')->name('timkiem');
Route::post('/auto-search','homeController@auto_search')->name('auto_search');


// danh mục,thương hiệu trang chủ sản phẩm trang chủ
Route::get('category/{slug}','CategoryProduct@show_category_home')->name('category_home');
Route::get('brand/{slug}','brandProduct@show_brand_home')->name('brand_home');
/*end danh mục thương hiệu*/

//chi tiết sản phẩm
Route::get('detail/{slug}','ProductController@detail_product')->name('chitietsanpham');
/*end chi tiết*/


//sendmail
Route::get('/email', 'EmailController@create');
Route::post('/email', 'EmailController@sendEmail')->name('send.email');
Route::post('/email-all', 'EmailController@send_coupon')->name('send_coupon');

// giỏ hàng
Route::get('show_cart','cartController@show_cart')->name('giohang');
Route::post('cart','cartController@save_cart')->name('giohang_post');
Route::get('xoa_cart/{id}','cartController@delete_cart')->name('xoa_hang');
Route::get('delete_cart','cartController@delete_cart_ajax')->name('delete_cart_ajax');
Route::post('update_soluong','cartController@update_cart')->name('update_soluong');
Route::get('giohang','cartController@gio_hang')->name('giohang_ajax');
Route::post('add-cart-ajax','cartController@add_cart_ajax')->name('cart-ajax');
Route::post('update-cart-ajax','cartController@update_cart_ajax')->name('update_cart_ajax');
//coupon
Route::post('/check_coupon','cartController@check_coupon')->name('check_coupon');

Route::get('/insert_coupon','couponController@insert_coupon')->name('view_insert_coupon');
Route::post('/save_coupon','couponController@save_coupon')->name('save_coupon');

Route::get('/list-coupon','couponController@list_coupon')->name('list_coupon');
Route::get('/xoa-coupon/{id}','couponController@delete_coupon')->name('delete_coupon');




//checkout(thanh toán)
Route::post('caculate-fee','checkoutController@caculate_fee')->name('caculate_fee');

Route::get('login_checkout','checkoutController@login_checkout')->name('login_checkout');
Route::post('add_customer','checkoutController@add_customer')->name('them_khachhang');
Route::get('checkout','checkoutController@get_checkout')->name('view_checkout')->middleware('check_customer');
Route::post('save_checkout','checkoutController@save_shipping')->name('save_checkout')->middleware('check_customer');
Route::get('login_customer','checkoutController@login_customer')->name('login_customer');
Route::get('logout_trangchu','checkoutController@logout_checkout')->name('logout_checkout');
// Route::get('payment','checkoutController@payment')->name('payment')->middleware('check_payment');
// Route::post('order_place','checkoutController@order_place')->name('dathang')->middleware('check_payment');
Route::get('Success_payment','checkoutController@checkout_success')->name('thanh_cong')->middleware('check_payment');
Route::post('/select-delivery-home','deliveryController@select_delivery_home')->name('select-delivery-home');


//comments
Route::post('load_comment','commentController@load_comment')->name('load_comment');
Route::post('send_comment','commentController@send_comment')->name('send_comment');

//login_google
Route::get('login-google-customer','checkoutController@login_customer_google')->name('login_customer_google');
Route::get('/customer/google/callback','checkoutController@callback_customer_google');
// Route::get('google/callback','adminController@callback_google');


/*end frontend*/


//backend

Route::get('logout','adminController@logout')->name('dangxuat');

Route::get('admin','adminController@index')->name('login_view');
Route::post('trangchu_admin','adminController@dashboard')->name('login');
//Login facebook
Route::get('login-facebook','adminController@login_facebook')->name('facebook');
Route::get('facebook/callback','adminController@callback_facebook');
//Login google
Route::get('login-google','adminController@login_google')->name('google');
Route::get('google/callback','adminController@callback_google');
// Quên mật khẩu
Route::get('forgot-password','adminController@view_forgot')->name('form_forgot_pass');
Route::post('send_mail_password','adminController@send_mail')->name('send_mail');

Route::get('reset-password/{reset_password_token}','adminController@reset_password')->name('reset_password');
Route::post('change-password','adminController@change_password')->name('change_password');


Route::group(['middleware'=>'check_login'], function() {
	//thongke
	Route::get('trangchu_admin','adminController@showadmin')->name('trangchuadmin');
	Route::post('filter-by-date','statController@filter_date')->name('filter_date');
	Route::post('filter-date-selection','statController@order_filter')->name('order_filter');
	Route::post('filter-30-days','statController@order_30_day')->name('order_30_day');

    //category
	Route::get('addCategory','CategoryProduct@addCategory')->name('themdanhmucsp');
	Route::post('addCategory','CategoryProduct@saveCategory')->name('themdanhmucsp_post');
	Route::get('listCategory','CategoryProduct@listCategory')->name('dsdanhmuc');

	Route::get('an_category/{id}','CategoryProduct@anCategory')->name('an_category');
	Route::get('hien_category/{id}','CategoryProduct@hienCategory')->name('hien_category');

	Route::get('edit_category/{id}','CategoryProduct@editCategory')->name('sua_category');
	Route::put('edit_category/{id}','CategoryProduct@updateCategory')->name('luu_category');

	Route::get('delete_category/{id}','CategoryProduct@deleteCategory')->name('xoa_category')->middleware('adminRole');;

//Brand
	Route::get('addBrand','BrandProduct@addBrand')->name('add_brand');
	Route::post('addBrand','BrandProduct@saveBrand')->name('addbrand_post');
	Route::get('listBrand','BrandProduct@listBrand')->name('list_brand');

	Route::get('an_brand/{id}','BrandProduct@anBrand')->name('an_brand');
	Route::get('hien_Brand/{id}','BrandProduct@hienBrand')->name('hien_brand');

	Route::get('edit_Brand/{id}','BrandProduct@editBrand')->name('sua_brand');
	Route::put('edit_brand/{id}','BrandProduct@updateBrand')->name('luu_brand');

	Route::get('delete_brand/{id}','BrandProduct@deleteBrand')->name('xoa_brand')->middleware('adminRole');

//Product
	Route::get('addProduct','ProductController@addProduct')->name('add_product');
	Route::post('addProduct','ProductController@saveProduct')->name('addproduct_post');
	Route::get('listProduct','ProductController@listProduct')->name('list_product');

	Route::get('an_product/{id}','ProductController@anProduct')->name('an_product');
	Route::get('hien_product/{id}','ProductController@hienProduct')->name('hien_product');

	Route::get('edit_product/{id}','ProductController@editProduct')->name('sua_product');
	Route::put('edit_product/{id}','ProductController@updateProduct')->name('luu_product');

	Route::get('delete_product/{id}','ProductController@deleteProduct')->name('xoa_product')->middleware('adminRole');
	//comments
     Route::get('/comments','commentController@list_comments')->name('list_comments');
     Route::post('/allow-comment','commentController@allow_comment')->name('allow_comment');
     Route::post('/reply-comment','commentController@reply_comment')->name('reply_comment');
     Route::post('/edit-comment','commentController@edit_comment')->name('edit_comment');
     Route::get('delete-comment/{id}','commentController@delete_comment')->name('delete_comment');


//gallery
	Route::get('add_gallery/{id}','ProductController@add_gallery')->name('add_gallery');
	Route::post('select-gallery','ProductController@select_gallery')->name('select_gallery');
	Route::post('insert-gallery/{id}','ProductController@insert_gallery')->name('insert_gallery');
	Route::post('update_gallery_name','ProductController@update_gallery')->name('update_gallery');
	Route::post('delete_gallery','ProductController@delete_gallery')->name('delete_gallery');
	Route::post('update_image','ProductController@update_image')->name('update_image');


	/*order*/
	Route::get('manage-order','checkoutController@manage_order')->name('manage-order');
	Route::get('xoa-order','checkoutController@xoa_order')->name('xoa_order');
	Route::get('view-order/{id}','checkoutController@view_order')->name('view_order');
	Route::get('xoa-order/{id}','checkoutController@xoa_order')->name('xoa_order');
	Route::get('print-order/{order_id}','checkoutController@print_order')->name('print_order');
	Route::post('/update-order-status','orderController@update_order_status')->name('update_order_status');
	Route::post('/update-order-qty','orderController@update_order_qty')->name('update_order_qty');
	Route::post('/load-order-detail','orderController@load_order_detail')->name('load_order_detail');
	/*end order*/

	/*delivery*/
	Route::get('/delivery','deliveryController@delivery')->name('add_delivery');
	Route::post('/xoa_delivery','deliveryController@delete_delivery')->name('delete_delivery')->middleware('adminRole');

	Route::post('/select-delivery','deliveryController@select_delivery')->name('select-delivery');
	Route::post('/add-delivery','deliveryController@insert_delivery')->name('insert_delivery');
	Route::post('/load-delivery','deliveryController@load_delivery')->name('load_delivery');
	Route::post('/update-delivery','deliveryController@update_delivery')->name('update_delivery')->middleware('adminRole');



	/*user*/
	Route::group(["middleware"=>'adminRole'], function() {
		Route::get('list-user','adminController@list_user')->name('list_user');
		Route::post('assign-role','adminController@assign_role')->name('assign_role');
		Route::get('register-user','adminController@register')->name('register-user');
		Route::post('save-user','adminController@save_user')->name('save-user');
	});

});

Route::get('test', function() {
	$mang=[4,5,6];
	$payment = App\Models\Tbl_payment::destroy($mang);
	dd($payment);
});


/*end backend*/
