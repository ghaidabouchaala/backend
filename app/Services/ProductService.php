<?php


namespace App\Services;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function getAll()
    {
        return Product::all();
    }
    public function addproduct(Request $request)
    {
        $product = new Product();
        $product->label = $request['label'];
        $product->description = $request['description'];
        $product->quantity = $request['quantity'];
        $product->price = $request['price'];
        $product->photo = $request['photo'];
        $product->save();
        return $product;
    }
    public function getproductLabel($label)
    {
        return Product::where('label','=',$label)
            ->first();
    }
    public function deleteProduct($id)
    {
        return Product::where('product_id','=',$id)->delete();
    }
}
