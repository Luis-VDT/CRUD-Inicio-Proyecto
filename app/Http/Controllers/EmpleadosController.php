<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function index()
    {
        $empleados = Empleados::all();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            // Agrega aquí más validaciones según los atributos de tu empleado
        ]);
        var_dump($request->only('nombre', 'apellidoP', 'apeliidoM', 'puesto', 'departamento', 'fecha_nacimiento', 'apellido_paterno'));         
        Empleados::create($request->only('nombre', 'apellidoP', 'apellidoM', 'puesto', 'departamento', 'fecha_nacimiento'));
        return redirect()->route('empleados.index');
    }

    public function show(Empleados $empleado) // Cambia $empleados a $empleado
    {
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleados $empleado) // Cambia $empleados a $empleado
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleados $empleado) // Cambia $empleados a $empleado
    {
        $request->validate([
            'nombre' => 'required',
            // Agrega aquí más validaciones según los atributos de tu empleado
        ]);

        $empleado->update($request->all());
        return redirect()->route('empleados.index');
    }

    public function destroy(Empleados $empleado) // Cambia $empleados a $empleado
    {
        $empleado->delete();
        return redirect()->route('empleados.index');
    }
}
