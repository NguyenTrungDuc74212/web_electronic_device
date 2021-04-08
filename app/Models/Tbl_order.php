<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tbl_order extends Model
{
    use HasFactory;
    protected $table = "Tbl_order";
    public function customer()
    {
    	return $this->belongsTo(Tbl_customer::class,'customer_id','id');
    }
    public function shipping()
    {
    	return $this->belongsTo(Tbl_shipping::class,'shipping_id','id');
    }
    public function payment()
    {
    	return $this->belongsTo(Tbl_payment::class,'payment_id','id');
    }
    public function order_detail()
    {
        return $this->hasMany(Tbl_order_detail::class,'order_id','id');
    }
    public function product() /*bảng chung*/
    {
        return $this->belongsToMany(Tbl_product::class,'tbl_order_detail','order_id','product_id');
    }
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
