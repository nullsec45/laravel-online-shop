<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DashboardProductRequest;

class DashboardProductController extends Controller
{
    public function index(){
       $data=[
            "products" => Product::with(["galleries","category"])
                                  ->where("users_id", Auth::user()->id)
                                  ->get()
       ];

        return view('pages.dashboard-products', $data);
    }

    public function show(string $id){
        $data=[
            'product' => Product::with(['galleries','user','category'])->findOrFail($id),
            'categories' =>  Category::all()
        ];

        return view('pages.dashboard-products-detail', $data);
    }

    public function create(){
        $data=[
            "categories" => Category::select()->get()
        ];

        return view('pages.dashboard-products-create', $data);
    }

    public function store(DashboardProductRequest $request){
       $data=$request->all();
       $data["slug"]=Str::slug($request->name);
       $data["users_id"]=Auth::user()->id;
       
       $product=Product::create($data);

       $file=$request->file("photo");
       $fileName=$this->helper->fileUploadHandling($file,"products","store",null);
       $gallery=[
            "products_id" => $product->id,
            "photos" => $fileName
       ];

       ProductGallery::create($gallery);
       return redirect()->route("dashboard.products.index");
    }

    public function update(DashboardProductRequest $request, $id){
        $data=$request->all();
        $users_id=Auth::user()->id;
        $data["slug"]=Str::slug($request->name);

        $product=Product::where("id",$id)->where("users_id", $users_id);

        $product->update($data);
   
        return redirect()->back();
    }


    public function uploadGallery(Request $request){
        $data=$request->all();

       $file=$request->file("photos");
       $fileName=$this->helper->fileUploadHandling($file,"photo_products","assets/products","store",null);

       $data["photos"]=$fileName;
       ProductGallery::create($data);

       return redirect()->back();
    }

    public function deleteGallery($id){
        $item=ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }

}
