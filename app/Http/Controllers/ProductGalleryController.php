<?php

namespace App\Http\Controllers;

use App\Models\ProductGallery;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
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
                                    <a class="dropdown-item" href="' . route('admin.product-galleries.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('admin.product-galleries.destroy', $item->id) . '" method="POST">
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

        return view("pages.admin.product-galleries.index");
    }
}
