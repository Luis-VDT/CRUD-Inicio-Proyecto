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
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('herramienta_id'); //clave foránea
            $table->foreign('herramienta_id')->references('id')->on('herramientas');
            $table->unsignedBigInteger('empleado_id'); //clave foránea
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->timestamp('fecha_prestamo')->useCurrent();
            $table->timestamp('fecha_devolucion')->nullable(); // llenado al devolver
            $table->boolean('devuelta')->default(false); // cambiado al devolver
            $table->text('comentarios')->nullable(); // llenado al devolver            
            $table->timestamps();                        
        });                
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora');
    }
};
