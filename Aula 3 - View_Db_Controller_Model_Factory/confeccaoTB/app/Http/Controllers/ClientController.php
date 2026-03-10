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
}