<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;


Route::get('/', function () {
    return view('./login/login');
});
Route::post('login', 'App\Http\Controllers\InicioController@login')->name("login");

Route::post('logout', 'App\Http\Controllers\InicioController@logout')->name("logout");
Route::get('inicio', 'App\Http\Controllers\InicioController@index')->name("inicio");
Route::post('generarPDF\{id_cargamento?}', 'App\Http\Controllers\InicioController@generarPDF')->name("generarPDF");
Route::post('listadoCargamentos', 'App\Http\Controllers\InicioController@listadoCargamentos')->name("listadoCargamentos");
Route::post('listadoCargamentosReporte', 'App\Http\Controllers\InicioController@listadoCargamentosReporte')->name("listadoCargamentosReporte");
Route::post('listadoPilotos', 'App\Http\Controllers\InicioController@listadoPilotos')->name("listadoPilotos");
Route::post('listadoTransportes', 'App\Http\Controllers\InicioController@listadoTransportes')->name("listadoTransportes");
Route::post('listadoAgricultores', 'App\Http\Controllers\InicioController@listadoAgricultores')->name("listadoAgricultores");
Route::post('confirmaCuenta', 'App\Http\Controllers\InicioController@confirmaCuenta')->name("confirmaCuenta");
