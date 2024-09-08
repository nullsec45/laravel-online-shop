<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,Category};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories=Category::take(6)->get();
        $products=Product::with("galleries")->take(8)->get();


        $data=[
            "categories" => $categories,
            "products" => $products
        ];

        // $data2=[
        //     "products" => $products
        // ];
        
        return view('pages.home', $data);
    }
}
