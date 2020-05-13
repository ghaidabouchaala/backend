<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table='admin';
    protected $primaryKey = 'admin_id';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ["password"];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;
}
