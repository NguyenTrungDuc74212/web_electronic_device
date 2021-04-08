<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_coupon;
use App\Models\Tbl_admin;
use App\Http\Requests\addCouponRequest;
use Gate;
class couponController extends Controller
{
    public function insert_coupon()
    {
    	return view("admin.addCoupon");
    }
    public function save_coupon(addCouponRequest $req)
    {

          $coupon = new Tbl_coupon;
          $coupon->name = $req->input('name');
          $coupon->code = $req->input('code');
          $coupon->soluong = $req->input('soluong');
          $coupon->tinhnang = $req->input('tinhnang');
          $coupon->number_sale = $req->input('number_sale');
          $coupon->save();
          return redirect()->route('list_coupon')->with('thongbao','Thêm mã giảm giá thành công');
    }
    public function list_coupon()
    {
    	$coupon_query = Tbl_coupon::query();
    	$coupon_query->latest();
    	$coupon = $coupon_query->get();
      return view("admin.listCoupon",compact('coupon'));
    }
    public function delete_coupon($id)
    {
      $coupon = Tbl_coupon::find($id);
      $coupon->delete();
       return redirect()->route('list_coupon')->with('thongbao','Xóa mã giảm giá thành công');
    }
}
