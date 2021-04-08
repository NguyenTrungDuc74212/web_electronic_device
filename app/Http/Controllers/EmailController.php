<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_category_product;
use App\Models\Tbl_brand;
use App\Models\Tbl_product;
use App\Models\Tbl_customer;
use App\Models\Tbl_coupon;
use Mail;
use Carbon\carbon;

class EmailController extends Controller
{
	public function create()
	{
		$category_query = Tbl_category_product::query();
		$category_query->latest();
		$category = $category_query->where('status','=','1')->get();

		$brand_query = Tbl_brand::query();
		$brand_query->latest();
		$brand = $brand_query->where('status','=','1')->get();
		return view('pages.send_mail',compact('category','brand'));
	}
	public function sendEmail(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'subject' => 'required',
			'name' => 'required',
			'content' => 'required',
		]);

		$data = [
			'subject' => $request->subject,
			'name' => $request->name,
			'email' => $request->email,
			'content' => $request->content
		];

		Mail::send('pages.email-template', $data, function($message) use ($data,$request) {
			$message->to($data['email'])
			->subject($data['subject'])
			->from('ductrungthug@gmail.com',$request->name);  /*mail người gửi(mail của mình), tên người gửi(Tên của mình)*/
		});


		return redirect()->back()->with(['message' => 'Gửi mail thành công!']);
	}
	public function send_coupon(Request $req)
	{
		 $coupon = Tbl_coupon::where('id',$req->coupon)->where('soluong','>',0)->first();
		  if (!$coupon) {
         	return redirect()->back()->with('error','Mã giảm giá không có hoặc đã hết');
         }
         $customer = Tbl_customer::all();
         $mytime = Carbon::now();
         $title_mail = "Mã khuyến mãi ngày".' '.$mytime->toDateTimeString();
         $data = [];
         foreach ($customer as $value) {
         	$data['email'][] = $value->email;
         }
         $data['coupon_name'] = $coupon->name;
         $data['coupon_code'] = $coupon->code;
        
         Mail::send('pages.send_email_coupon', $data, function($message) use ($data,$title_mail) {
			$message->to($data['email'])
			->subject($title_mail)
			->from($data['email'],$title_mail);  /*mail người gửi(mail của mình), tên người gửi(Tên của mình)*/
		});
      return redirect()->back()->with('thongbao','Gửi mã khuyến mãi thành công');

	}
}
