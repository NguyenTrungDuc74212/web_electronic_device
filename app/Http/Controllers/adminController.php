<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\addUserRequest;
use App\Models\Tbl_admin;
use App\Models\Tbl_order;
use App\Models\Tbl_customer;
use App\Models\Tbl_product;
use App\Models\Tbl_comments;
use App\Models\Tbl_visitors;
use App\Models\Tbl_roles;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use Session;
use Auth;
use App\Models\Tbl_soical;
use Socialite; //sử dụng Socialite
use Mail;
use Carbon\Carbon;



class adminController extends Controller
{	
    /*module quên mật khẩu*/
    public function view_forgot()
    {
        return view('forgot_password');
    }
    public function send_mail(Request $req)
    {
        $req->session()->forget('token');
        $user_reset = Tbl_admin::where('email',$req->email)->first();
        if ($user_reset) {
            $reset_password_token = md5(rand(0,30));
            $user = Tbl_admin::find($user_reset->id);
            $user->reset_password_token = $reset_password_token;
            $user->save();
            $data = [
                'subject' => "Reset password",
                'name' => "E-shopper",
                'email' => $req->email,
                'content' => "Vui lòng mời bạn truy cập link: http://myweb.local.com/Shopbanhanglaravel/reset-password/".$user->reset_password_token." "."để thay đổi password"
            ];

            Mail::send('pages.email-template', $data, function($message) use ($data) {
                $message->to($data['email'])
                ->subject($data['subject'])
                ->from('ductrungthug@gmail.com',$data['name']);  /*mail người gửi(mail của mình), tên người gửi(Tên của mình)*/
            });
            return redirect()->back()->with('thongbao','vui lòng check mail để thay đổi mật khẩu');
        }
        return redirect()->back()->with('error','Email không chính xác');

    }
    public function reset_password($reset_password_token)
    {
        $user_reset = Tbl_admin::where('reset_password_token',$reset_password_token)->first();
        if ($user_reset) {
            Session::put('token',$reset_password_token);
            return view('change_password');
        }
        return redirect()->route('login_view')->with('thongbao','Hacker à, ối dồi ôiii!!!');
    }
    public function change_password(changePasswordRequest $req)
    {
        $user_reset = Tbl_admin::where('email',$req->email)->where('reset_password_token',Session::get('token'))->first();
        if ($user_reset) {
            $user_reset->password = md5($req->password);
            $user_reset->save();
            return redirect()->route('login_view')->with('thongbao_2','Reset mật khẩu thành công');
        }
        return redirect()->back()->with('error','Email không tồn tại!!!');
    }
    /*end quên mật khẩu*/

    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user();
        $email_admin = Tbl_admin::where('email',$users->email)->first();
        if (Auth::attempt([
            'email'=>$email_admin->email,
            'password'=>$email_admin->password
        ])) {
            $authUser = $this->findOrCreateUser($users,'google');
            $account_name = Tbl_admin::where('email',$users->email)->first();
            return redirect('trangchu_admin')->with('thongbao', 'Đăng nhập Admin thành công');
        }
        return redirect()->route('login_view')->with('thongbao', 'tài khoản google chưa được đăng ký trên ứng dụng này');
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Tbl_soical::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }


        $duc = new Tbl_soical([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Tbl_admin::where('email',$users->email)->first();

// if(!$orang){
//     $orang = Tbl_admin::create([
//         'name' => $users->name,
//         'email' => $users->email,
//         'password' => '',
//         'phone' => '',
//         'status' => 1
//     ]);
// }
        $duc->Tbl_admin()->associate($orang);
        $duc->save();
        $account_name = Tbl_admin::where('id',$duc->user)->first();
        return redirect('trangchu_admin')->with('thongbao', 'Đăng nhập Admin thành công');
    }

    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->stateless()->user();
        $account = Tbl_soical::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
//login in vao trang quan tri  
            $account_name = Tbl_admin::where('id',$account->user)->first();
            Session::put('name',$account_name->name);
            Session::put('id',$account_name->id);
            return redirect('trangchu_admin')->with('thongbao', 'Đăng nhập Admin thành công');
        }else{

            $duc = new Tbl_soical([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Tbl_admin::where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Tbl_admin::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'status' => 1,
                    'phone'=>'',

                ]);
            }
            $duc->Tbl_admin()->associate($orang);
            $duc->save();

            $account_name = Tbl_admin::where('id',$account->user)->first();

            Session::put('name',$account_name->name);
            Session::put('id',$account_name->id);
            return redirect('trangchu_admin')->with('message', 'Đăng nhập Admin thành công');
        } 
    }

    public function index(Request $req)
    {
        $email = $req->cookie('email');
        $password = $req->cookie('password');
        if ($email) {
            return view('admin_login',compact('email','password'));
        }

        return view('admin_login');
    }
