<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $query=User::query();

            return DataTables::of($query)->addColumn("actions", function($item){
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                            Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('admin.users.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('admin.users.destroy', $item->id) . '" method="POST">
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

        return view("pages.admin.users.index");
    }

    public function create(){
        return view("pages.admin.users.create");
    }
    
    public function store(UserRequest $request){
        $data=$request->all();
        $data["password"]=bcrypt($request->password);
        User::create($data);
        return redirect()->route("admin.users.index");
    }
    
    public function show(){}

    public function edit($id){
        $user=User::findorFail($id);

        $data=[
            "user" => $user,
            "roles" => [
                [
                    "value" => "ADMIN",
                    "teks" => "Admin"
                ],
                [
                    "value" => "USER",
                    "teks" => "User"
                ]
            ]
        ];

        return view("pages.admin.users.edit", $data);
    }

    public function update(UserRequest $request, $id){
        $data=$request->all();

        $User=User::findorFail($id);

        if($request->password){
            $data["password"]=bcrypt($request->password);
        }else{
            unset($data["password"]);
        }
        
        $User->update($data);
   
        return redirect()->route("admin.users.index");

    }

    public function destroy($id){
        $User=User::findOrFail($id);
        $User->delete();
        
        return redirect()->route("admin.users.index");
    }
}
