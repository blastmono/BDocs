<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoTramite extends Model
{
    use HasFactory;
    protected $fillable = [
        'sigla',
        'nombre',
    ];
}
