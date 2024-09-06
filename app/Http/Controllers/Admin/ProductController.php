<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $query=Product::with(["user","category"]);

            return DataTables::of($query)->addColumn("actions", function($item){
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                            Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('admin.products.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('admin.products.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                        </div>
                    </div>
                ';
            })->rawColumns(["actions"])
              ->make(true);

        }

        return view("pages.admin.products.index");
    }

    public function create(){
        $data=[
            "users" => User::all(),
            "categories" => Category::all()
        ];

        return view("pages.admin.products.create", $data);
    }
    
    public function store(ProductRequest $request){
        $data=$request->all();
        $data["slug"]=Str::slug($request->name);
   
        Product::create($data);

        return redirect()->route("admin.products.index");
    }
    
    public function show(){}

    public function edit($id){
        $product=Product::findorFail($id);

        $data=[
            "product" => $product,
              "users" => User::all(),
            "categories" => Category::all()
        ];

        return view("pages.admin.products.edit", $data);
    }

    public function update(ProductRequest $request, $id){
        $data=$request->all();
        $data["slug"]=Str::slug($request->name);

        $product=Product::findorFail($id);

        $product->update($data);
   
        return redirect()->route("admin.products.index");
    }

    public function destroy($id){
        $product=Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route("admin.products.index");
    }
}
