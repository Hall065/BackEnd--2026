<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Rotas Crud
// Clientes
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

// Estoque
Route::get('/estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
Route::get('/estoque/{estoque}/edit', [EstoqueController::class, 'edit'])->name('estoque.edit');
Route::put('/estoque/{estoque}', [EstoqueController::class, 'update'])->name('estoque.update');
Route::delete('/estoque/{estoque}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');

// Fornecedores
Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('fornecedores.index');
Route::get('/fornecedores/create', [FornecedoresController::class, 'create'])->name('fornecedores.create');
Route::post('/fornecedores', [FornecedoresController::class, 'store'])->name('fornecedores.store');
Route::get('/fornecedores/{fornecedore}/edit', [FornecedoresController::class, 'edit'])->name('fornecedores.edit');
Route::put('/fornecedores/{fornecedore}', [FornecedoresController::class, 'update'])->name('fornecedores.update');
Route::delete('/fornecedores/{fornecedore}', [FornecedoresController::class, 'destroy'])->name('fornecedores.destroy');

// Pedidos
Route::get('/pedidos/create', [PedidosController::class, 'create'])->name('pedidos.create');
Route::post('/pedidos', [PedidosController::class, 'store'])->name('pedidos.store');
Route::get('/pedidos/{pedido}/edit', [PedidosController::class, 'edit'])->name('pedidos.edit');
Route::put('/pedidos/{pedido}', [PedidosController::class, 'update'])->name('pedidos.update');
Route::delete('/pedidos/{pedido}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');

// Produtos
Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');
Route::get('/produtos/create', [ProdutosController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store');
Route::get('/produtos/{produto}/edit', [ProdutosController::class, 'edit'])->name('produtos.edit');
Route::put('/produtos/{produto}', [ProdutosController::class, 'update'])->name('produtos.update');
Route::delete('/produtos/{produto}', [ProdutosController::class, 'destroy'])->name('produtos.destroy');

// Rotas Default
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('fornecedores.index');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');
Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');

// Personagens (projeto pessoal)
use App\Http\Controllers\CharacterController;
Route::resource('characters', CharacterController::class);

// ── DASHBOARD com dados reais ─────────────────────────────────────────────
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';