<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Produtos; // Importando para popular o select

class EstoqueController extends Controller
{
    public function index()
    {
        $estoques = \App\Models\Estoque::with('produto')->get();
        return view('estoque.index', compact('estoques'));
    }

    public function create()
    {
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

    // --- NOVOS MÉTODOS ---

    public function edit(Estoque $estoque)
    {
        // Busca os produtos para popular o select na tela de edição
        $produtos = \App\Models\Produtos::orderBy('name')->get();
        return view('estoque.edit', compact('estoque', 'produtos'));
    }

    public function update(Request $request, Estoque $estoque)
    {
        $request->validate([
            'produto_id'   => 'required|integer|exists:produtos,id',
            'qntd'         => 'required|integer|min:0',
        ]);

        $estoque->update([
            'produto_id' => $request->produto_id,
            'qntd' => $request->qntd,
        ]);

        return redirect()->route('estoque.index')
            ->with('success', 'Item do estoque atualizado com sucesso!');
    }

    public function destroy(Estoque $estoque)
    {
        try {
            $estoque->delete();
            return redirect()->route('estoque.index')->with('success', 'Item removido do estoque com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('estoque.index')->with('error', 'Erro ao remover item do estoque.');
        }
    }
}