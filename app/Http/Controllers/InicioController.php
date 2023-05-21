<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Piloto;
use App\Models\Cargamento;
use App\Models\User;
use App\Models\Transporte;
use App\Models\Users;
use App\Models\Parcialidades;
use Illuminate\Http\Request;

class InicioController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        return view('inicio');
    }

    public function listadoCargamentos(Request $request){
        $cargamentos = Cargamento::all();
        return response()->json($cargamentos, 200);
    }

    public function listadoPilotos(Request $request){
        $pilotos = Piloto::all();
        return response()->json($pilotos, 200);
    }

    public function listadoTransportes(Request $request){
        $transportes = Transporte::all();
        return response()->json($transportes, 200);
    }

    public function listadoAgricultores(Request $request){
        $agricultores = Users::all();
        return response()->json($agricultores, 200);
    }
}
