<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

     protected $fillable = [
        'id',
        'titulo',
        'tipo',
        'detalles',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
