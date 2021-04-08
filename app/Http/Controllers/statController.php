<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_statistical;
use Carbon\Carbon;

class statController extends Controller
{
	public function filter_date(Request $req)
	{
		$result = $req->all();
		$from_date = $result['fromDate'];
		$to_date = $result['toDate'];
		$data = Tbl_statistical::whereBetween('order_date',[$from_date,$to_date])->get();
		$chart_data =[];
		foreach ($data as $value) {
			$chart_data[] = array(
				'period' =>$value->order_date,
				'order' =>$value->total_order,
				'sales' =>$value->sales,
				'profit' =>$value->profit,
				'quantity' =>$value->quantity,
			);
		}
		echo $result = json_encode($chart_data);
	}
	public function order_filter(Request $req)
	{
		$today = Carbon::now()->toDateString();
		$tomorow = Carbon::now()->addDay()->toDateString();

		$startofMonth = Carbon::now()->startOfMonth()->toDateString();
		$startofMonth_ago = Carbon::now()->subMonth()->startOfMonth()->toDateString();
		$endofMonth_ago = Carbon::now()->subMonth()->endOfMonth()->toDateString();

		$sub7days = Carbon::now()->subdays(7)->toDateString();
		$sub365days = Carbon::now()->subdays(365)->toDateString();

		if ($req->filterValue == "1tuan") {
			$data = Tbl_statistical::whereBetween('order_date',[$sub7days,$today])->orderBy('order_date','DESC')->get();
		}
		elseif($req->filterValue=="thangtruoc"){
			$data = Tbl_statistical::whereBetween('order_date',[$startofMonth_ago,$endofMonth_ago])->orderBy('order_date','DESC')->get();
		}elseif($req->filterValue=="thangnay"){
			$data = Tbl_statistical::whereBetween('order_date',[$startofMonth,$today])->orderBy('order_date','DESC')->get();
		}else{
			$data = Tbl_statistical::whereBetween('order_date',[$sub365days,$today])->orderBy('order_date','DESC')->get();
		}
		$chart_data =[];
		foreach ($data as $value) {
			$chart_data[] = array(
				'period' =>$value->order_date,
				'order' =>$value->total_order,
				'sales' =>$value->sales,
				'profit' =>$value->profit,
				'quantity' =>$value->quantity,
			);
		}
		echo $result = json_encode($chart_data);
	}
	public function order_30_day()
	{
		$tomorow = Carbon::now()->addDay()->toDateString();
		$today = Carbon::now()->toDateString();
		$sub30days = Carbon::now()->subdays(30)->toDateString();
		$data = Tbl_statistical::whereBetween('order_date',[$sub30days,$tomorow])->orderBy('order_date','DESC')->get();
		$chart_data =[];
		foreach ($data as $value) {
			$chart_data[] = array(
				'period' =>$value->order_date,
				'order' =>$value->total_order,
				'sales' =>$value->sales,
				'profit' =>$value->profit,
				'quantity' =>$value->quantity,
			);
		}
		echo $result = json_encode($chart_data);
	}
}
