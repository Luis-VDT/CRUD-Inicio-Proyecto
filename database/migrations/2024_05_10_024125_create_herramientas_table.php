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
        Schema::create('herramientas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('cantidadDisponible');
            $table->text('descripcion');
        
            $table->timestamps();
        });
        
        // Tabla intermedia para la relacion m:n entre proyectos y herramientas
        Schema::create('herramienta_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('herramienta_id');
            $table->integer('cantidad_asignada')->default(0);
        
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
            $table->foreign('herramienta_id')->references('id')->on('herramientas')->onDelete('cascade');
                    
            $table->timestamps();
        });
        
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herramientas');
    }
};
