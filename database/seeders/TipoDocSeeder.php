<?php

namespace Database\Seeders;

use App\Models\tipoDocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tipoDocumento::create([
            'nombre'=>'Oficio',
        ]);
        tipoDocumento::create([
            'nombre'=>'Memo',
        ]);
        tipoDocumento::create([
            'nombre'=>'Resolucion',
        ]);
        tipoDocumento::create([
            'nombre'=>'Mensaje',
        ]);
    }
}
