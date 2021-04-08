<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_category_product;
use App\Models\Tbl_brand;
use App\Models\Tbl_product;
use App\Models\Tbl_gallery;
use App\Http\Requests\addProductRequest;
use App\Http\Requests\editProductRequest;

class ProductController extends Controller
{
	public function listProduct()
	{	
		$product_query = Tbl_product::query();
		$product_query->latest();
		$product = $product_query->get();
		return view('admin.listProduct',compact('product'));
	}
	public function addProduct()
	{
		$category = Tbl_category_product::all();
		$brand = Tbl_brand::all();
		return view('admin.addProduct',compact('category','brand'));
	}
	public function saveProduct(addProductRequest $req)
	{
		$table = new Tbl_product;
		$table->name = $req->input('name');
		$table->category_id = $req->input('category_id');
		$table->brand_id = $req->input('brand_id');
		$table->description = $req->input('description');
		$table->content = $req->input('content');
		$table->price = $req->input('price');
		$table->quantity = $req->input('quantity');
		$table->status = $req->input('status');

		/*xử lý imgae*/
		$file = $req->file('image');
		$name_offical = $file->getClientOriginalName();
		$name_jpg = explode(".", $name_offical);
		$file_name =$name_jpg[0].rand(0,99).".".$file->getClientOriginalExtension();
		$url = $file->move('public/upload/product',$file_name);
		$table->image = $file_name;
		/**/
		$table->save();
		event(new \App\Events\CreateSlug($table));
		return redirect()->route('list_product')->with('thongbao','Thêm thành công');
	}
	public function anProduct($id)
	{
		$product = Tbl_product::find($id);
		$product->status = 0;
		$product->save();
		return redirect()->back()->with('thongbao','kích hoạt sản phẩm thành công');

	}
	public function hienProduct($id)
	{
		$product = Tbl_product::find($id);
		$product->status = 1;
		$product->save();
		return redirect()->back()->with('thongbao','kích hoạt sản phẩm thành công');
	}
	public function editProduct($id)
	{
		$product = Tbl_product::find($id);
		$category = Tbl_category_product::all();
		$brand = Tbl_brand::all();
		return view('admin.editProduct',compact('product','category','brand'));
	}
	public function updateProduct(editProductRequest $req,$id)
	{
		$table = Tbl_product::find($id);
		$table->name = $req->input('name');
		$table->category_id = $req->input('category_id');
		$table->brand_id = $req->input('brand_id');
		$table->description = $req->input('description');
		$table->content = $req->input('content');
		$table->quantity = $req->input('quantity');
		$table->price = $req->input('price');
		$table->status = $req->input('status');

		/*xử lý imgae*/
		$file = $req->file('image');
		if ($file) 
		{
			$name_offical = $file->getClientOriginalName();
			$name_jpg = explode(".", $name_offical);
			$file_name =$name_jpg[0].rand(0,99).".".$file->getClientOriginalExtension();
			$file->move('public/upload/product',$file_name);
			$table->image = $file_name;
		}
		else {
			$table->image = $req->input('img_old');
		}
		
		/**/
		$table->save();
		event(new \App\Events\CreateSlug($table));
		return redirect()->route('list_product')->with('thongbao','Sửa thành công');

	}
	public function deleteProduct($id)
	{
		$product = Tbl_product::find($id);
		$link_anh ='public/upload/product/'.$product->image;
		if ($link_anh) {
			unlink('public/upload/product/'.$product->image);
		}
		$product->delete();
		return redirect()->back()->with('thongbao','Xóa thành công');
	}
	/*end admin_page*/

	//home page
	public function detail_product($slug)
	{
		$category_query = Tbl_category_product::query();
		$category_query->latest();
		$category = $category_query->where('status','=','1')->get();

		$brand_query = Tbl_brand::query();
		$brand_query->latest();
		$brand = $brand_query->where('status','=','1')->get();

		$product = Tbl_product::where('slug',$slug)->first();
		$category_id = Tbl_category_product::find($product->category_id);
		$product_relate = Tbl_product::where('category_id',$category_id->id)->inRandomOrder()->limit(3)->get();

		$gallery = Tbl_gallery::where('product_id',$product->id)->get();
		return view('pages.sanpham.show_detail',compact('category','brand','product','product_relate','gallery'));
	}

	/*xử lý thêm nhiều ảnh*/
	public function add_gallery($id)
	{
		$product_id = $id;
		$product = Tbl_product::find($id);
		$product_name = $product->name;
		return view('admin.gallery.add_gallery',compact('product_id','product_name'));
	}
	public function select_gallery(Request $req)
	{
		$product_id =  $req->product_id;
		$gallery = Tbl_gallery::where('product_id',$product_id)->get();
		$data = '';
		$data .= '<table class="table table-hover">
		<thead>
		<tr>
		<th>Tên hình ảnh</th>
		<th>Hình ảnh</th>
		<th>Thao tác</th>
		</tr>
		</thead>
		 <tbody>';
		$data.='<form>';
		$data.=''.csrf_field().'';
		foreach ($gallery as $value) {
			
		    $data .='<tr>
                        <td contenteditable class="edit_gallery_name" data-gallery_id="'.$value->id.'">'.$value->name.'</td>
                        <td><img src="'.asset('public/upload/gallery/'.$value->image).'" alt="" style="width:30%;">
                          <input type="file" class="file_name" style="width:40%" name="file" data-image_id="'.$value->id.'" id="file_name_'.$value->id.'">
                        </td>

                        <td><button data-id="'.$value->id.'" class="btn btn-xs btn-danger delete-image">Xóa</button></td>
                    </tr>';
                
		}
		    $data.='</form>';
		$data.='</tbody>';
		$data.='</table>';
		echo $data;


	}
	public function insert_gallery(Request $req,$product_id)
	{
         $image = $req->file('image');
         if ($image) {
         	foreach ($image as $value) {
            $name_offical = $value->getClientOriginalName();
			$name_jpg = explode(".", $name_offical);
			$file_name =$name_jpg[0].rand(0,99).".".$value->getClientOriginalExtension();
			$value->move('public/upload/gallery',$file_name);
			$gallery = new Tbl_gallery();
			$gallery->name = $file_name;
			$gallery->image =$file_name;
			$gallery->product_id =$product_id;
			$gallery->save();
         }
         }
          return redirect()->back()->with('thongbao','Thêm thư viện ảnh thành công');

         
	}
	public function update_gallery(Request $req)
	{
            $gallery = Tbl_gallery::find($req->gallery_id);
			$gallery->name = $req->gallery_text;
			$gallery->save();
	}
	public function delete_gallery(Request $req)
	{
		$gallery = Tbl_gallery::find($req->gallery_id);
		$gallery->delete();
		unlink('public/upload/gallery/'.$gallery->name);
	}
	public function update_image(Request $req)
	{
       $file_image = $req->file('file');
       $id_image =$req->image_id;
        if ($file_image) {
            $name_offical = $file_image->getClientOriginalName();
			$name_jpg = explode(".", $name_offical);
			$file_name =$name_jpg[0].rand(0,99).".".$file_image->getClientOriginalExtension();
			$file_image->move('public/upload/gallery',$file_name);
			$gallery = Tbl_gallery::find($id_image);
			unlink('public/upload/gallery/'.$gallery->image);
			$gallery->image =$file_name;
			$gallery->save();

         }
   

	}
	/*end xử lý thêm nhiều ảnh*/

}
