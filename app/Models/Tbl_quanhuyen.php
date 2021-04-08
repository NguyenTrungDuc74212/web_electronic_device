<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_quanhuyen extends Model
{
    use HasFactory;
    protected $table = "tbl_quanhuyen";
    public function Tbl_xaphuongthitran()
    {
    	return $this->hasMany(Tbl_xaphuongthitran::class,'maqh_id','maqh');
    }
}
