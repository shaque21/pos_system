<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'user_roles';
    protected $fillable = ['role_id','role_name','role_status'];

    public function user(){
        return $this->belongsTo('App\Models\User','role_id','role_id');
    }
}
