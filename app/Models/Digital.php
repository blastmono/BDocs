<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Digital extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ejemplares',
        'hojas',
        'materia_id',
        'num_doc',
        'clasificacion',
        'fecha_doc',
        'objeto',
        'organizacion_id',//origen
        'tipo_documento_id',
        'prefijo',
        'tipo_tramite_id',
        'user_id',
        'impreso',
        'rutaArchivo',
        'enviado',
        'plazo',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class);
    }
    public function tipo_documento()
    {
        return $this->belongsTo(tipoDocumento::class);
    }
    public function tipo_tramite()
    {
        return $this->belongsTo(tipoTramite::class);
    }
}
