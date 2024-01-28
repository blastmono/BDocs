<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sigla',
        'nombre',
        'organizacion_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class);
    }
}
