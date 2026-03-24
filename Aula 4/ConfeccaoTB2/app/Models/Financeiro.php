<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
    ];
}
