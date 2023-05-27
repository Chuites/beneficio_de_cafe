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
        $cargamentos = Cargamento::join('users', 'cargamento.id_agricultor', '=', 'users.id')
            ->join('estado_cargamento', 'cargamento.id_estado_cargamento', '=', 'estado_cargamento.id_estado_cargamento')
            ->select('cargamento.id_cargamento', 'users.name', 'cargamento.peso', 'cargamento.parcialidades', 'estado_cargamento.justificacion')
            ->get();
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

    public function confirmaCuenta(Request $request){
        $cargamento = Cargamento::where('id_cargamento', $request->id_cargamento)->first();
        $estado_cargamento = $cargamento->id_estado_cargamento;
        if($estado_cargamento != 44){
            if($estado_cargamento == 54){
                $data = [
                    'mensaje' => 'La cuenta ya ha sido confirmada'
                ];
                return response()->json($data, 200);
            }
            $data = [
                'mensaje' => 'El cargamento aun se encuentra en proceso de pesaje'
            ];
            return response()->json($data, 200);
        }else{
            $peso_certificado = Parcialidades::where('id_cargamento', $request->id_cargamento)->sum('peso_certificado');
            $peso_total = $cargamento->peso;
            $mayor_permitido = ($peso_total * 0.05) + $peso_total;
            $menor_permitido = (($peso_total * 0.05) *-1) + $peso_total;

            if(($peso_certificado < $mayor_permitido)&&($peso_certificado > $menor_permitido)){
                $cargamento = Cargamento::where('id_cargamento', $request->id_cargamento)->first();
                $cargamento->id_estado_cargamento = 54;
                $cargamento->save();
                $data = [
                    'mensaje' => 'Cuenta confirmada, el peso certificado se encuentra dentro del rango permitido'
                ];
                return response()->json($data, 200);
            }else{
                $cargamento = Cargamento::where('id_cargamento', $request->id_cargamento)->first();
                $cargamento->id_estado_cargamento = 54;
                $data = [
                    'mensaje' => 'Cuenta confirmada, el peso certificado no cumple con el rango permitido'
                ];
                return response()->json($data, 200);
            }
        }
    }
}
