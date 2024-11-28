<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('rol')->default('trabajador'); // Rol: trabajador o administrador
            $table->string('fotografia')->nullable();    // Fotografía
            $table->string('cargo')->nullable();         // Cargo del usuario
            $table->string('celular', 15)->nullable();   // Celular
            $table->string('direccion')->nullable();     // Dirección
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rol', 'fotografia', 'cargo', 'celular', 'direccion']);
        });
    }
    
};
