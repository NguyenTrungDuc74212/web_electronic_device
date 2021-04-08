<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_roles extends Model
{
    use HasFactory;
    public function admin()
    {
         return $this->belongsToMany(Tbl_admin::class,'admin_roles','role_id','admin_id');
    }
}
