<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


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
    protected $redirectTo = '/';

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
            'store_name' => ['nullable','string','max:255'],
            'categories_id' => ['nullable','integer','exists:categories,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_store_open' => ['required']
        ]);
    }

    public function showRegistrationForm()
    {
    
        $categories= Category::all();  
        
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
            'store_name' => isset($data['store_name']) ? $data['store_name'] : '-',
            'categories_id '=> isset($data['categories_id']) ? $data['categories_id'] : '',
            'store_status' => isset($data['is_store_open']) ? 1 : 0
        ]);
    }

    public function success(){
        return view("auth.success");
    }
    
    public function check(Request $request){
        return User::where("email", $request->email)->count() > 0 ? 'Unavalaible' : 'Available';
    }
}
