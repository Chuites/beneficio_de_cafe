<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class InicioController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        return view('inicio');
    }
}
