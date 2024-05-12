<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;

class Herramienta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'cantidadDisponible'];

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'herramienta_proyecto')
                    ->withPivot('cantidad_asignada')
                    ->withTimestamps();
    }
}

