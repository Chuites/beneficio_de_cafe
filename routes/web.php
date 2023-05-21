<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;



Route::get('/', function () {
    return view('inicio');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('listadoCargamentos', 'App\Http\Controllers\InicioController@listadoCargamentos')->name("listadoCargamentos");
Route::post('listadoPilotos', 'App\Http\Controllers\InicioController@listadoPilotos')->name("listadoPilotos");
Route::post('listadoTransportes', 'App\Http\Controllers\InicioController@listadoTransportes')->name("listadoTransportes");
Route::post('listadoAgricultores', 'App\Http\Controllers\InicioController@listadoAgricultores')->name("listadoAgricultores");
