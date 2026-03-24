<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produto extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Produto $produto) {
            if (empty($produto->slug)) {
                $produto->slug = Str::slug($produto->nome);
            }
        });
    }
}
