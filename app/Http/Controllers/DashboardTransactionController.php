<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    public function index(){
        $data=[
            "sellTransactions" => [
                [
                    'id' => 1,
                    'product' => [
                        'name' => 'Produk 1',
                        'galleries' => [
                            ['photos' => 'produk1.jpg']
                        ],
                        'user' => [
                            'store_name' => 'Toko A'
                        ],
                    ],
                    'created_at' => '2024-08-01',
                ],
                [
                    'id' => 2,
                    'product' => [
                        'name' => 'Produk 2',
                        'galleries' => [
                            ['photos' => 'produk2.jpg']
                        ],
                        'user' => [
                            'store_name' => 'Toko B'
                        ],
                    ],
                    'created_at' => '2024-07-28',
                ],
                [
                    'id' => 3,
                    'product' => [
                        'name' => 'Produk 3',
                        'galleries' => [
                            ['photos' => 'produk3.jpg']
                        ],
                        'user' => [
                            'store_name' => 'Toko C'
                        ],
                    ],
                    'created_at' => '2024-07-15',
                ],
            ],
            "buyTransactions" =>  [
                [
                    'id' => 1,
                    'product' => [
                        'name' => 'Produk A',
                        'galleries' => [
                            ['photos' => 'produk_a.jpg']
                        ],
                        'user' => [
                            'store_name' => 'Toko X'
                        ],
                    ],
                    'created_at' => '2024-08-01',
                ],
                [
                    'id' => 2,
                    'product' => [
                        'name' => 'Produk B',
                        'galleries' => [
                            ['photos' => 'produk_b.jpg']
                        ],
                        'user' => [
                            'store_name' => 'Toko Y'
                        ],
                    ],
                    'created_at' => '2024-07-28',
                ],
                [
                    'id' => 3,
                    'product' => [
                        'name' => 'Produk C',
                        'galleries' => [
                            ['photos' => 'produk_c.jpg']
                        ],
                        'user' => [
                            'store_name' => 'Toko Z'
                        ],
                    ],
                    'created_at' => '2024-07-15',
                ],
            ]
        ];
        
        return view("pages.dashboard-transactions", $data);
    }

    public function show(string $id){
        $data = [
            "transaction" => [
                'id' => 1,
                'code' => 'TRX123456',
                'product' => [
                    'name' => 'Produk A',
                    'galleries' => [
                        ['photos' => 'produk_a.jpg']
                    ],
                ],
                'transaction' => [
                    'user' => [
                        'name' => 'Budi Santoso',
                        'phone_number' => '08123456789',
                        'address_one' => 'Jalan Mawar No. 10',
                        'address_two' => 'Komplek Melati',
                        'provinces_id' => 1,
                        'regencies_id' => 1,
                        'zip_code' => '12345',
                        'country' => 'Indonesia',
                    ],
                    'transaction_status' => 'PENDING',
                    'total_price' => 150000,
                ],
                'created_at' => '2024-08-01',
            ]    
        ];
        
        return view("pages.dashboard-transactions-details", $data);   
    }

    public function update(string $id){
        
    }
}
