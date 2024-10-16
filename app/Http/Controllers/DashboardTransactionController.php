<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index(){
        $sellTransactions=TransactionDetail::with(["transaction.user","product.galleries"])
                                                ->whereHas("product", function($product){
                                                    $product->where("users_id", Auth::user()->id);
                                                })->get();


        $buyTransactions=TransactionDetail::with(["transaction.user","product.galleries"])
                                                ->whereHas("transaction", function($transaction){
                                                    $transaction->where("users_id", Auth::user()->id);
                                                })->get();
        
        $data=[
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
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
