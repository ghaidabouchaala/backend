<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table= 'order';
    protected $primaryKey= 'order_id';
    protected $fillable=['user_id', 'product_id', 'quantity'];

    function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'product_id');
    }
    function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id','user_id');
    }
}
