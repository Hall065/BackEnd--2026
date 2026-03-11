<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Fornecedores;
use App\Models\Estoque;

class ProdutosController extends Controller
{
    public function index() 
    {
        $produtos = Produtos::all(); 
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        // Busca os fornecedores para podermos listar no <select> de criação
        $fornecedores = Fornecedores::orderBy('nome')->get();
        return view('produtos.create', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'descricao'     => 'required|string|max:255',
            'preco'         => 'required|numeric|min:0',
            'fornecedor_id' => 'required|integer|exists:fornecedores,id',
            'ativo'         => 'required|boolean',
        ]);

        Produtos::create($request->all());

        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produtos $produto)
    {
        $fornecedores = Fornecedores::orderBy('nome')->get();
        return view('produtos.edit', compact('produto', 'fornecedores'));
    }

    public function update(Request $request, Produtos $produto)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'descricao'     => 'required|string|max:255',
            'preco'         => 'required|numeric|min:0',
            'fornecedor_id' => 'required|integer|exists:fornecedores,id',
            'ativo'         => 'required|boolean',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Request $request, Produtos $produto)
    {
        // Se vier com a tag de forçar exclusão (do modal)
        if ($request->has('force')) {
            Estoque::where('produto_id', $produto->id)->delete();
            $produto->delete();
            return redirect()->route('produtos.index')
                ->with('success', 'Produto e seu histórico de estoque foram removidos!');
        }

        // Tentativa normal
        try {
            $produto->delete();
            return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Código 23000 indica violação de chave estrangeira (está atrelado ao Estoque)
            if ($e->getCode() == "23000") {
                return redirect()->route('produtos.index')
                    ->with('modal_exclusao', true)
                    ->with('produto_id', $produto->id)
                    ->with('produto_nome', $produto->name);
            }
            return redirect()->route('produtos.index')->with('error', 'Erro ao excluir o produto.');
        }
    }
}