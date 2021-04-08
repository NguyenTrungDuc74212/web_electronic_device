<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_gallery extends Model
{
    use HasFactory;
    protected $table ="tbl_gallery";

    public function product()
    {
    	return $this->belongsTo(Tbl_product::class,'product_id','id');
    }
}
