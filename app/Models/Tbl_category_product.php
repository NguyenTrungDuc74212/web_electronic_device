<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_category_product extends Model
{
    use HasFactory;
    protected $table = "tbl_category_product";
    public function product()
    {
    	return $this->hasMany(Tbl_product::class,'category_id','id');
    }
}
