<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'documento_id',
        'organizacion_id',
        'estado_id',
        'user_id',
        'origen',
        'ejemplar'
    ];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class);
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
