<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoques = \App\Models\Estoque::with('produto')->get();

        return view('estoque.index', compact('estoques'));
    }

    public function create()
    {
        // Busca os produtos para popular o select
        $produtos = \App\Models\Produtos::orderBy('name')->get();
        return view('estoque.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id'   => 'required|integer|exists:produtos,id',
            'qntd'         => 'required|integer|min:0',
        ]);

        \App\Models\Estoque::create([
            'produto_id' => $request->produto_id,
            'qntd' => $request->qntd,
        ]);

        return redirect()->route('estoque.index')
            ->with('success', 'Novo item cadastrado com sucesso!');
    }
}
