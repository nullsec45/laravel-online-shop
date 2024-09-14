<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function ShowProduct(Request $request, string $slug){
        $product=Product::with(["galleries","user"])->where("slug",$slug)->firstOrFail();
        
        return view("pages.detail", compact("product"));
    }
}
