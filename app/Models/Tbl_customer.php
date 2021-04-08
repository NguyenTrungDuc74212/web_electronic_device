<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_customer extends Model
{
    use HasFactory;
    protected $table = "tbl_customer";
    public function shipping()
    {
        return $this->hasMany(Tbl_shipping::class,'customer_id','id');
    }
}
