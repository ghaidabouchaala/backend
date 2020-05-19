<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $userService;

    public function __construct(ProductService $productService, UserService $userService)
    {
        $this->productService = $productService;
        $this->userService = $userService;

    }

    public function addProduct(Request $request)
    {
        if(!$product = $this->productService->getProductById($request->input('product_id')))
        {
            if($this->productService->getproductLabel($request->input('label')))
            {
                return response()->json(['message'=>'label already exists'],400);
            }
            $request->validate([
                'label'=>'required|string',
                'description'=>'required|string',
                'quantity'=>'required|integer',
                'price'=>'required|integer'
            ]);

            $product = new Product();
        }
        if(!$request->has('label','description','quantity','price','photo') ){
            return response()->json(['message'=>'missing field'],400);
        }

        $product= $this->productService->addproduct($request,$product);
        return response()->json($product);
    }
    public function getAllProducts()
    {

        return $this->productService->getAll();
    }
    public function deleteProductById($product_id)
    {
        if(!$product = $this->productService->getProductById($product_id) ){
            return response()->json(['message'=>'product not found'],404);
        }
         $this->productService->deleteProduct($product_id);
        return response()->json(['message'=>'product deleted'],200);
    }
    public function getProductById($product_id)
    {
        if(!$product =  $this->productService->getProductById($product_id))
        {
            return response()->json(['message'=>'product not found'],404);
        }
        return response()->json($product,200);
    }

}
