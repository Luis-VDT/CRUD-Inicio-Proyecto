<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empleados;

class Proyecto extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion'];

    public function empleados()
    {
        return $this->hasMany(Empleados::class);
    }

    public function herramientas()
    {
        return $this->belongsToMany(Herramienta::class, 'herramienta_proyecto')
                    ->withPivot('cantidad_asignada')
                    ->withTimestamps();
    }
}
