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

Route::resource('/login', 'UsuariosController');

Route::get('/index', function () {
    return view('sistema.index');
});
Route::resource('/cadCliente', 'ClientesController');

Route::resource('/cadFuncionario', 'PrestadorController');

Route::resource('/ordemServ', 'OrderServController');

Route::get('/servicos', function () {
    return view('sistema.servicos');
});
