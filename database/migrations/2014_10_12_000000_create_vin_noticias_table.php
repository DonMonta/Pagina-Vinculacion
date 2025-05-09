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
        Schema::create('vin_noticias', function (Blueprint $table) {
            $table->id('id_noticia');
            $table->string('titulo_noticia');
            $table->text('contenido_noticia');
            $table->date('fecha_noticia')->nullable();
            $table->binary('fotografia')->nullable();
            $table->timestamps(false);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vin_noticias');
    }
};
