<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Character extends Model
{
    use HasFactory;

    protected $table = 'characters';

    protected $fillable = [
        'name',
        'constellation',
        'element',
        'weapon',
        'region',
        'stars',
        'playstyle',
        'mechanics',
        'affiliation',
        'image_url',
    ];
}
