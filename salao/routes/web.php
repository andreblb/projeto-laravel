<?php


Route::resource('/login', 'UsuariosController');

Route::get('/index', function () {
    return view('sistema.index');
});
Route::resource('/cadCliente', 'ClientesController');

Route::resource('/cadFuncionario', 'PrestadorController');

Route::resource('/ordemServ', 'OrderServController');

Route::resource('/servicos', 'ServicosController');
