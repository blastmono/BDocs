<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;

    protected $fillable = [
        'direccion', //entrante o saliente
        'organizacion_id',
        'estado_id',
        'cumplido',
        'user_id',
        'entregado',
        'papel',
        'archivador',
        'originador',
        'copia',
        'org_control',
        'documento_id',
        'distribucion_id',
    ];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class);
    }

    public function distribucion()
    {
        return $this->belongsTo(Distribucion::class);
    }

}
