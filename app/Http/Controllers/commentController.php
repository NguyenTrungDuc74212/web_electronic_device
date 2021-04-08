<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_product;
use App\Models\Tbl_comments;
use App\Models\Tbl_Admin;

class commentController extends Controller
{
    public function load_comment(Request $req)
    {
    	$product_id = $req->comment_product_id;
        $comments = Tbl_comments::where('product_id',$product_id)->where('status',1)->where('comment_parent',NULL)->paginate(4);
        $comment_parent = Tbl_comments::orderBy('id','DESC')->get();
        return view('pages.sanpham.comments',compact('comments','product_id','comment_parent'));
		
    }
    public function send_comment(Request $req)
    {
    	$comment = new Tbl_comments();
    	$comment->comment = $req->comment_content;
    	$comment->name = $req->comment_name;
    	$comment->product_id = $req->comment_product_id;
    	$comment->admin_id = 0;
    	$comment->save();
    }
    public function list_comments()
    {
    	$comments = Tbl_comments::orderBy('id','DESC')->where('comment_parent',NULL)->get();
    	$comment_parent = Tbl_comments::orderBy('id','DESC')->get();
    	$admin = Tbl_admin::all();
 
    	return view('admin.comments.list_comments',compact('comments','comment_parent','admin'));
    }
    public function allow_comment(Request $req)
    {
        $comments = Tbl_comments::find($req->comment_id);
        if ($req->comment_status==0) {
        	 $comments->status = 1;
        	 $comments->save();
        	 echo '1';
        }
        else{
        	$comments->status = 0;
        	 $comments->save();
        	 echo '2';
        }
        
    }
    public function reply_comment(Request $req)
    {
    	$comments_parent =  new Tbl_comments();
    	$comments_parent->comment = $req->rep_comment;
    	$comments_parent->name = "Admin";
    	$comments_parent->status = 1;
    	$comments_parent->product_id = $req->product_id;
    	$comments_parent->comment_parent = $req->comment_id;
    	$comments_parent->admin_id = $req->admin_id;
    	$comments_parent->save(); 
    }
    public function edit_comment(Request $req)
    {
        $comment = Tbl_comments::find($req->comment_id);
        $comment->comment = $req->comment_value;
        $comment->save();
    }
    public function delete_comment($id)
    {
    	 $comment = Tbl_comments::find($id);
    	 $comment_parent = Tbl_comments::where('comment_parent',$id)->get();
    	 $comment->delete();

    	 foreach ($comment_parent as $value) {
    	 	$value->delete();
    	 }
    	
    	 return redirect()->back()->with('thongbao','Xóa thành công comment');

    }
}
