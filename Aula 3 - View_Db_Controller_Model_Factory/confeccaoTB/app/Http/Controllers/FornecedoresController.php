<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedores;

class FornecedoresController extends Controller
{
    public function index() 
    {
        $fornecedores = Fornecedores::all();
        return view('Fornecedores.index', compact('fornecedores'));
    }

    public function create()
    {
        return view('Fornecedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'required|string|max:20|unique:fornecedores,cnpj',
            'email'    => 'required|email|max:255|unique:fornecedores,email',
            'telefone' => 'required|string|max:20',
        ]);

        Fornecedores::create($request->all());

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    // --- NOVOS MÉTODOS ---

    public function edit(Fornecedores $fornecedore)
    {
        // Nota: O Laravel injeta o model. Se a variável na rota for {fornecedore}, use esse nome.
        return view('Fornecedores.edit', compact('fornecedore'));
    }

    public function update(Request $request, Fornecedores $fornecedore)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'required|string|max:20|unique:fornecedores,cnpj,' . $fornecedore->id,
            'email'    => 'required|email|max:255|unique:fornecedores,email,' . $fornecedore->id,
            'telefone' => 'required|string|max:20',
        ]);

        $fornecedore->update($request->all());

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(Fornecedores $fornecedore)
    {
        $fornecedore->delete();
        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor removido com sucesso!');
    }
}