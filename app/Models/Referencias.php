<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencias extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'documento_id',
        'referencia',
    ];

}
