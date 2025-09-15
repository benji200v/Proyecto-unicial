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
    Schema::create('equipos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('usuario_id')->constrained()->onDelete('cascade');
        $table->string('marca');
        $table->string('modelo');
        $table->string('procesador');
        $table->string('ram');
        $table->string('numeor_de_serie')->unique();
        $table->string('disco_duro');
        $table->string('sistema_operativo');
        $table->string('ip')->unique();
        $table->enum('categoria', ['personal', 'escritorio']);
        $table->enum('estado', ['activo', 'baja'])->default('activo');
        $table->text('descripcion_baja')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
