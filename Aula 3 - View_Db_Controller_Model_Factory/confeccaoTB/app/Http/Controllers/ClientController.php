<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class ClientController extends Controller
{
    public function index()
    {
        $clients = \App\Models\Clients::all();
        return view('clientes.index', compact('clients'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'cpf'      => 'required|string|unique:clients',
            'email'    => 'required|email|unique:clients',
            'telefone' => 'required|string',
            'endereco' => 'nullable|string',
        ]);

        Clients::create([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'endereco' => $request->endereco,
        ]);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    // --- NOVOS MÉTODOS ADICIONADOS ---

    public function edit(Clients $client)
    {
        return view('clientes.edit', compact('client'));
    }

    public function update(Request $request, Clients $client)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            // O id no final diz ao Laravel para ignorar a validação de "único" se for o próprio cliente
            'cpf'      => 'required|string|unique:clients,cpf,' . $client->id,
            'email'    => 'required|email|unique:clients,email,' . $client->id,
            'telefone' => 'required|string',
            'endereco' => 'nullable|string',
        ]);

        $client->update([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'endereco' => $request->endereco,
        ]);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    // Exclui o cliente (com tratamento para o Modal)
    public function destroy(Request $request, Clients $client)
    {
        // 1. Verifica se veio a confirmação do modal (exclusão forçada)
        if ($request->has('force')) {
            // Apaga os pedidos atrelados primeiro
            \App\Models\Pedidos::where('client_id', $client->id)->delete();

            // Apaga o cliente
            $client->delete();

            return redirect()->route('clients.index')
                ->with('success', 'Cliente e seus pedidos foram removidos!');
        }

        // 2. Tentativa normal de exclusão
        try {
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Cliente removido com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Se der erro de chave estrangeira (tem pedidos atrelados)
            if ($e->getCode() == "23000") {
                // Retorna para a tela enviando os dados para ABRIR O MODAL
                return redirect()->route('clients.index')
                    ->with('modal_exclusao', true)
                    ->with('cliente_id', $client->id)
                    ->with('cliente_nome', $client->name);
            }

            return redirect()->route('clients.index')
                ->with('error', 'Ocorreu um erro ao tentar excluir o cliente.');
        }
    }
}
