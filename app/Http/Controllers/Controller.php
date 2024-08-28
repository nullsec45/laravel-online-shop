<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $helper;

    public function __construct(){
        $this->helper=new Helpers();
    }
}
