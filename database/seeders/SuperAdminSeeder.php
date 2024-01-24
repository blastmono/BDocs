<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crea un Super Admin
        $superAdmin = User::create([
            'rut'=>'17341434',
            'grado'=>'CAP',
            'nombres'=>'Marco Rodrigo',
            'apellidoPaterno'=>'MIRANDA',
            'apellidoMaterno'=>'MORALES',
            'institucion_id'=>1,
            'organizacion_id'=>1,
            'email'=>'mmiranda@emco.mil',
            'password'=> Hash::make('Mono'),
        ]);
        $superAdmin->assignRole('Super Admin');

        //Crea un Document Manager
        $documentManager = User::factory()->create([
            'rut'=>'17131225',
            'grado'=>'CAP',
            'nombres'=>'Maria Alejandra',
            'apellidoPaterno'=>'BRAVO',
            'apellidoMaterno'=>'CORREA',
            'institucion_id'=>1,
            'organizacion_id'=>9,
            'email'=>'mbravo@emco.mil',
            'password'=> Hash::make('Mono'),
        ]);
        $documentManager->assignRole('Document Manager');       
        
        $auditoria = User::create([
            'rut'=>'27632564',
            'grado'=>'CAP',
            'nombres'=>'Maximiliano Santino',
            'apellidoPaterno'=>'MIRANDA',
            'apellidoMaterno'=>'BRAVO',
            'institucion_id'=>1,
            'organizacion_id'=>1,
            'email'=>'mmirandab@emco.mil',
            'password'=> Hash::make('Mono'),
        ]);
        $auditoria->assignRole('Auditor');
    }
}
