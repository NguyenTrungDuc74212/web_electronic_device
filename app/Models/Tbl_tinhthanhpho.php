<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_tinhthanhpho extends Model
{
    use HasFactory;
    protected $table = "tbl_tinhthanhpho";
    public function Tbl_quanhuyen()
    {
    	return $this->hasMany(Tbl_quanhuyen::class,'matp_id','matp');
    }
}
