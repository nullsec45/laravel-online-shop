<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){

        $transactions=TransactionDetail::with(["transaction.user","product.galleries"])
                                                ->whereHas("product", function($product){
                                                    $product->where("users_id", Auth::user()->id);
                                                });

        $customer=User::where("roles","USER")->count();

        $data=[
            "transaction_count" => $transactions->count(),
            "transaction_data" => $transactions->get(),
            "revenue" => $transactions->get()->reduce(function($carry, $item){
                return $carry+$item->price;
            }),
            "customer" => $customer
        ];

        return view('pages.dashboard', $data);
    }
}
