<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $fillable = ['label', 'description', 'quantity', 'price', 'photo'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;
}
