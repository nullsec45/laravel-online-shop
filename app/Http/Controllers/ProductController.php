<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(){
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
            "product" => [
                    "name" => "Apple Watch 4",
                    "price" => "890",
                    "photo" => "products-apple-watch.jpg",
                    "slug" => "apple-watch-4",
                    "description" => "
                        erat malesuada non. Suspendisse pellentesque arcu lectus, nec rhoncus velit aliquet sed. 
                        Cras aliquet tellus sed risus facilisis, vitae blandit mi dictum. Nam eu velit at diam tempor fringilla a ac arcu. 
                        Pellentesque velit justo, dapibus ac mollis vitae, lobortis ut sem. Quisque ut vulputate magna, non mollis purus. 
                        Maecenas ipsum odio, elementum ut pharetra vitae, egestas convallis libero. Sed nulla eros, scelerisque in nunc et, vulputate condimentum dui. 
                        Donec finibus vestibulum justo, fringilla dictum erat viverra quis. 
                        Suspendisse dignissim finibus elementum. Nam vel maximus dolor, in placerat leo. 
                        Etiam mollis justo ut erat consequat fringilla. Aenean lacinia sapien blandit rhoncus eleifend. 
                        Vestibulum pharetra quam mattis urna luctus congue. Aliquam eget arcu id lacus scelerisque placerat vitae at tortor.

                        Integer dictum maximus est eget iaculis. Donec faucibus turpis vitae nulla ultrices aliquam. 
                        Ut auctor quis dui et accumsan. Donec ac ante nec quam pretium dapibus. 
                        Vivamus consectetur, velit malesuada lacinia feugiat, turpis turpis faucibus augue, tempus ullamcorper dui massa eu nisi. 
                        Nam id convallis erat, eu viverra libero. Etiam et dui aliquet, mattis ex nec, aliquet ligula. 
                        Duis tempor nisl nulla, sit amet porttitor nibh accumsan et. Vestibulum non facilisis sem. 
                        Praesent lacus purus, accumsan sit amet nisl sed, sollicitudin tempus nunc. 
                        Morbi ullamcorper euismod ex. Morbi placerat magna quis felis cursus ultrices. 
                    ",
                    "user" => [
                        "store_name" => "Fajar Store"
                    ],
                    "image-detail" => [
                        [
                            "id" => 1,
                            "url" => "images/product-details-1.jpg"
                        ],
                        [
                            "id" => 2,
                            "url" => "images/product-details-2.jpg"
                        ],
                        [
                            "id" => 3,
                            "url" => "images/product-details-3.jpg"
                        ]
                    ]
               
            ]

        ];

        return view("pages.detail", $data);
    }

    public function apiProvinces(){

    }

    public function apiRgencies(){
        
    }
}
