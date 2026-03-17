<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'status', 'valor'];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
}