<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $carts=Cart::with(["product.galleries","user"])->where("users_id", Auth::user()->id)->get();
        if($carts->isEmpty()){
            return redirect()->route("home");
        }

        return view("pages.cart", ["carts" => $carts]);
    }

    public function add(string $id){
        $data=[
            "products_id" => $id,
            "users_id" => Auth::user()->id
        ];

        Cart::create($data);

        return redirect()->route("cart");
    }
    public function success(){
        return view("pages.success");
    }

    public function delete(string $id){
        $cart=Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route("cart");
    }
}
