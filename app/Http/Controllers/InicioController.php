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
use Session;
use PDF;

class InicioController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        if (Session::has('token')) {
            return view('inicio');
        }else{
            return view('login/login');
        }
    }

    public function logout(Request $request){
        Session::forget('token');
        return response()->json(200);
    }

    public function login(Request $request){
        $data = [
            'email' => $request->username,
            'password' => $request->password
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/login', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            Session::put('token', $data['token']);
            return response()->json(200);
        }
        else {
            return response()->json(401);
        }
    }

    public function listadoCargamentos(Request $request){
        $cargamentos = Cargamento::join('users', 'cargamento.id_agricultor', '=', 'users.id')
            ->join('estado_cargamento', 'cargamento.id_estado_cargamento', '=', 'estado_cargamento.id_estado_cargamento')
            ->select('cargamento.id_cargamento', 'users.name', 'cargamento.peso', 'cargamento.parcialidades', 'estado_cargamento.justificacion')
            ->get();
        return response()->json($cargamentos, 200);
    }

    public function listadoCargamentosReporte(Request $request){
        $fh_inicio = $request->fh_inicio;
        $fh_fin = $request->fh_fin;
        logger($fh_inicio);

        $cargamentos = Cargamento::join('users', 'cargamento.id_agricultor', '=', 'users.id')
            ->join('estado_cargamento', 'cargamento.id_estado_cargamento', '=', 'estado_cargamento.id_estado_cargamento')
            ->select('cargamento.id_cargamento', 'users.name', 'cargamento.peso', 'cargamento.parcialidades', 'estado_cargamento.justificacion')
            ->whereBetween('cargamento.fh_creacion', [$fh_inicio, $fh_fin])
            ->get();
        if($cargamentos->count() == 0)
        {
            $data = [
                'mensaje' => 'No se encontraron resultados'
            ];
            return response()->json($data, 200);
        }else{
            return response()->json($cargamentos, 200);
        }
    }

    public function listadoPilotos(Request $request){
        $pilotos = Piloto::
        join('estado_piloto', 'estado_piloto.id_estado_piloto', '=', 'piloto.id_estado_piloto')
        ->get();
        return response()->json($pilotos, 200);
    }

    public function listadoTransportes(Request $request){
        $transportes = Transporte::
        join('estado_transporte', 'estado_transporte.id_estado_transporte', '=', 'transporte.id_estado_transporte')
        ->get();
        return response()->json($transportes, 200);
    }

    public function listadoAgricultores(Request $request){
        $agricultores = Users::
        join('estado_agricultor', 'estado_agricultor.id_estado_agricultor', '=', 'users.id_estado_agricultor')
        ->get();
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
                    'mensaje' => 'Cuenta confirmada, el peso certificado se encuentra dentro del rango permitido, verifique su boleta PDF'
                ];
                return response()->json($data, 200);
            }else{
                $cargamento = Cargamento::where('id_cargamento', $request->id_cargamento)->first();
                $cargamento->id_estado_cargamento = 54;
                $data = [
                    'mensaje' => 'Cuenta confirmada, el peso certificado no cumple con el rango permitido, por favor verifique su boleta PDF'
                ];
                return response()->json($data, 200);
            }
        }
    }

    public function generarPDF(Request $request, $id_cargamento){
        $id_cargamento;
        $peso_certificado = Parcialidades::where('id_cargamento', $id_cargamento)->sum('peso_certificado');
        $cargamento = Cargamento::where('id_cargamento', $id_cargamento)->first();
        $peso_total = $cargamento->peso;
        $mayor_permitido = ($peso_total * 0.05) + $peso_total;
        $menor_permitido = (($peso_total * 0.05) *-1) + $peso_total;

        if(($peso_certificado < $mayor_permitido)&&($peso_certificado > $menor_permitido)){
            //$cargamento = Cargamento::where('id_cargamento', $request->idCargamentoPDF)->first();
            $cargamento->id_estado_cargamento = 54;
            $cargamento->save();
            $diferencia = $peso_total - $peso_certificado;

            $pdf = PDF::loadView('pdf.boleta_agricultor', compact('peso_certificado','peso_total',
            'mayor_permitido','menor_permitido','diferencia','id_cargamento'));

            return $pdf->stream('Dictamen de .pdf');
        }else{
            //$cargamento = Cargamento::where('id_cargamento', $request->id_cargamento)->first();
            $cargamento->id_estado_cargamento = 54;
            $cargamento->save();
            $diferencia = $peso_total - $peso_certificado;

            $pdf = PDF::loadView('pdf.boleta_agricultor', compact('peso_certificado','peso_total',
            'mayor_permitido','menor_permitido','diferencia','id_cargamento'));

            return $pdf->stream('Certificado de Peso.pdf');
        }
    }
}
