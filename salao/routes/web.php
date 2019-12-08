<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('sistema.login');
});
Route::get('/index', function () {
    return view('sistema.index');
});
Route::get('/cadCliente', function () {
    return view('sistema.cadCliente');
});
Route::get('/cadFuncionario', function () {
    return view('sistema.cadFuncionario');
});
