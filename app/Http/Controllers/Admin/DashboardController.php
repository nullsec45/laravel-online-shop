<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data=[
            "page" => "admin",
            "transaction_data" => [
                [
                    'id' => 1,
                    'product' => [
                        'name' => 'Produk A',
                        'galleries' => [
                            ['photos' => 'images/product-card-1.png']
                        ]
                    ],
                    'user' => [
                        'name' => 'Pengguna A'
                    ],
                    'created_at' => '2023-07-28'
                ],
                [
                    'id' => 2,
                    'product' => [
                        'name' => 'Produk B',
                        'galleries' => [
                            ['photos' => 'images/product-card-2.png']
                        ]
                    ],
                    'user' => [
                        'name' => 'Pengguna B'
                    ],
                    'created_at' => '2023-07-29'
                ]
            ]
        ];
  
        return view('pages.admin.dashboard', $data);
    }
}