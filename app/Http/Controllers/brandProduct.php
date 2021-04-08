<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\addBrandRequest;
use App\Http\Requests\editBrandRequest;
use App\Models\Tbl_brand;
use App\Models\Tbl_product;
use App\Models\Tbl_category_product;
class brandProduct extends Controller
{
	public function listBrand()
	{
		$brand_query = Tbl_brand::query();
		$brand_query->latest();
		$brand = $brand_query->paginate(5);
		return view('admin.listBrand_product',compact('brand'));
	}
	public function addBrand()
	{
		return view('admin.addBrand_product');
	}
	public function saveBrand(addBrandRequest $req)
	{
		$table = new Tbl_brand;
		$table->name = $req->input('name');
		$table->mota = $req->input('mota');
		$table->status = $req->input('status');
		$table->meta_title = $req->input('meta_title');
		$table->meta_keywords = $req->input('meta_keywords');
		event(new \App\Events\CreateSlug($table));
		$table->save();
		return redirect()->route('list_brand')->with('thongbao','Thêm thành công');
	}
	public function anBrand($id)
	{
		$brand = Tbl_brand::find($id);
		$brand->status = 0;
		$brand->save();
		return redirect()->back()->with('thongbao','kích hoạt thương hiệu sản phẩm thành công');

	}
	public function hienBrand($id)
	{
		$brand = Tbl_brand::find($id);
		$brand->status = 1;
		$brand->save();
		return redirect()->back()->with('thongbao','kích hoạt thương hiệu sản phẩm thành công');
	}
	public function editBrand($id)
	{
		$brand = Tbl_brand::find($id);
		return view('admin.editBrand_product',compact('brand'));
	}
	public function updateBrand(editBrandRequest $req,$id)
	{
		$brand = Tbl_brand::find($id);
		$brand->name = $req->input('name');
		$brand->mota = $req->input('mota');
		$brand->status = $req->input('status');
		$brand->meta_title = $req->input('meta_title');
		$brand->meta_keywords = $req->input('meta_keywords');
		$brand->save();
		event(new \App\Events\CreateSlug($brand));
		return redirect()->route('list_brand')->with('thongbao','Sửa thành công');

	}
	public function deleteBrand($id)
	{
		$brand = Tbl_brand::find($id);
		$brand->delete();
		return redirect()->back()->with('thongbao','Xóa thành công');
	}
	public function show_brand_home($slug)
	{
		$category_query = Tbl_category_product::query();
		$category_query->latest();
		$category = $category_query->where('status','=','1')->get();

		$brand_query = Tbl_brand::query();
		$brand_query->latest();
		$brand = $brand_query->where('status','=','1')->get();

		$brand_id = Tbl_brand::where('slug',$slug)->first();
		$product = Tbl_product::where('brand_id',$brand_id->id)->paginate(6);

		$brand_name = Tbl_brand::where('slug',$slug)->first();
		return view("pages.brand.show_brand",compact('product','category','brand','brand_name','brand_id'));
	}

}
