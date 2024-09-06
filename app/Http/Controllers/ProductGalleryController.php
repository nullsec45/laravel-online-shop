<?php

namespace App\Http\Controllers;

use App\Models\ProductGallery;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductGalleryRequest;

class ProductGalleryController extends Controller
{
     public function index(){
        if(request()->ajax()){
            $query=ProductGallery::with(["product"]);

            return DataTables::of($query)->addColumn("actions", function($item){
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                            Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <form action="' . route('admin.product-galleries.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                        </div>
                    </div>
                ';
            })->editColumn("photos",function($item){
                return $item->photos ? '<img src="'.asset("storage/assets/products/".$item->photos).'" style="max-height:40px;" />' : '';
            })->rawColumns(["actions","photos"])
            ->make(true);

        }

        return view("pages.admin.product-galleries.index");
    }

    public function create(){
        $products=Product::all();

        return view("pages.admin.product-galleries.create",[
            "products"  => $products
        ]);
    }

    public function store(ProductGalleryRequest $request){
       $data=$request->all();

       $file=$request->file("photos");
       $fileName=$this->helper->fileUploadHandling($file,"photo_products","assets/products","store",null);

       $data["photos"]=$fileName;
       ProductGallery::create($data);

       return redirect()->route("admin.product-galleries.index");
    }

    public function destroy(string $id){
       $product=ProductGallery::findOrFail($id);

       if(!$product){
          return redirect()->route("admin.product-galleries.index")->with("error","Photo product not found");
       }
       $file=$product->photos;
       $this->helper->fileUploadHandling(null, null,"assets/products","delete",$file);
       $product->delete();

       return redirect()->route("admin.product-galleries.index");
    }
}
