<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos; // Importando o seu Model

class PedidosController extends Controller
{
    public function index() 
    {
        $pedidos = \App\Models\Pedidos::all(); // Busca todos os pedidos
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        // 1. Validação
        $request->validate([
            'client_id' => 'required|integer|exists:clients,id', // Garante que o cliente exista
            'status'    => 'required|string|max:50',
            'valor'     => 'required|numeric|min:0', // Garante que seja um número (ex: 150.50)
        ]);

        // 2. Salva no banco
        Pedidos::create([
            'client_id' => $request->client_id,
            'status'    => $request->status,
            'valor'     => $request->valor,
        ]);

        // 3. Redireciona com sucesso
        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido cadastrado com sucesso!');
    }
}