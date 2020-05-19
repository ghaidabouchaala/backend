<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class OrderController extends Controller
{

    protected $orderService;
    private $userService;
    private $productService;

    public function __construct(OrderService $orderService, UserService $userService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function buy($product_id, Request $request)
    {
        if(!$user = $this->userService->retrieveUserFromToken())
        {
            return response() ->json(['msg'=>' bad request '],400);
        }

        $quantity = $request->input('quantity');

        if(!$test = $this->productService->updateQuantity($product_id,$quantity))
        {
            return response() ->json(['msg'=>' bad request 2'],400);
        }
         $this->orderService->buyProduct($product_id, $quantity, $user->user_id);
        return response() ->json(['msg'=>' success '],200);
    }

}


