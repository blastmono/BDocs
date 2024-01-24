<?php

use App\Models\Documento;
use App\Models\Estado;
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
        Schema::create('distribucions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Documento::class); //Documento
            $table->string('origen');
            $table->foreignIdFor(Organizacion::class);// Organizacion destino
            $table->foreignIdFor(Estado::class); //Estado del Documento
            $table->foreignIdFor(User::class);//Usuario de destino
            $table->integer('ejemplar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribucions');
    }
};
