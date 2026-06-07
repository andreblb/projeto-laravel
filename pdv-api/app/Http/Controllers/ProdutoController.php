<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Método para buscar o produto pelo código
    public function show($codigo)
    {
        // Busca no banco de dados (ajuste 'produtos' para o nome da sua tabela)
        $produto = DB::table('produtos')->where('codigo', $codigo)->first();

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }
}
