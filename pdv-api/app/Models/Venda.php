<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    public function store(Request $request)
    {
        // Se o front-end estiver a enviar os dados, eles entram aqui
        $data = $request->all();

        try {
            DB::beginTransaction();

            // Insere na tabela 'vendas'
            $idVenda = DB::table('vendas')->insertGetId([
                'total' => $data['total'],
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Insere os itens
            foreach ($data['itens'] as $item) {
                DB::table('itens_venda')->insert([
                    'venda_id' => $idVenda,
                    'produto_id' => $item['id'],
                    'quantidade' => $item['qtd'],
                    'preco' => $item['preco']
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Venda gravada!'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
