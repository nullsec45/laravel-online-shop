<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    public function index(){
       $data=[
            "products" => [
                [
                    'id' => 1,
                    'name' => 'Product A',
                    'category' => ['name' => 'Category A'],
                    'galleries' => [['photos' => 'images/product-details-1.jpg']],
                ],
                [
                    'id' => 2,
                    'name' => 'Product B',
                    'category' => ['name' => 'Category B'],
                    'galleries' => [['photos' => 'images/product-details-2.jpg']],
                ],
                [
                    'id' => 3,
                    'name' => 'Product C',
                    'category' => ['name' => 'Category C'],
                    'galleries' => [['photos' => 'images/product-details-3.jpg']],
                ],
                [
                    'id' => 4,
                    'name' => 'Product D',
                    'category' => ['name' => 'Category D'],
                    'galleries' => [['photos' => 'images/product-details-4.jpg']],
                ]
            ]
       ];

        return view('pages.dashboard-products', $data);
    }

    public function show(string $id){
        $data=[
            'product' =>  [
                'id' => 1,
                'name' => 'Produk Dummy',
                'price' => 150000,
                'categories_id' => 1,
                'category' => ['name' => 'Kategori Dummy'],
                'description' => 'Ini adalah deskripsi dummy untuk produk dummy.',
                'galleries' => [
                    ['id' => 1, 'photos' => 'product-details-1.jpg'],
                    ['id' => 2, 'photos' => 'product-details-2.jpg'],
                    ['id' => 3, 'photos' => 'product-details-3.jpg'],
                ]
            ],
            'categories' =>  [
                ['id' => 1, 'name' => 'Kategori Dummy'],
                ['id' => 2, 'name' => 'Kategori 2'],
                ['id' => 3, 'name' => 'Kategori 3'],
            ]
        ];

        return view('pages.dashboard-products-detail', $data);
    }

    public function create(){
        $data=[
            "categories" => [
                [
                    "id" => "C1",
                    "name" => "Gadgets",
                    "icon" => "categories-gadgets.svg",
                    "slug" => "gadgets"
                ],
                [
                    "id" => "C2",
                    "name" => "Furniture",
                    "icon" => "categories-furniture.svg",
                    "slug" => "furniture"
                ],
                [
                    "id" => "C3",
                    "name" => "Makeup",
                    "icon" => "categories-makeup.svg",
                    "slug" => "makeup"
                ],
                [
                    "id" => "C4",
                    "name" => "Sneaker",
                    "icon" => "categories-sneaker.svg",
                    "slug" => "sneaker"
                ],
                [
                    "id" => "C5",
                    "name" => "Tools",
                    "icon" => "categories-tools.svg",
                    "slug" => "tools"
                ],
                [
                    "id" => "C6",
                    "name" => "Baby",
                    "icon" => "categories-baby.svg",
                    "slug" => "baby"
                ]
            ]
        ];

        return view('pages.dashboard-products-create', $data);
    }

    public function store(){
        return 'Oke';
    }

    public function update(){
        return "update";
    }


}
