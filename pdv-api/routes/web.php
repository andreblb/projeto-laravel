<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () {
    return "OK";
});

// 1. Rota de Produto (Fora de grupos)
$router->get('/produtos/{codigo}', function ($codigo) {
    $produto = \App\Models\Produto::where('codigo_barras', $codigo)->first();
    return $produto ? response()->json($produto) : response()->json(['message' => 'Nao encontrado'], 404);
});

// 2. Rotas de API
$router->group(['prefix' => 'api', 'middleware' => 'cors'], function () use ($router) {

    // Rotas Fixas
    $router->get('/vendas/status-caixa', 'VendasController@statusCaixa');
    $router->get('/vendas/relatorio', 'VendasController@relatorio');
    $router->post('/vendas/registrar-sangria', 'VendasController@registrarSangria');
    $router->post('/sangria', 'VendasController@realizarSangria');

    // Rotas Dinâmicas
    $router->get('/vendas', 'VendasController@index');
    $router->get('/vendas/{id}', 'VendasController@show');
    $router->post('/vendas', 'VendasController@store');
}); // Este fecha o group

// Fim do arquivo
