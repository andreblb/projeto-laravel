<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    public function store(Request $request)
    {
        try {
            $vendaId = DB::table('vendas')->insertGetId([
                'terminal'        => $request->input('terminal', 'PDV-01'),
                'operador_id'     => null,
                'forma_pagamento' => $request->input('forma_pagamento', 'DINHEIRO'),
                'valor_total'     => $request->input('total'),
                'data_venda'      => date('Y-m-d H:i:s')
            ]);

            return response()->json([
                'success' => true,
                'venda_id' => $vendaId,
                'message' => 'Venda gravada com sucesso!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    // --- NOVAS FUNÇÕES ADICIONADAS ABAIXO ---

    public function statusCaixa()
    {
        $totalVendas = DB::table('vendas')->sum('valor_total');
        $totalSangrias = DB::table('sangrias')->sum('valor');
        $saldo = $totalVendas - $totalSangrias;

        return response()->json([
            ['id' => 1, 'nome' => 'Caixa Geral', 'saldo' => number_format($saldo, 2, '.', '')]
        ]);
    }

    public function relatorio(Request $request)
    {
        $periodo = $request->query('periodo', 'diario');

        $query = DB::table('vendas');

        if ($periodo === 'diario') {
            $query->whereRaw('DATE(data_venda) = CURDATE()');
        } elseif ($periodo === 'quinzenal') {
            $query->whereRaw('data_venda >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)');
        } elseif ($periodo === 'mensal') {
            $query->whereRaw('MONTH(data_venda) = MONTH(CURDATE())');
        }

        return $query->select('forma_pagamento', DB::raw('SUM(valor_total) as total'))
                     ->groupBy('forma_pagamento')
                     ->get();
    }

    public function realizarSangria(Request $request)
    {
        try {
            DB::table('sangrias')->insert([
                'valor' => $request->input('valor'),
                'data' => date('Y-m-d H:i:s'),
                'observacao' => 'Sangria realizada'
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
