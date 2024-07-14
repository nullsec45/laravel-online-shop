<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data=[
            "categories" => [
                [
                    "name" => "Gadgets",
                    "icon" => "categories-gadgets.svg"
                ],
                [
                    "name" => "Furniture",
                    "icon" => "categories-furniture.svg"
                ],
                [
                    "name" => "Makeup",
                    "icon" => "categories-makeup.svg"
                ],
                [
                    "name" => "Sneaker",
                    "icon" => "categories-sneaker.svg"
                ],
                [
                    "name" => "Tools",
                    "icon" => "categories-tools.svg"
                ],
                [
                    "name" => "Baby",
                    "icon" => "categories-baby.svg"
                ]
            ],
            "products" => [
                [
                    "name" => "Apple Watch 4",
                    "price" => "890",
                    "icon" => "products-apple-watch.jpg"
                ],
                [
                    "name" => "Orange Bogotta",
                    "price" => "94,509",
                    "icon" => "products-orange-bogotta.jpg"
                ],
                [
                    "name" => "Sofa Ternyaman",
                    "price" => "1,409",
                    "icon" => "products-sofa-ternyaman.jpg"
                ],
                [
                    "name" => "Bubuk Maketti",
                    "price" => "225",
                    "icon" => "products-bubuk-maketti.jpg"
                ],
                [
                    "name" => "Tatakan Gelas",
                    "price" => "45,184",
                    "icon" => "products-tatakan-gelas.jpg"
                ],
                [
                    "name" => "Mavic Kawe",
                    "price" => "503",
                    "icon" => "products-mavic-kawe.jpg"
                ],
                [
                    "name" => "Black Edition Nike",
                    "price" => "70,402",
                    "icon" => "products-black-edition-nike.jpg"
                ],
                [
                    "name" => "Monkey Toys",
                    "price" => "783",
                    "icon" => "products-monkey-toys.jpg"
                ]
            ]
        ];

        return view('pages.home', $data);
    }
}
