<?php

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
        Schema::create('mienbros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('direccion');
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('email')->unique();
            $table->foreignId('grado_id')->constrained('grados')->onDelete('cascade');
            $table->text('fotografia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mienbros');
    }
};
