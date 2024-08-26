<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSettingController extends Controller
{
    public function store(){
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
            ],
            "user" => [
                'store_name' => 'Toko Dummy',
                'categories_id' => 2,
                'store_status' => 1,
            ],
        ];

        return view('pages.dashboard-settings', $data);
    }

    public function account(){
        $data=[
            "user" => [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'address_one' => 'Jalan Mawar No. 10',
                'address_two' => 'Komplek Melati',
                'provinces_id' => 1,
                'regencies_id' => 1,
                'zip_code' => '12345',
                'country' => 'Indonesia',
                'phone_number' => '08123456789',
            ],
            "provinces" => [
                ['id' => 1, 'name' => 'Jawa Barat'],
                ['id' => 2, 'name' => 'Jawa Tengah'],
                ['id' => 3, 'name' => 'Jawa Timur'],
            ],
            "regencies" => [
                ['id' => 1, 'name' => 'Bandung'],
                ['id' => 2, 'name' => 'Semarang'],
                ['id' => 3, 'name' => 'Surabaya'],
            ]
        ];
        return view('pages.dashboard-account', $data);
    }

    public function redirect(){
        return "oke";
    }
}
