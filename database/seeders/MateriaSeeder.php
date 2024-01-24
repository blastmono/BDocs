<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materia::create([
            'codigo'=>'1000',
            'descripcion'=>'General de Personal',
        ]);
        Materia::create([
            'codigo'=>'2000',
            'descripcion'=>'General de Inteligencia',
        ]);
        Materia::create([
            'codigo'=>'3000',
            'descripcion'=>'General de Operaciones',
        ]);
    }
}
