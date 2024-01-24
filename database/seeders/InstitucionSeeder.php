<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institucion;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Institucion::create([
            'sigla'=>'EJTO',
            'Nombre'=>'Ejército de Chile',
            'imagen'=>'avatar5.png'
        ]);
    }
}
