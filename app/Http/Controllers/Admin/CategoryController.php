<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $query=Category::query();

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

        return view("pages.admin.categories.index");
    }

    public function create(){
        return view("pages.admin.categories.create");
    }
    
    public function store(CategoryRequest $request){
        $data=$request->all();
        $data["slug"]=Str::slug($request->name);
        $file=$request->file("photo");
        $fileName=$this->helper->fileUploadHandling($file, "category","assets/categories","store");
        $data["photo"]=$fileName;
   
        Category::create($data);
        return redirect()->route("admin.categories.index");
    }
    
    public function show(){}

    public function edit($id){
        $category=Category::findorFail($id);

        $data=[
            "category" => $category
        ];

        return view("pages.admin.categories.edit", $data);
    }

    public function update(CategoryRequest $request, $id){
        $data=$request->all();
        $data["slug"]=Str::slug($request->name);
        $file=$request->file("photo");
        $fileName=$this->helper->fileUploadHandling($file, "category","assets/categories","update");
        $data["photo"]=$fileName;

        $category=Category::findorFail($id);

        $category->update($data);
   
        return redirect()->route("admin.categories.index");
    }

    public function destroy($id){
        $category=Category::findOrFail($id);
        $category->delete();
        
        return redirect()->route("admin.categories.index");
    }
}
