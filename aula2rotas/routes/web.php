<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/empresa', function () {
    return view('empresa');
});

Route::any('/liberado', function () {
    return "Acesso liberado para qualquer método HTTP (put, delete, get, post).";
});

Route::match(['get', 'post'], '/bloqueado', function () {
    return "Permite acesso definidos.";
});

Route::match(['put', 'delete'], '/bloqueado2', function () {
    return "Permite acesso definidos.";
});

route::get('/produto/{id}', function ($id) {
    return "Id do Produto: " . $id;
});

route::get('/produto/{id}/{nome}', function ($id, $nome) {
    return "Id do Produto: {$id}<br><br>Nome: {$nome}";
});

// Direcionar Rotas
Route::redirect('/sobre', '/empresa');

Route::get('/aboutUs', function () {
    return view('aboutUs');
});

Route::redirect('/contato', '/aboutUs');

// Criando nome
Route::get('/news', function () {
    return view('news');
})->name('noticias');

Route::get('/novidades', function () {
    return redirect()->route('noticias');
});