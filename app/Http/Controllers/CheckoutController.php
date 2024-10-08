<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Midtrans\Snap;
use Midtrans\Config;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function proccess(Request $request){
        $user=Auth::user();
        $user->update($request->except("total_price"));

        $code="STORE-".mt_rand(0000,99999);
        $carts=Cart::with(["product","user"])
                    ->where("users_id", Auth::user()->id)
                    ->get();

        $transaction=Transaction::create([
            "users_id" => Auth::user()->id,
            "insurance_price" => 0,
            "shipping_price" => 0,
            "total_price" => $request->total_price,
            "transaction_status" => "PENDING",
            "code" => $code 
        ]);

        foreach($carts as $cart){
            $trx="TRX-".mt_rand(0000,99999);

            TransactionDetail::create(
                [
                    "transactions_id" => $transaction->id,
                    "products_id" => $cart->product->id,
                    "price" => $cart->product->price,
                    "shipping_status" => "PENDING",
                    "resi" => "",
                    "code" => $trx
                ]
            );
        }

        Config::$serverKey=config("services.midtrans.serverKey");
        Config::$isProduction=config("services.midtrans.isProduction");
        Config::$isSanitized=config("services.midtrans.isSanitized");
        Config::$is3ds=config("services.midtrans.is3ds");
      
        $midtrans=[
            "transaction_details" => [
                "order_id" => $code,
                "gross_amount" => (int) $request->total_price
            ],
            "customer_details" => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email
            ],
            "enabled_payments" => [
                "gopay","permata_va","bank_transfer"
            ],
            "vtweb" => []
        ];

        try{
            $paymentUrl=Snap::createTransaction($midtrans)->redirect_url;

            Cart::where("users_id", Auth::user()->id)->delete();
            
            return redirect($paymentUrl);
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function callback(Request $request){

    }
}
