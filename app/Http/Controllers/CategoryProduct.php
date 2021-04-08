<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\addCategoryRequest;
use App\Http\Requests\editCategoryRequest;
use App\Models\Tbl_category_product;
use App\Models\Tbl_product;
use App\Models\Tbl_brand;

class CategoryProduct extends Controller
{
	/*admin page*/
	public function listCategory()
	{

		$category_query = Tbl_category_product::query();
		$category_query->latest();
		$category = $category_query->paginate(5);
		return view('admin.listCategory_product',compact('category'));
	}
	public function addCategory()
	{
		return view('admin.addCategory_product');
	}
	public function saveCategory(addCategoryRequest $req)
	{
		$table = new Tbl_category_product;
		$table->name = $req->input('name');
		$table->mota = $req->input('mota');
		$table->meta_title = $req->input('meta_title');
		$table->meta_desc = $req->input('meta_desc');
		$table->meta_keywords = $req->input('meta_keywords');
		$table->status = $req->input('status');
		$table->save();
		event(new \App\Events\CreateSlug($table));
		return redirect('listCategory')->with('thongbao','Thêm thành công');
	}
	public function anCategory($id)
	{
		$category = Tbl_category_product::find($id);
		$category->status = 0;
		$category->save();
		return redirect()->back()->with('thongbao','kích hoạt danh mục sản phẩm thành công');

	}
	public function hienCategory($id)
	{
		$category = Tbl_category_product::find($id);
		$category->status = 1;
		$category->save();
		return redirect()->back()->with('thongbao','kích hoạt danh mục sản phẩm thành công');
	}
	public function editCategory($id)
	{
		$category = Tbl_category_product::find($id);
		return view('admin.editCategory_product',compact('category'));
	}
	public function updateCategory(editCategoryRequest $req,$id)
	{
		$category = Tbl_category_product::find($id);
		$category->name = $req->input('name');
		$category->mota = $req->input('mota');
		$category->meta_title = $req->input('meta_title');
		$category->meta_desc = $req->input('meta_desc');
		$category->meta_keywords = $req->input('meta_keywords');
		$category->status = $req->input('status');
		$category->save();
		event(new \App\Events\CreateSlug($category));
		return redirect('listCategory')->with('thongbao','Sửa thành công');

	}
	public function deleteCategory($id)
	{
		$category = Tbl_category_product::find($id);
		$category->delete();
		return redirect()->back()->with('thongbao','Xóa thành công');
	}
	/*end function admin page*/
	public function show_category_home($slug,Request $req)
	{
		$req->session()->flash('trangthai', 3);

		$category_query = Tbl_category_product::query();
		$category_query->latest();
		$category = $category_query->where('status','=','1')->get();

		$brand_query = Tbl_brand::query();
		$brand_query->latest();
		$brand = $brand_query->where('status','=','1')->get();

		$category_id = Tbl_category_product::where('slug',$slug)->first();
		$product = Tbl_product::where('category_id',$category_id->id)->paginate(6);

		$category_name = Tbl_category_product::where('slug',$slug)->first();
		return view("pages.category.show_category",compact('product','category','brand','category_name'));
	}

}
