<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedores;

class FornecedoresController extends Controller
{
    public function index() 
    {
        $fornecedores = Fornecedores::all();
        // Nota: Certifique-se de que a pasta na sua view está em minúsculo (fornecedores.index) ou maiúsculo (Fornecedores.index) 
        // e ajuste aqui se necessário. Vou usar minúsculo como padrão do Laravel.
        return view('Fornecedores.index', compact('fornecedores'));
    }

    public function create()
    {
        return view('Fornecedores.create');
    }

    public function store(Request $request)
    {
        // 1. Validação dos dados
        $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'required|string|max:20|unique:fornecedores,cnpj', // Garante que não repita CNPJ
            'email'    => 'required|email|max:255|unique:fornecedores,email', // Garante que não repita Email
            'telefone' => 'required|string|max:20',
        ], [
            // Mensagens personalizadas (opcional)
            'cnpj.unique' => 'Este CNPJ já está cadastrado no sistema.',
            'email.unique' => 'Este E-mail já está cadastrado no sistema.'
        ]);

        // 2. Criação do registro no banco
        Fornecedores::create([
            'nome'     => $request->nome,
            'cnpj'     => $request->cnpj,
            'email'    => $request->email,
            'telefone' => $request->telefone,
        ]);

        // 3. Redirecionamento com mensagem de sucesso
        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }
}