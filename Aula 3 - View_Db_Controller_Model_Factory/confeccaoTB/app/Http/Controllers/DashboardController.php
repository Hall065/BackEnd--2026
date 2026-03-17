<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Clients;
use App\Models\Produtos;
use App\Models\Estoque;
use App\Models\Fornecedores;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── CARDS DE RESUMO ──────────────────────────────────────────────
        $totalClientes    = Clients::count();
        $totalFornecedores = Fornecedores::count();
        $totalPedidos     = Pedidos::count();
        $totalProdutos    = Produtos::count();
        $totalEstoque     = Estoque::sum('qntd');

        // ── FATURAMENTO ──────────────────────────────────────────────────
        $faturamentoTotal = Pedidos::sum('valor');
        $faturamentoMes   = Pedidos::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->sum('valor');

        // ── PEDIDOS POR STATUS ───────────────────────────────────────────
        $pedidosPorStatus = Pedidos::select('status', DB::raw('count(*) as total'))
                                   ->groupBy('status')
                                   ->pluck('total', 'status');

        // ── ÚLTIMOS REGISTROS DE CADA MÓDULO ────────────────────────────
        $ultimosPedidos = Pedidos::with('client')
                                 ->latest()
                                 ->take(5)
                                 ->get();

        $ultimosClientes = Clients::latest()
                                  ->take(5)
                                  ->get();

        $ultimosFornecedores = Fornecedores::latest()
                                           ->take(3)
                                           ->get();

        $ultimosEstoques = Estoque::with('produto')
                                  ->latest()
                                  ->take(5)
                                  ->get();

        // ── PRODUTOS COM ESTOQUE BAIXO (< 10 unidades) ──────────────────
        $estoqueBaixo = Estoque::with('produto')
                               ->where('qntd', '<', 10)
                               ->orderBy('qntd')
                               ->take(5)
                               ->get();

        return view('dashboard', compact(
            'totalClientes',
            'totalFornecedores',
            'totalPedidos',
            'totalProdutos',
            'totalEstoque',
            'faturamentoTotal',
            'faturamentoMes',
            'pedidosPorStatus',
            'ultimosPedidos',
            'ultimosClientes',
            'ultimosFornecedores',
            'ultimosEstoques',
            'estoqueBaixo',
        ));
    }
}