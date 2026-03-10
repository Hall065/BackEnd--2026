<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\EstoqueController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Rotas Create
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
Route::get('/fornecedores/create', [FornecedoresController::class, 'create'])->name('fornecedores.create');
Route::post('/fornecedores', [FornecedoresController::class, 'store'])->name('fornecedores.store');
Route::get('/pedidos/create', [PedidosController::class, 'create'])->name('pedidos.create');
Route::post('/pedidos', [PedidosController::class, 'store'])->name('pedidos.store');
Route::get('/produtos/create', [ProdutosController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store');

// Rotas Default
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('fornecedores.index');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');
Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