// public function Auth_login($req)
// {
//     $get_ss = $req->session()->has('id');
//     if ($get_ss) {
//         return redirect()->route('trangchuadmin');
//     }
//     else {
//         return redirect()->route('login_view')->send();
//     }
// }
    public function showadmin(Request $req)
    {
        $user_ip_add = $req->ip(); /*lấy ra ip hiện tại*/
        
        $today = Carbon::now()->toDateString();
        $startofMonth_ago = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $endofMonth_ago = Carbon::now()->subMonth()->endOfMonth()->toDateString();
        $thismonth = Carbon::now()->startOfMonth()->toDateString();
        $sub365days = Carbon::now()->subdays(365)->toDateString();

        $visitor_lastmonth = Tbl_visitors::whereBetween('date',[$startofMonth_ago,$endofMonth_ago])->get();
        $visitor_lastmonth_count =$visitor_lastmonth->count();

          $visitor_thismonth = Tbl_visitors::whereBetween('date',[$thismonth,$today])->get();
        $visitor_thismonth_count =$visitor_thismonth->count();
           
        $visitor_oneyear = Tbl_visitors::whereBetween('date',[$sub365days,$today])->get();
        $visitor_oneyear_count =$visitor_oneyear->count();

    //online
        $visitor_online =Tbl_visitors::where('ip_add',$user_ip_add)->get();
        $visitor_count_online = $visitor_online->count();

        if ($visitor_count_online<1) {
            $visitor = new Tbl_visitors();
            $visitor->ip_add = $user_ip_add;
            $visitor->date = Carbon::now()->toDateString();
            $visitor->save();
        }
    //total visitor
        $visitors = Tbl_visitors::all();
        $visitors_total = $visitors->count();

        $comment_count =Tbl_comments::where('status',1)->where('comment_parent',NULL)->get()->count();
        $order_count = Tbl_order::where('status',2)->get()->count();
        $product_count = Tbl_product::all()->count();
        $customer_count = Tbl_customer::all()->count();

        return view('admin.dashboard',compact('visitors_total','visitor_lastmonth_count','visitor_thismonth_count','visitor_oneyear_count','visitor_count_online','comment_count','order_count','product_count','customer_count'));
    }
    public function dashboard(Request $req)
    {

        $email = $req->input('email');
        $password = $req->input('password');

// $check = $req->input('check');
// if ($check=="on") {
//     $response = new Response;
//     $response->withCookie('email',$email,43000);
//     $response->withCookie('password',$password,43000);  
// }

        if (Auth::attempt([
            'email'=>$email,
            'password'=>$password,
        ])) {
            $mytime = Carbon::now();
            $admin = Tbl_admin::where('email',Auth::user()->email)->first();
            $admin->date_access = $mytime->toDateTimeString();
            $admin->save();
            return redirect('trangchu_admin')->with('thongbao','Đăng nhập thành công');
        }
        return redirect()->back()->with('thongbao','Mật khẩu hoặc tài khoản bị sai, làm ơn nhập lại');
    }
    public function logout(Request $req)
    {
        Auth::logout();
        return redirect()->route('login_view');
    }
    public function register()
    {
        return view('admin.register_user'); 
    }
    public function save_user(addUserRequest $req)
    {
        $admin =  new Tbl_admin;
        $admin->name = $req->input('name');
        $admin->phone = $req->input('phone');
        $admin->email = $req->input('email');
        $admin->password =md5($req->input('password'));
        $admin->save();
        return redirect()->route('list_user')->with('thongbao','Đăng ký thành công');
    }
    public function list_user()
    {
        $admin = Tbl_admin::with('roles')->orderby('id','DESC')->paginate(5);
        return view('admin.list_user',compact('admin'));
    }
    public function assign_role(Request $req)
    {
        $admin = Tbl_admin::where('email',$req->email)->first();
        $admin->roles()->detach();

        /*xóa user*/
        if ($req->xoa) {
            $admin->delete();
            return redirect()->back()->with('error','Xóa thành công');
        }
        /*end*/

        $author_role = Tbl_roles::where('name','author')->first();
        $admin_role = Tbl_roles::where('name','admin')->first();
        $user_role = Tbl_roles::where('name','user')->first();

        if ($req->admin) {
            $admin->roles()->attach($admin_role->id);
        }
        if ($req->author) {
            $admin->roles()->attach($author_role->id);
        }
        if ($req->user) {
            $admin->roles()->attach($user_role->id);
        }
        /*bắt lỗi không có admin*/
        $all = Tbl_admin::has('roles')->get();
        $pos='';
        foreach ($all as $value) {
            $admin_role = $value->roles()->where('name','admin')->first();
            $pos .= strpos($admin_role['name'], "admin");
        }
        if ($req->admin_role==null&&$pos=='') {
            $admin_per = Tbl_roles::where('name','admin')->first();
            $admin->roles()->attach($admin_per);
            return redirect()->back()->with('error','Phải có 1 admin để quản lý và điều hành, bạn không thể vào trang này mà không có người nào có quyền admin');
        }
        /*end bắt lỗi*/
        return redirect()->back()->with('thongbao','phân quyền thành công');

    }
}
