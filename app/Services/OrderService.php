<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderService
{
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function buyProduct($product_id, $quantity, $user_id){
        $order = new Order();
        $order->user_id = $user_id;
        $order->product_id = $product_id;
        $order->quantity = $quantity;
        $order->save();
    }


}
