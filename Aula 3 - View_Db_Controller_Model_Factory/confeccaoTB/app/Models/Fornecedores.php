<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornecedores extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cnpj', 'email', 'telefone'];
}
