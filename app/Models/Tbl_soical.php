<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_soical extends Model
{
	use HasFactory;
	protected $table ="tbl_soical";
	public $timestamps = false;
	protected $fillable = [
		'provider_user_id',  'provider',  'user'
	];

	public function Tbl_admin()
	{
		return $this->belongsTo(Tbl_admin::class,'user','id');
	}
	public function Tbl_customer()
	{
		return $this->belongsTo(Tbl_customer::class,'user','id');
	}

	
}
