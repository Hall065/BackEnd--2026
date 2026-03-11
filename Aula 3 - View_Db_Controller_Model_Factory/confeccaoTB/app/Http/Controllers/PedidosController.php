<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Clients; // Importante para buscar os clientes

class PedidosController extends Controller
{
    public function index() 
    {
        // Se houver relação 'client' configurada no Model Pedidos, o "with" otimiza a busca.
        $pedidos = Pedidos::all(); 
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Clients::orderBy('name')->get();
        return view('pedidos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'status'    => 'required|string|max:50',
            'valor'     => 'required|numeric|min:0',
        ]);

        Pedidos::create([
            'client_id' => $request->client_id,
            'status'    => $request->status,
            'valor'     => $request->valor,
        ]);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido cadastrado com sucesso!');
    }

    // --- NOVOS MÉTODOS ---

    public function edit(Pedidos $pedido)
    {
        $clientes = Clients::orderBy('name')->get();
        return view('pedidos.edit', compact('pedido', 'clientes'));
    }

    public function update(Request $request, Pedidos $pedido)
    {
        $request->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'status'    => 'required|string|max:50',
            'valor'     => 'required|numeric|min:0',
        ]);

        $pedido->update([
            'client_id' => $request->client_id,
            'status'    => $request->status,
            'valor'     => $request->valor,
        ]);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(Pedidos $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido removido com sucesso!');
    }
}