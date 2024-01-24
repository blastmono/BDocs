<?php

use App\Models\Distribucion;
use App\Models\Documento;
use App\Models\Estado;
use App\Models\Materia;
use App\Models\Organizacion;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->integer('direccion');//1- Recepcionado ; 2-Salido
            $table->foreignIdFor(Documento::class)->nullable();
            $table->foreignIdFor(Organizacion::class);//Organizacion de destino
            $table->string('org_control');//Organizacion que registra el documento
            $table->foreignIdFor(Estado::class);//estado actual del documento
            $table->date('plazo')->nullable();
            $table->boolean('cumplido')->nullable();
            $table->foreignIdFor(User::class);//originador
            $table->string('entregado')->default('Digital');//Persona a quien se el entrego
            $table->boolean('papel')->default(0);
            $table->string('archivador')->nullable();//Identificacion del Archivador.
            $table->string('originador')->default('Digital');//quien crea el documento
            $table->boolean('copia')->default(0);//Indica si es copia informativa o original
            $table->foreignIdFor(Distribucion::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kardexes');
    }
};
