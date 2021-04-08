<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_feeship extends Model
{
    use HasFactory;
    protected $table ="tbl_feeship";
    public function Tbl_tinhthanhpho()
    {
    	return $this->belongsTo(Tbl_tinhthanhpho::class,"matp_id","matp");
    }
    public function Tbl_quanhuyen()
    {
    	return $this->belongsTo(Tbl_quanhuyen::class,"maqh_id","maqh");
    }
    public function Tbl_xaphuongthitran()
    {
    	return $this->belongsTo(Tbl_xaphuongthitran::class,"xa_id","xaid");
    }
}
