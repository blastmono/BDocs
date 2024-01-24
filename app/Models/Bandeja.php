<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandeja extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento_id',
        'user_id',
        'estado_id'
    ];
}
