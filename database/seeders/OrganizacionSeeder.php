<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizacion;

class OrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        Organizacion::factory()->create([
            'sigla'=>'MDN',
            'nombre'=>'Ministerio de Defensa Nacional',
            'organizacion_id' => 1,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'EMCO',
            'nombre'=>'Estado Mayor Conjunto',
            'organizacion_id' => 1,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'JEMCO',
            'nombre'=>'Jefatura del Estado Mayor Conjunto',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'SEGEMCO',
            'nombre'=>'Secretaria General del EMCO',
            'organizacion_id' => 3,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'ASJUR',
            'nombre'=>'ASESORIA JURIDICA',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'CONTE',
            'nombre'=>'Contraloria Interna del Estado Mayor Conjunto',
            'organizacion_id' => 3,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'SUBJEMCO',
            'nombre'=>'Subjefatura del Estado Mayor Conjunto',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'CONGE',
            'nombre'=>'Oficina de control de Gestion del Estado Mayor Conjunto',
            'organizacion_id' => 7,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DIPRO',
            'nombre'=>'Direccion de Proyectos y Tecnologias Estrategicas',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DAG',
            'nombre'=>'Direccion Apoyos Generales',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DIPERLOG',
            'nombre'=>'Direccion de Personal y Lógistica',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DID',
            'nombre'=>'Direccion de Inteligencia de la Defensa',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DOPCON',
            'nombre'=>'Direccion de Operaciones y Conduccion Conjunta',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DIPLANCO',
            'nombre'=>'Direccion de Planificacion Conjunta',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DIREDENCO',
            'nombre'=>'Direccion de Educacion, Doctrina y Entrenamiento Conjunto',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DIFEMCO',
            'nombre'=>'Direccion de Finanzas',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'DAI',
            'nombre'=>'Direccion de Asuntos Internacionales',
            'organizacion_id' => 2,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'SSD',
            'nombre'=>'Subsecretaria de Defensa',
            'organizacion_id' => 1,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'SSFA',
            'nombre'=>'Direccion de Asuntos Internacionales',
            'organizacion_id' => 1,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'EJTO',
            'nombre'=>'Ejercito de Chile',
            'organizacion_id' => 1,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'ARMADA',
            'nombre'=>'Armada de Chile',
            'organizacion_id' => 1,
        ]);
        Organizacion::factory()->create([
            'sigla'=>'FACH',
            'nombre'=>'Fuerza Aerea de Chile',
            'organizacion_id' => 1,
        ]);
    }
}
