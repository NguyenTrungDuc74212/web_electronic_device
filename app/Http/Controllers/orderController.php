<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_product;
use App\Models\Tbl_order;
use App\Models\Tbl_order_detail;
use App\Models\Tbl_statistical;
use Carbon\carbon;

class orderController extends Controller
{
	public function update_order_status(Request $req)
	{
		$order = Tbl_order::find($req->order_id);
		$order->status = $req->order_status;
		$order->save();
        
        //order_date
        $order_date = $order->order_date;
        $sta = Tbl_statistical::where('order_date',$order_date)->get();
        if ($sta) {
        	$sta_count =$sta->count();
        }
        else {
        	$sta_count = 0;
        }
 

		/*trường hợp đã giao hàng thành công*/
		if ($order->status==2) {
			$total_order = 0;
			$sales = 0;
			$profit = 0;
			$quantity = 0;

			foreach ($req->order_product_id as $key => $product_id) {
				$product = Tbl_product::find($product_id);
				$product_quantity = $product->quantity; /*số lượng tổng sản phẩm trong kho*/
				$product_sold = $product->product_sold;
                
                //lấy giá sản phẩm và date hiện tại
				$product_price = $product->price; 
				$now = Carbon::now()->toDateString();

				foreach ($req->quantity as $key2 => $qty) {
					if ($key==$key2) {
						//update số lượng đã bán
						$product->quantity = $product_quantity-$qty;
						$product->product_sold =$product->product_sold+$qty; 
						$product->save(); 

						//update doanh thu
						$quantity += $qty;
						$total_order +=1;
						$sales += $product_price*$qty;
						$profit = $sales - 1000000; 

					}
				}
			}
			if ($sta_count>0) {
				$sta_update = Tbl_statistical::where('order_date',$order_date)->first();
				$sta_update->sales = $sta_update->sales + $sales;
				$sta_update->profit = $sta_update->profit + $profit;
				$sta_update->quantity = $sta_update->quantity + $quantity;
				$sta_update->total_order = $sta_update->total_order + $total_order;
				$sta_update->save();
				
			}
			else {
				$sta_new = new  Tbl_statistical();
				$sta_new->sales = $sales;
				$sta_new->order_date = $order_date;
				$sta_new->profit = $profit;
				$sta_new->quantity = $quantity;
				$sta_new->total_order = $total_order;
				$sta_new->save();
			}
      

		} 
		/*end giao hàng thành công*/ 
	}
	public function update_order_qty(Request $req)
	{
		/*cập nhật về giá*/
		$all_quantity = $req->all_quantity;
		$all_price = $req->all_price;
		$all_fee = $req->all_fee;
		$total_price =0;
		foreach ($all_quantity as $key=> $quantity) {
			foreach ($all_price as $key2=>$price) {
				if ($key==$key2) {
					$total_price +=$quantity*$price;
				}
			}
		}
		$total =$total_price+$all_fee;
		/*end cập nhật giá*/


		$order_detail = Tbl_order_detail::where('product_id',$req->order_product_id)->where('order_id',$req->order_id)->first();
		$order_detail->soluong = $req->order_quantity;
		$order_detail->save();

		$order = Tbl_order::find($req->order_id);
		$order->total = $total;
		$order->save();

	}

}
