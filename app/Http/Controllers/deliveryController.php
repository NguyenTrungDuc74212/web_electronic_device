<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_quanhuyen;
use App\Models\Tbl_tinhthanhpho;
use App\Models\Tbl_xaphuongthitran;
use App\Models\Tbl_feeship;
class deliveryController extends Controller
{
	public function delete_delivery(Request $req)
	{
          $feeship = Tbl_feeship::find($req->id);
          $feeship->delete();
	}
	public function update_delivery(Request $req)
	{
		$old=$req->feeship;
		$phiship = Tbl_feeship::find($req->id);
		$phiship->feeship = $req->feeship;
		$phiship->save();		  

	}
	public function load_delivery()
	{
		$feeship = Tbl_feeship::orderby('id','DESC')->get();
		$result ='';
		foreach ($feeship as $value) {
			$result.='<tr>';
			$result .='<td>'.$value->Tbl_tinhthanhpho->name.'</td>' ;
			$result .='<td>'.$value->Tbl_quanhuyen->name.'</td>' ;
			$result .='<td>'.$value->Tbl_xaphuongthitran->name.'</td>';
			$result .='<td contenteditable data-id="'.$value->id.'" class="feeship_edit" name="feeship">'.currency_format($value->feeship).'</td>';
			$result .='<td class="text-center"><a data-href="'.$value->id.'" class="xoa-delivery" style="cursor:pointer;"><i class="fa fa-times text-danger"></i></a></td>';
			$result.='</tr>'; 
		}
		echo $result;
	}
	public function delivery()
	{
		$city = Tbl_tinhthanhpho::orderby('matp','DESC')->get();
		return view('admin.add_delivery',compact('city'));
	}
	public function insert_delivery(Request $req)
	{
		$fee_ship = new Tbl_feeship;
		$fee_ship->matp_id = $req->name_tp;
		$fee_ship->maqh_id = $req->name_qh;
		$fee_ship->xa_id = $req->name_xp;
		$fee_ship->feeship = $req->feeship;
		$fee_ship->save();
	}
	public function select_delivery(Request $req)
	{
		$city = Tbl_tinhthanhpho::where('matp',$req->name_tp)->first();
		$quanhuyen = Tbl_quanhuyen::where('maqh',$req->name_qh)->first();
		$result ='';
		if ($req->choose=="thanhpho") {
			$quanhuyen = $city->Tbl_quanhuyen;
			foreach ($quanhuyen as $value) {
				$result.= '<option value='.$value->maqh.'>'.$value->name.'</option>';
				
			}
			echo $result;

		}
		elseif($req->choose=="quanhuyen")
		{
			$xaphuongthitran = $quanhuyen->Tbl_xaphuongthitran;
			foreach ($xaphuongthitran as $value) {
				$result .= '<option value='.$value->xaid.'>'.$value->name.'</option>';
			}
			echo $result;
		}
	}
	public function select_delivery_home(Request $req)
	{
		$city = Tbl_tinhthanhpho::where('matp',$req->name_tp)->first();
		$quanhuyen = Tbl_quanhuyen::where('maqh',$req->name_qh)->first();
		$result ='';
		if ($req->choose=="thanhpho") {
			$quanhuyen = $city->Tbl_quanhuyen;
			foreach ($quanhuyen as $value) {
				$result.= '<option value='.$value->maqh.'>'.$value->name.'</option>';
				
			}
			echo $result;
		}
		elseif($req->choose=="quanhuyen")
		{
			$xaphuongthitran = $quanhuyen->Tbl_xaphuongthitran;
			foreach ($xaphuongthitran as $value) {
				$result .= '<option value='.$value->xaid.'>'.$value->name.'</option>';
			}
			echo $result;
		}
	}
}
