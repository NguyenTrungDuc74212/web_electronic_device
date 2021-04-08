<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_category_product;
use App\Models\Tbl_brand;
use App\Models\Tbl_product;

class homeController extends Controller
{

    public function index(Request $req)
    {
        $req->session()->flash('trangthai', 1);
        $key = $req->input('key');

        $category_query = Tbl_category_product::query();
        $category_query->latest();
        $category = $category_query->where('status','=','1')->get();

        $brand_query = Tbl_brand::query();
        $brand_query->latest();
        $brand = $brand_query->where('status','=','1')->get();

        $product_query = Tbl_product::query();
        $product_query->latest();
        $product = $product_query->where('status','=','1')->limit(6)->get();
        if ($key) {
           $product_query->where('name','like',"%{$key}%");
           $product = $product_query->paginate(6);
           return view('pages.sanpham.search',compact('category','brand','product'));
       }
       if ($req->key2==10000000) {
        $value = (int)$req->key2;
        $product_query->where('price','<',$value);
        $product = $product_query->paginate(6);
        return view('pages.sanpham.search',compact('category','brand','product'));
    }
    elseif($req->key2==30000000)
    {
        $value = (int)$req->key2;
        $product_query->where('price','<',$value);
        $product = $product_query->paginate(6);
        return view('pages.sanpham.search',compact('category','brand','product'));
    }
    elseif($req->key2==40000000)
    {
        $value = (int)$req->key2;
        $product_query->where('price','>',$value);
        $product = $product_query->paginate(6);
        return view('pages.sanpham.search',compact('category','brand','product'));
    }

    return view('pages.home',compact('category','brand','product'));
}
public function auto_search(Request $req)
{
    if ($req->data) {
        $key = $req->data;
        $product = Tbl_product::where('status',1)->where('name','like',"%{$key}%")->get();
        $output = '<ul class="dropdown-menu" style="display: block;position:relative;left:-150px">';
         foreach ($product as $value) {
             $output.='<li class="value_search"><a href="">'.$value->name.'</a></li>';
         }
         $output.='</ul>';
         echo $output;
    }
}

}
