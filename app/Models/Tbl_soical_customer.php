<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_soical_customer extends Model
{
    use HasFactory;
    protected $table ="tbl_soical_customer";
	public $timestamps = false;
	protected $fillable = [
		'provider_user_id',  'provider',  'user','provider_user_email'
	];
	public function customer()
	{
		return $this->belongsTo(Tbl_customer::class,'user','id');
	}
}
