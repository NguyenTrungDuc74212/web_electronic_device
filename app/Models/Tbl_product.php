<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_product extends Model
{
    use HasFactory;
    protected $table = "tbl_product";
    public function category()
    {
    	return $this->belongsTo(Tbl_category_product::class,'category_id','id');
    }
    public function brand()
    {
    	return $this->belongsTo(Tbl_brand::class,'brand_id','id');
    }
    public function order()
    {
        return $this->belongsToMany(Tbl_order::class,'tbl_order_detail','order_id','product_id');
    }
    public function order_detail()
    {
        return $this->belongsToMany(Tbl_order::class,'tbl_order_detail','order_id','product_id');
    }
    public function gallery()
    {
        return $this->hasMany(Tbl_gallery::class,'product_id','id');
    }
    public function comments()
    {
        return $this->hasMany(Tbl_comments::class,'product_id','id');
    }
}
