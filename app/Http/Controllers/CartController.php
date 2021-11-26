<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    private $carts;

    public function __construct()
    {
        $this->carts = new Cart;
    }

    public function index() {
        $cartsObj = $this->carts->cartProductModel();
        return response()->json($cartsObj); 
    }

    public function checkProductID() {
        $cartsObj = $this->carts->checkProductID($product_id = 5);

        dd(count($cartsObj));
        return response()->json($cartsObj); 
    }

    public function cartProductHistory() {
        $cartsObj = $this->carts->cartProductHistoryModel();
        return response()->json($cartsObj); 
    }

    public function store(Request $request) {
        $productIDExist = $this->carts->checkProductID($request->product_id);

        if(count($productIDExist) == 1) {
            return response()->json('Item Already Exist in the Cart');
        }
        else if(count($productIDExist) == 0) {
            $cart = new Cart([
                'product_id' => $request->product_id,
            ]);
            $cart->save();
    
            return response()->json('Added to Cart');
        }
    }

    public function update($id, Request $request)
    {
        $cart = Cart::find($id);
        $cart->update($request->all());

    }

    public function delete($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
  
        return response()->json('cart successfully deleted');
    }
}
