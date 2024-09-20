<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class LocationControlller extends Controller
{
    public function provinces(){
        return Province::all();
    }

    public function regencies(string $province_id){
        return Regency::where('province_id', $province_id)->get();
    }
}
