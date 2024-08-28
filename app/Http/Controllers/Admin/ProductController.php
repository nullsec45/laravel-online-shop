<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
                                    <a class="dropdown-item" href="' . route('admin.categories.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('admin.categories.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                        </div>
                    </div>
                ';
            })->editColumn("photo",function($item){
                return $item->photo ? '<img src="'.$item->photo.'" style="max-height:40px;" />' : '';
            })->rawColumns(["actions","photo"])
            ->make(true);

        }

        return view("pages.admin.products.index");
    }

    public function create(){
        return view("pages.admin.products.create");
    }
    
    public function store(ProductRequest $request){
        $data=$request->all();
        $data["slug"]=Str::slug($request->name);
        $file=$request->file("photo");
        $fileName=$this->helper->fileUploadHandling($file, "category","assets/products","store");
        $data["photo"]=$fileName;
   
        Product::create($data);
        return redirect()->route("admin.products.index");
    }
    
    public function show(){}

    public function edit($id){
        $category=Product::findorFail($id);

        $data=[
            "category" => $category
        ];

        return view("pages.admin.products.edit", $data);
    }

    public function update(ProductRequest $request, $id){
        $data=$request->all();
        $data["slug"]=Str::slug($request->name);
        $file=$request->file("photo");
        $fileName=$this->helper->fileUploadHandling($file, "category","assets/products","update");
        $data["photo"]=$fileName;

        $category=Product::findorFail($id);

        $category->update($data);
   
        return redirect()->route("admin.products.index");
    }

    public function destroy($id){
        $category=Product::findOrFail($id);
        $category->delete();
        
        return redirect()->route("admin.products.index");
    }
}
