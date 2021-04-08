<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_category_product;
use App\Models\Tbl_brand;
use App\Models\Tbl_product;
use App\Models\Tbl_coupon;
use Cart;
use Session;

class cartController extends Controller
{
  public function check_coupon(Request $req)
  {
   $coupon = Tbl_coupon::where('code',$req->coupon)->first();
   if ($coupon) {
    if ($coupon->soluong>0) {
      $coupon_ss = Session::get('coupon_ss');
      if ($coupon_ss==true) {
       $coupon_array[] = array(
        'coupon_code'=>$coupon->code,
        'coupon_tinhnang'=>$coupon->tinhnang,
        'coupon_value'=>$coupon->number_sale
      );
       Session::put('coupon_ss',$coupon_array);
     }
     else {
       $coupon_array[] = array(
        'coupon_code'=>$coupon->code,
        'coupon_tinhnang'=>$coupon->tinhnang,
        'coupon_value'=>$coupon->number_sale
      );
       Session::put('coupon_ss',$coupon_array);
     }
     Session::save();
     return redirect()->back()->with('thongbao','Nhập mã giảm giá thành công');

   }
   else{
      $req->session()->forget('coupon_ss');
      return redirect()->back()->with('error','Mã giảm giá đã hết');
   }
 }
 else {
  $req->session()->forget('coupon_ss');
  return redirect()->back()->with('error','Mã giảm giá không tồn tại');
}
}
public function gio_hang(Request $req)
{
  $req->session()->flash('trangthai', 2);
  $category_query = Tbl_category_product::query();
  $category_query->latest();
  $category = $category_query->where('status','=','1')->get();

  $brand_query = Tbl_brand::query();
  $brand_query->latest();
  $brand = $brand_query->where('status','=','1')->get();

  return view("pages.cart.cart_ajax",compact('category','brand'));
}
public function update_cart_ajax(Request $req)
{
  $data = $req->all();
  $cart = Session::get('cart');
  if ($cart==true) {
   foreach ($cart as $key=> $value) {
    if ($value['quantity_storage']>$data['quantity']) {
       if ($value['session_id']==$data['capnhat']) {
      $cart[$key]=array(
       'session_id' =>$value['session_id'],
       'product_id' =>$value['product_id'],
       'product_name'=>$value['product_name'],
       'product_image'=>$value['product_image'],
       'product_price'=>$value['product_price'],
       'quantity_storage'=>$value['quantity_storage'],
       'product_qty'=>$data['quantity'],
     );
    }
    }
    else {
     return response()->json(['error' => 'error', 'product' =>$req->cart_product_name ]);
    }
    
  }
}
Session::put('cart',$cart);
}
public function delete_cart_ajax(Request $req)
{
 $data = $req->all();
 $cart = Session::get('cart');
 if ($cart==true) {
   foreach ($cart as $key=> $value) {
     if ($value['session_id']==$data['session_id']) {
       unset($cart[$key]);
     }
   }
 }
 Session::put('cart',$cart);
}
public function add_cart_ajax(Request $req)
{
        // $req->session()->flush();
 $data = $req->all(); /*mảng product trả về*/
 $session_id = substr(md5(microtime()), rand(0,26),5); /*tạo ra chuỗi ngẫu nhiên có 5 số*/
 $cart = Session::get('cart');
 if ($cart==true) {
  $is_avaiable = 0;
  foreach ($cart as $key=> $value) {
   if ($value['product_id']==$data['cart_product_id']) {
    $is_avaiable ++;
    $cart[$key] = array(
      'session_id' =>$value['session_id'],
      'product_id' =>$value['product_id'],
      'product_name'=>$value['product_name'],
      'product_image'=>$value['product_image'],
      'product_price'=>$value['product_price'],
      'product_qty'=>$value['product_qty']+1,
      'quantity_storage'=>$data['quantity_storage'],
    );
    Session::put('cart',$cart);
  }
}
if ($is_avaiable==0) {
  $cart[] = array(
    'session_id' =>$session_id,
    'product_id' =>$data['cart_product_id'],
    'product_name'=>$data['cart_product_name'],
    'product_image'=>$data['cart_product_image'],
    'product_price'=>$data['cart_product_price'],
    'product_qty'=>($data['cart_product_qty']),
    'quantity_storage'=>$data['quantity_storage'],
  );
  Session::put('cart',$cart);
}
}
else {
 $cart[] = array(
  'session_id' =>$session_id,
  'product_id' =>$data['cart_product_id'],
  'product_name'=>$data['cart_product_name'],
  'product_image'=>$data['cart_product_image'],
  'product_price'=>$data['cart_product_price'],
  'product_qty'=> ($data['cart_product_qty']),
    'quantity_storage'=>$data['quantity_storage'],
);
 Session::put('cart',$cart);
}

}






public function save_cart(Request $req)
{
 $product_id = $req->input('product_id');
 $soluong = $req->input('soluong');

 $product = Tbl_product::find($product_id);

 $array = array("image"=>$product->image);
 Cart::add($product_id,$product->name,$soluong,$product->price,0,$array);
		// Cart::destroy();
 return redirect()->route('giohang');
}
public function show_cart(Request $req)
{
  $req->session()->flash('trangthai', 2);
  $category_query = Tbl_category_product::query();
  $category_query->latest();
  $category = $category_query->where('status','=','1')->get();

  $brand_query = Tbl_brand::query();
  $brand_query->latest();
  $brand = $brand_query->where('status','=','1')->get();

  return view("pages.cart.show_cart",compact('category','brand'));
}
public function delete_cart($rowid)
{
  Cart::update($rowid,0); /*xét giá trị soluong = 0 => không tồn tại*/
  return redirect()->back()->with('thongbao','Đã bỏ sảm phẩm ra khỏi giỏ hàng');
}
public function update_cart(Request $req)
{
 $rowid= $req->input('rowId_cart');
 $soluong = $req->input('quantity');
 Cart::update($rowid,$soluong);
 return redirect()->back()->with('thongbao','Đã cập nhật số lượng');
}
}
