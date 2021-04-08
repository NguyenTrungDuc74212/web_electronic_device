<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_shipping extends Model
{
	protected $table = "tbl_shipping";
    use HasFactory;

    public function customer()
    {
    	return $this->belongsTo(Tbl_customer::class,'customer_id','id');
    }
}
