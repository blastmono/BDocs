<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'documento_id',
        'user_id',
        'actividad',
        'modulo'
    ];
}

