<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;

class Empleados extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellidoP', 'apellidoM', 'puesto', 'departamento', 'fecha_nacimiento', 'proyecto_id', 'foto_perfil'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
