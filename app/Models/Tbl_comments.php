<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_comments extends Model
{
	protected $table = "tbl_comments";
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Tbl_product::class,'product_id','id');
    }
}
