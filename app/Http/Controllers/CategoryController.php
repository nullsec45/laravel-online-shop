<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data=[
            "categories" => [
                [
                    "name" => "Gadgets",
                    "icon" => "categories-gadgets.svg",
                    "slug" => "gadgets"
                ],
                [
                    "name" => "Furniture",
                    "icon" => "categories-furniture.svg",
                    "slug" => "furniture"
                ],
                [
                    "name" => "Makeup",
                    "icon" => "categories-makeup.svg",
                    "slug" => "makeup"
                ],
                [
                    "name" => "Sneaker",
                    "icon" => "categories-sneaker.svg",
                    "slug" => "sneaker"
                ],
                [
                    "name" => "Tools",
                    "icon" => "categories-tools.svg",
                    "slug" => "tools"
                ],
                [
                    "name" => "Baby",
                    "icon" => "categories-baby.svg",
                    "slug" => "baby"
                ]
            ],
            "products" => [
                [
                    "name" => "Apple Watch 4",
                    "price" => "890",
                    "photo" => "products-apple-watch.jpg",
                    "slug" => "apple-watch-4"
                ],
                [
                    "name" => "Orange Bogotta",
                    "price" => "94,509",
                    "photo" => "products-orange-bogotta.jpg",
                    "slug" => "orange-boggota"
                ],
                [
                    "name" => "Sofa Ternyaman",
                    "price" => "1,409",
                    "photo" => "products-sofa-ternyaman.jpg",
                    "slug" => "sofa-ternyaman"
                ],
                [
                    "name" => "Bubuk Maketti",
                    "price" => "225",
                    "photo" => "products-bubuk-maketti.jpg",
                    "slug" => "bubuk-maketti"
                ],
                [
                    "name" => "Tatakan Gelas",
                    "price" => "45,184",
                    "photo" => "products-tatakan-gelas.jpg",
                    "slug" => "tatakan-gelas"
                ],
                [
                    "name" => "Mavic Kawe",
                    "price" => "503",
                    "photo" => "products-mavic-kawe.jpg",
                    "slug" => "mavic-kawe"
                ],
                [
                    "name" => "Black Edition Nike",
                    "price" => "70,402",
                    "photo" => "products-black-edition-nike.jpg",
                    "slug" => "black-edition-nike"
                ],
                [
                    "name" => "Monkey Toys",
                    "price" => "783",
                    "photo" => "products-monkey-toys.jpg",
                    "slug" => "monkey-toys"
                ]
            ]
        ];

        return view("pages.category", $data);
    }

    public function show(){
        return "oke";
    }
}
