<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\categoriaMateria;
use App\Models\materia;
use App\Models\User;
use App\Models\Organizacion;
use App\Models\tipoDocumento;
use App\Models\tipoTramite;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(materia::class);
            $table->integer('num_doc');
            $table->string('clasificacion');//Secreto;Reservado;Publico
            $table->date('fecha_doc'); //Fecha de creacion
            $table->longText('objeto');
            $table->foreignIdFor(Organizacion::class); //Unidad que Genera el Documento
            $table->foreignIdFor(tipoDocumento::class);//oficio; memo; res
            $table->string('prefijo')->nullable();
            $table->integer('ejemplares');
            $table->integer('hojas');
            $table->foreignIdFor(tipoTramite::class); //rutina, urgente, prioritario, urgente
            $table->foreignIdFor(User::class);//firmante
            $table->boolean('impreso')->default(0);
            $table->string('archivador')->nullable();//Ubicacion Fisica del Documento
            $table->longText('rutaArchivo');
            $table->boolean('enviado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
