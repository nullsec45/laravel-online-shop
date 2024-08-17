<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $query=Category::query();

            return Datatables::of($query)->addColumn("action", function($item){
                return `
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                            Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('category.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('category.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                        </div>
                    </div>
                `;
            })->editColumn("photo",function($item){
                return $item->photo ? '<img src="'.Storage::url($item->photo).'" style="max-height:40px;" />' : '';
            })->rawColumns(["action","photo"])
            ->make(true);

        }

        return view("pages.admin.category");
    }

    public function create(CategoryRequest $request){}
    
    public function store(){}
    
    public function show(){}

    public function edit(){}

    public function update(CategoryRequest $request){}

    public function delete(){}
}
