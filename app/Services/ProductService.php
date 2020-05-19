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
    public function addproduct(Request $request, $product)
    {

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

    public function getProductById($product_id){
        return Product::where('product_id','=',$product_id)->first();
    }
    public function updateQuantity($product_id,$quantity){
       $product = Product::where('product_id', '=', $product_id)->first();
        if($quantity > $product->quantity)
        {
            return false;
        }else {
            $product->quantity = $product->quantity - $quantity;
            $product->update();
            return true;
        }
    }
}
