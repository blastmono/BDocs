<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Documento;
use App\Models\User;
use App\Models\Estado;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bandejas', function (Blueprint $table) {
            $table->id();
            //Documento
            $table->foreignIdFor(Documento::class);
            //Bandeja de entrada (Destino)
            $table->foreignIdFor(User::class);
            //Estado del Documento
            $table->foreignIdFor(Estado::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bandejas');
    }
};
