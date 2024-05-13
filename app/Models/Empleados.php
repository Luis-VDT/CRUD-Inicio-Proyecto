<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;

class Empleados extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['nombre', 'apellidoP', 'apellidoM', 'puesto', 'departamento', 'fecha_nacimiento', 'proyecto_id', 'foto_perfil', 'email', 'password', 'privilegios_admin'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
