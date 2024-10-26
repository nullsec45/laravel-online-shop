<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $helper;

    public function __construct(){
        App::setLocale("en");     
        $this->helper=new Helpers();
    }
}
