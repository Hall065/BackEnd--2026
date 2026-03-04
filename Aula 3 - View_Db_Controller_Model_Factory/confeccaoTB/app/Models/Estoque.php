<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = ['produto_name', 'produto_id', 'qntd'];

    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id');
    }
}