<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data=[
            "categories" => Category::take(6)->get(),
            "products" => Product::with("galleries")->paginate(10)
        ];

        return view("pages.category", $data);
    }

   public function create(){}
    
    public function store(){}
    
    public function show(string $slug){

        $categories=Category::all();
        $category_id=Category::where("slug", $slug)->firstOrFail()->id;
        $products=Product::with("galleries")->where("categories_id", $category_id)->paginate(10);

        $data=[
            "categories" => $categories,
            "products" => $products
        ];

        return view("pages.category", $data);
    }

    public function edit(){}

    public function update(){}

    public function delete(){}
}
