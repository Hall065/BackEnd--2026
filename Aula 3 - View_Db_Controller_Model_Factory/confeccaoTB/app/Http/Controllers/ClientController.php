<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $clients = \App\Models\Clients::all();
        return view('clientes.index', compact('clients'));
    }
}