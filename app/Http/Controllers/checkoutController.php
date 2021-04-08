<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\shippingRequest;
use App\Models\Tbl_category_product;
use App\Models\Tbl_brand;
use App\Models\Tbl_product;
use App\Models\Tbl_customer;
use App\Models\Tbl_shipping;
use App\Models\Tbl_payment;
use App\Models\Tbl_order;
use App\Models\Tbl_soical;
use App\Models\Tbl_soical_customer;
use App\Models\Tbl_coupon;
use Socialite; //sử dụng Socialite
use App\Models\Tbl_order_detail;
use App\Http\Requests\addCustomerRequest;
use Illuminate\Support\Facades\Hash;
use Cart;
use Validator;
use Session;
use App\Rules\captcha_rule;
use App\Models\Tbl_quanhuyen;
use App\Models\Tbl_tinhthanhpho;
use App\Models\Tbl_xaphuongthitran;
use App\Models\Tbl_feeship;
use PDF;
use Carbon\carbon;
class checkoutController extends Controller
{
	public function login_customer_google()
	{
		config(['services.google.redirect'=>env('GOOGLE_CLIENT_URL')]);
		return Socialite::driver('google')->redirect();
	}
	public function callback_customer_google(){	
		config(['services.google.redirect'=>env('GOOGLE_CLIENT_URL')]); 
		$users = Socialite::driver('google')->stateless()->user();
		$authUser = $this->findOrCreateCustomer($users,'google');
		if ($authUser) {
			$account_name = Tbl_customer::where('id',$authUser->user)->first();
			Session::put('name_customer',$account_name->name);
			Session::put('id_customer',$account_name->id);
		}elseif($customer_new)
		{
			$account_name = Tbl_customer::where('id',$authUser->user)->first();
			Session::put('name_customer',$account_name->name);
			Session::put('id_customer',$account_name->id);
		}
		if (Session::get('cart')) {
			return redirect()->route('view_checkout')->with('thongbao', 'Đăng nhập thành công');
		}
		return redirect()->route('trangchu');
	}
	public function findOrCreateCustomer($users,$provider)
	{
		$authUser = Tbl_soical_customer::where('provider_user_id', $users->id)->where('provider_user_email',$users->email)->first();
		if($authUser){
			return $authUser;
		}else{
			$customer_new = new Tbl_soical_customer([
				'provider_user_id'=>$users->id,
				'provider_user_email'=>$users->email,
				'provider'=>strtoupper($provider),
			]);
		}
		$customer = Tbl_customer::where('email',$users->email)->first();

		if(!$customer){
			$customer = Tbl_customer::create([
				'name' => $users->name,
				'email' => $users->email,
				'password' => '',
				'phone' => ''
			]);
		}
		$customer_new->customer()->associate($customer); /*lấy 2 id mới thêm vào*/
		$customer_new->save();
		return $customer_new;	
	}
	public function login_checkout()
	{
		$category_query = Tbl_category_product::query();
		$category_query->latest();
		$category = $category_query->where('status','=','1')->get();

		$brand_query = Tbl_brand::query();
		$brand_query->latest();
		$brand = $brand_query->where('status','=','1')->get();

		return view("pages.checkout.login_checkout",compact('category','brand'));
	}
	public function add_customer(addCustomerRequest $req)
	{
		$customer = new Tbl_customer;
		$customer->name = $req->input('name');
		$customer->email = $req->input('email');
		$customer->password = bcrypt($req->input('password'));
		$customer->phone = $req->input('phone');
		$customer->save();

		return redirect()->back()->with('thongbao','Bạn đã đăng ký thành công');

	}
	public function login_customer(Request $req)
	{
		$req->validate([
			"g-recaptcha-response" => new captcha_rule()

		]);
		$customer = new Tbl_customer;
		$email = $req->input('email');
		$password = $req->input('password');
		$kq = $customer->where('email',$email)->first();
		if (!$kq) {
			return redirect()->back()->with('thongbao_thatbai','Đăng nhập thất bại');
		}
		if (Hash::check($password, $kq->password)) {
			Session::put('name_customer',$kq->name);
			Session::put('id_customer',$kq->id);
			if (Session::get('cart')) {
				return redirect()->route('view_checkout');
			}
			return redirect()->route('trangchu');
		}
		return redirect()->back()->with('thongbao_thatbai','Đăng nhập thất bại');	
	}
	public function get_checkout()
	{
		$category_query = Tbl_category_product::query();
		$category_query->latest();
		$category = $category_query->where('status','=','1')->get();

		$brand_query = Tbl_brand::query();
		$brand_query->latest();
		$brand = $brand_query->where('status','=','1')->get();

		$city = Tbl_tinhthanhpho::orderby('matp','DESC')->get();

		return view("pages.checkout.checkout",compact('category','brand','city'));
	}
	public function logout_checkout(Request $req)
	{
		$req->session()->forget('name_customer');
		$req->session()->forget('id_customer');
		Session::flush();
		return redirect()->route('trangchu');
	}
	public function save_shipping(shippingRequest $req)
	{
		$coupon = Session::get('coupon_ss');
		$feeship = Session::get('fee');
		 $mytime = Carbon::now();
		$code_random = substr(md5(microtime()),rand(0,20),5);
		$soluong =0;

		if ($req->input('send_order')) {
			$shipping = new Tbl_shipping;
			$shipping->name = $req->input('name');
			$shipping->email = $req->input('email');
			$shipping->customer_id = Session::get('id_customer');
			$shipping->address = $req->input('address');
			$shipping->phone = $req->input('phone');
			$shipping->notes = $req->input('notes');
			$shipping->method = $req->input('payment_option');
			$shipping->status = 1; /*mặc định là đang xử lý*/
			$shipping->save();
			$shipping_id = $shipping->id;
			Session::put('id_shipping',$shipping_id);

			$cart = Session::get('cart');
			foreach ($cart as $value) {
				$soluong += $value['product_qty'];
			}
			$order = new Tbl_order;
			$order->customer_id = Session::get('id_customer');
			$order->shipping_id = $shipping_id;
			$order->total = Session::get('total');
			$order->status =1 ;/*mặc định là đang xử lý*/
			$order->order_code = $code_random;
			$order->quantity = $soluong;
			$order->order_date = $mytime->toDateString();
			$order->save();
			$order_id = $order->id;

			foreach ($cart as $value) {
				$order_detail = new Tbl_order_detail;
				$order_detail->order_id = $order_id;
				$order_detail->order_code = $code_random;
				$order_detail->product_id = $value['product_id'];
				$order_detail->soluong = $value['product_qty'];
				$order_detail->feeship = $feeship;
				if ($coupon) {
					$order_detail->coupon = $coupon[0]['coupon_code'];
				}
				$order_detail->save();
			}
			if ($req->input('payment_option')==1) {
				echo 'Thanh toán bằng thẻ ATM';
			}
			elseif($req->input('payment_option')==2) {
				return redirect()->route('thanh_cong');
			}
		}
		return redirect()->back();
		/*trả về trang payment*/
	}
	// public function payment()
	// {
	// 	$category_query = Tbl_category_product::query();
	// 	$category_query->latest();
	// 	$category = $category_query->where('status','=','1')->get();

