<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Tbl_admin extends Authenticatable
{
	use HasFactory;
	protected $table ="tbl_admin";
	protected $fillable = [
		'name',  'email',  'password','phone','status'
	];
	public function roles()
	{
		return $this->belongsToMany(Tbl_roles::class,'admin_roles','admin_id','role_id');
	}
	public function hasRole($role)
	{
		return null !== $this->roles()->where('name',$role)->first();
	} 
}
