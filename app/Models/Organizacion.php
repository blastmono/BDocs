<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'sigla',
        'nombre',
        'organizacion_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
