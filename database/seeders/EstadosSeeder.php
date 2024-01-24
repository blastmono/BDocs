<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estado::create([
            'nombre'=>'Enviado',
            'descripcion'=>'El documento fue despachado por la plana mayor de Origen.',
            'activo'=>1
        ]);
        Estado::create([
            'nombre'=>'Recibido',
            'descripcion'=>'El documento se encuentra en la Plana Mayor en espera de ser entregado a quien corresponda.',
            'activo'=>1
        ]);
        Estado::create([
            'nombre'=>'Entregado',
            'descripcion'=>'El documento fue entregado a quien corresponde conforme a las disposiciones del mando.',
            'activo'=>1
        ]);
        Estado::create([
            'nombre'=>'Espera de Respuesta',
            'descripcion'=>'El documento se encuentra en espera de que quien corresponde realice la respuesta del documento.',
            'activo'=>1
        ]);
        Estado::create([
            'nombre'=>'Leido',
            'descripcion'=>'El Documento ha sido leido por el receptor.',
            'activo'=>1
        ]);
    }
}