	// 	$brand_query = Tbl_brand::query();
	// 	$brand_query->latest();
	// 	$brand = $brand_query->where('status','=','1')->get();

	// 	return view("pages.checkout.payment",compact('category','brand'));
	// }
	// public function order_place(Request $req)
	// {

	// }
	public function checkout_success(Request $req)
	{
		$category_query = Tbl_category_product::query();
		$category_query->latest();
		$category = $category_query->where('status','=','1')->get();

		$brand_query = Tbl_brand::query();
		$brand_query->latest();
		$brand = $brand_query->where('status','=','1')->get();
		$req->session()->forget('id_shipping');
		$req->session()->forget('cart');
		$req->session()->forget('subtotal');
		$req->session()->forget('fee');
		if (Session::get('coupon_ss')) {
			foreach (Session::get('coupon_ss') as $value) {
				$coupon = Tbl_coupon::where('code',$value['coupon_code'])->first();
				$coupon->soluong = $coupon->soluong-1;
				$coupon->save();
			}
		}
		$req->session()->forget('coupon_ss');

		return view('pages.checkout.payment_cash',compact('category','brand'));
	}
	/*order*/
	public function manage_order(Request $req)
	{
		$order_query = Tbl_order::query();
		$key = $req->search_order;
		$filter= $req->filter;
		if($key) {
			$customer = Tbl_customer::where('name','like',"%{$key}%")->first();
			$order_query->where('customer_id',$customer->id);
		}
		if ($filter==0) {
			$order_query->latest();
		}
		if ($filter==1) {
			$order_query->where('quantity','>','2');
		}
		if ($filter==2) {
			$order_query->where('status','=','1');
		}
		if ($filter==3) {
			$order_query->where('status','!=','1');
		}
		if ($req->delete_column&&$req->post==null) {
			return redirect()->back()->with('error','chưa hàng nào được chọn');
		}
		if ($req->delete_column&&$req->post!==null) {
			$order_id = $req->post;
			foreach ($order_id as $value) {
				$order_detail = Tbl_order::find($value);
				$order_detail->product()->detach();
			}
			$order = Tbl_order::destroy($order_id);

			return redirect()->back()->with('thongbao','Xóa thành công');
		}
		if ($req->date_1&&$req->date_2) {
			$order_query->whereBetween('order_date',[$req->date_1,$req->date_2]);
		}elseif ($req->date_1) {
			$order_query->where('order_date',$req->date_1);
		}elseif ($req->date_2) {
			$order_query->where('order_date',$req->date_2);
		}
		$order_query->latest();
		$order = $order_query->paginate(5);
		return view('admin.manage_order',compact('order'));
	}
	public function view_order($id)
	{
		$order = Tbl_order::find($id);
		$order_detail = $order->order_detail;
		foreach ($order_detail as $value) {
			$coupon_code = $value->coupon;
		}
		$coupon_value = Tbl_coupon::where('code',$coupon_code)->first();
		return view('admin.view_order',compact('order','order_detail','coupon_value'));
	}
	public function xoa_order($id)
	{
		$order = Tbl_order::find($id);
		$order_id = Tbl_order_detail::where('order_id',$id)->first();
		$order->delete();
		$order->product()->detach(); /*xóa đồng bộ*/
		return redirect()->back()->with('thongbao','Đã xóa đơn hàng');
	}
	public function print_order($order_id)
	{
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($order_id));
		return $pdf->stream();
	}
	public function print_order_convert($order_id)
	{
		$order = Tbl_order::find($order_id);
		$order_detail = $order->order_detail;
		foreach ($order_detail as $value) {
			$coupon_code = $value->coupon;
		}
		$coupon_value = Tbl_coupon::where('code',$coupon_code)->first();
		$output = '';
		$ouput ='
		<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		</head>
		<style>
		body{
			font-family:Dejavu Sans;
		}
		.table-styling,td,th
		{
			border: 1px solid black;
			text-align : center;
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		</style>
		<h2 class=""><center>Công ty trách nhiệm hữu hạn Nguyễn Trung Đức</center></h1>
		<h3 style="font-size:25px"><center>Độc lập - Tự Do - Hạnh Phúc</center></h3>
		<p><center>--------------------------------------</center></p>
		<h4 style="font-size:25px;"><center>Đơn hàng chi tiết</center></h4>
		<p>Time now: '.Carbon::now("Asia/Ho_Chi_Minh").'</p>
		<p>-Tài khoản đặt hàng</p>
		<table class="table-styling">
		<thead>
		<tr>
		<th>Tên khách đặt: </th>
		<th>Số điện thoại:</th>
		<th>Email:</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td>'.$order->customer->name.'</td>
		<td>'.$order->customer->phone.'</td>
		<td>'.$order->customer->email.'</td>
		</tr>
		</tbody>
		</table>

		<p>-Ship hàng tới</p>
		<table class="table-styling">
		<thead>
		<tr>
		<th>Tên người nhận: </th>
		<th>Địa chỉ:</th>
		<th>Số điện thoại:</th>
		<th>Email:</th>
		<th>Ghi chú:</th>
		<th>Hình thức thanh toán:</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td>'.$order->shipping->name.'</td>
		<td>'.$order->shipping->address.'</td>
		<td>'.$order->shipping->phone.'</td>
		<td>'.$order->shipping->email.'</td>
		<td>'.$order->shipping->notes.'</td>';
		if ($order->shipping->method==2) {
			$ouput.='<td>Thanh toán bằng tiền mặt</td>';    	
		}
		else{
			$ouput.='<td>Thanh toán bằng thẻ</td>'; 
		}

		$ouput .='</tr>
		</tbody>
		</table>';

		$ouput.='
		<p>-Liệt kê chi tiết đơn hàng</p>
		<table class="table-styling">
		<thead>
		<tr>
		<th>Tên sản phẩm: </th>
		<th>Mã giảm giá:</th>
		<th>Số lượng:</th>
		<th>Giá:</th>
		</tr>
		</thead>
		<tbody>';
		foreach ($order_detail as $value2)
		{
			$ouput.='
			<tr>
			<td>'.$value2->product->name.'</td>';
			if($value2->coupon==true)
			{
				$ouput.='
				<td>'.$value2->coupon.'</td>';
			}
			else
			{
				$ouput.='
				<td>"Không có mã giảm giá"</td>';
			}
			$ouput.='
			<td>'.$value2->soluong.'</td>
			<td>'.currency_format(($value2->product->price)*$value2->soluong).'</td>
			</tr>';
			$feeship = $value2->feeship;
		}   
		$ouput.='
		</tbody>
		</table>';


		$ouput.='<p>-Thành tiền</p>
		<table class="table-styling">
		<thead>
		<tr>
		<th>phiếu giảm giá: </th>
		<th>phí ship:</th>
		<th>Tổng tiền: </th>
		</tr>
		</thead>
		<tbody>
		<tr>';
		if ($coupon_value) {
			$ouput.='
			<td>'."-".$coupon_value->number_sale.'</td>';
		}
		else{
			$ouput.='
			<td>không có phiếu giảm giá</td>';
		}

		if ($feeship!=0) {
			$ouput.='
			<td>'.$feeship.'</td>';
		}
		else{
			$ouput.='
			<td>Không có phí ship</td>';
		}
		$ouput.='
		<td>'.currency_format($order->total).'</td>
		</tr>
		</tbody>
		</table>';
		$ouput.= '<a href ="'.route('view_order',$order_id).'">Quay lại admin</a>';
		return $ouput; /*phải return vì mình ko gọi trực tiếp vào hàm này*/
	}


	/*end order*/
	/*tính phí ship*/
	public function caculate_fee(Request $req)
	{
		if ($req->name_tp&&$req->name_qh&&$req->name_xp) {
			$feeship = Tbl_feeship::where('matp_id',$req->name_tp)->orWhere('maqh_id',$req->name_qh)->orWhere('xa_id',$req->name_xp)->first();
			if ($feeship) {
				Session::put('fee',$feeship->feeship);
			}
			else {
				Session::put('fee',15000);
			}
		}
		else {
			echo 'lỗi';
		}
	}


}

