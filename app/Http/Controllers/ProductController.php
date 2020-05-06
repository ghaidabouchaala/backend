<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function addProduct(Request $request)
    {
        if(!$request->has('label','description','quantity','price','photo') ){
            return response()->json(['message'=>'missing field']);
        }
        $request->validate([
           'label'=>'required|string',
           'description'=>'required|string',
           'quantity'=>'required|integer',
           'price'=>'required|integer'
        ]);
        if($this->productService->getproductLabel($request->input('label')))
        {
            return response()->json(['message'=>'label already exists']);
        }
        $product= $this->productService->addproduct($request);
        return response()->json($product);
    }
}
