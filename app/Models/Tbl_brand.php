<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_brand extends Model
{
	protected $table = "tbl_brand";
    use HasFactory;
    public function product()
    {
    	return $this->hasMany(Tbl_product::class,'brand_id','id');
    }
}
