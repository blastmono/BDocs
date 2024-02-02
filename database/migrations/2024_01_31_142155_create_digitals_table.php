<?php

use App\Models\Materia;
use App\Models\Organizacion;
use App\Models\tipoDocumento;
use App\Models\tipoTramite;
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
        Schema::create('digitals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Materia::class)->nullable();
            $table->integer('num_doc')->nullable();
            $table->string('clasificacion')->nullable();//Secreto;Reservado;Publico
            $table->date('fecha_doc')->nullable();; //Fecha de creacion
            $table->longText('objeto')->nullable();;
            $table->foreignIdFor(Organizacion::class)->nullable();; //Unidad que Genera el Documento
            $table->foreignIdFor(tipoDocumento::class)->nullable();;//oficio; memo; res
            $table->integer('ejemplares')->nullable();
            $table->integer('hojas')->nullable();
            $table->foreignIdFor(tipoTramite::class)->nullable(); //rutina, urgente, prioritario, urgente
            $table->foreignIdFor(User::class)->nullable();//firmante
            $table->longText('rutaArchivo')->nullable();
            $table->boolean('enviado')->default(0)->nullable();
            $table->longText('cuerpo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digitals');
    }
};
