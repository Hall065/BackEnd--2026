<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;

class ProdutosController extends Controller
{
    public function index() 
    {
        $produtos = \App\Models\Produtos::all(); // Busca todos os produtos
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        // 1. Validação
        $request->validate([
            'name'          => 'required|string|max:255',
            'descricao'     => 'required|string|max:255',
            'preco'         => 'required|numeric|min:0',
            'fornecedor_id' => 'required|integer|exists:fornecedores,id', // Valida se o fornecedor existe no banco
            'ativo'         => 'required|boolean', // 1 para true, 0 para false
        ]);

        // 2. Salva no banco
        Produtos::create([
            'name'          => $request->name,
            'descricao'     => $request->descricao,
            'preco'         => $request->preco,
            'fornecedor_id' => $request->fornecedor_id,
            'ativo'         => $request->ativo,
        ]);

        // 3. Redireciona para a lista
        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }
}