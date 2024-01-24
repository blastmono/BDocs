<?php

namespace Database\Seeders;

use App\Models\tipoTramite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrefijoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tipoTramite::create([
            'sigla'=>'Zulu',
            'nombre'=>'Urgente'
        ]);
        tipoTramite::create([
            'sigla'=>'P',
            'nombre'=>'Prioritario'
        ]);
        tipoTramite::create([
            'sigla'=>'N',
            'nombre'=>'Normal'
        ]);
        tipoTramite::create([
            'sigla'=>'R',
            'nombre'=>'Rutina'
        ]);
    }
}
