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
        $transaction=TransactionDetail::with(['transaction.user','product.galleries'])->findOrFail($id);

        $data = [
            "transaction" => $transaction,
        ];
        
        return view("pages.dashboard-transactions-details", $data);   
    }

    public function update(Request $request, string $id){
        $data=$request->all();

        $item=TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard.transactions.show', $id);
    }
}
