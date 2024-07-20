<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $data = [
            "carts" => [
                "product" => [
                    [
                        "id" => "P0001",
                        "name" => "Apple Watch 4",
                        "price" => 890,
                        "photo" => "products-apple-watch.jpg",
                        "slug" => "apple-watch-4",
                        "user" => [
                            "store_name" => "Fajar Store"
                        ],
                    ],
                    [
                        "id" => "P0002",
                        "name" => "Orange Bogotta",
                        "price" => 94509,
                        "photo" => "products-orange-bogotta.jpg",
                        "slug" => "orange-boggota",
                        "user" => [
                            "store_name" => "Keysa Store"
                        ],
                    ],
                    
                ]
            ]
        ];

        return view("pages.cart", $data);
    }

    public function success(){
        return view("pages.success");
    }
}
