<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    public function index() {
    $fornecedores= \App\Models\Fornecedores::all(); // Busca todos os fornecedores
    return view('fornecedores.index', compact('fornecedores'));
    }
}
