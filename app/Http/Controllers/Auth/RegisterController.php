<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function showRegistrationForm()
    {
    
        $categories= [
            [
                "id" => "P001",
                "name" => "Gadgets",
                "icon" => "categories-gadgets.svg",
                "slug" => "gadgets"
            ],
            [
                "id" => "P002",
                "name" => "Furniture",
                "icon" => "categories-furniture.svg",
                "slug" => "furniture"
            ],
            [
                "id" => "P003",
                "name" => "Makeup",
                "icon" => "categories-makeup.svg",
                "slug" => "makeup"
            ],
            [
                "id" => "P004",
                "name" => "Sneaker",
                "icon" => "categories-sneaker.svg",
                "slug" => "sneaker"
            ],
            [
                "id" => "P005",
                "name" => "Tools",
                "icon" => "categories-tools.svg",
                "slug" => "tools"
            ],
            [
                "id" => "P006",
                "name" => "Baby",
                "icon" => "categories-baby.svg",
                "slug" => "baby"
            ]
        ];    
        
        return view('auth.register', [
            'categories' => $categories
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function success(){
        return view("auth.success");
    }
}
