<?php

use App\Models\Documento;
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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Documento::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Organizacion::class);
            $table->integer('responsable');//persona a quien se le asigna la tarea
            $table->string('tarea');
            $table->text('detalle')->nullable();
            $table->boolean('completada')->default(false);
            $table->date('plazo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
