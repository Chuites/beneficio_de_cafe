<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;



Route::get('/', function () {
    return view('inicio');
});
Route::post('listadoCargamentos', 'App\Http\Controllers\InicioController@listadoCargamentos')->name("listadoCargamentos");
Route::post('listadoCargamentosReporte', 'App\Http\Controllers\InicioController@listadoCargamentosReporte')->name("listadoCargamentosReporte");
Route::post('listadoPilotos', 'App\Http\Controllers\InicioController@listadoPilotos')->name("listadoPilotos");
Route::post('listadoTransportes', 'App\Http\Controllers\InicioController@listadoTransportes')->name("listadoTransportes");
Route::post('listadoAgricultores', 'App\Http\Controllers\InicioController@listadoAgricultores')->name("listadoAgricultores");
Route::post('confirmaCuenta', 'App\Http\Controllers\InicioController@confirmaCuenta')->name("confirmaCuenta");
