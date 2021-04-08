<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_order_detail extends Model
{
    use HasFactory;
    protected $table = "Tbl_order_detail";
     public function product()
    {
        return $this->belongsTo(Tbl_product::class,'product_id','id');
    }
}
