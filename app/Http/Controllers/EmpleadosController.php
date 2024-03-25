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
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellidoP' => 'required|string|max:255',
                'apellidoM' => 'required|string|max:255',
                'puesto' => 'required|string|max:255',
                'departamento' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

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

    public function update(Request $request, Empleados $empleado)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellidoP' => 'required|string|max:255',
                'apellidoM' => 'required|string|max:255',
                'puesto' => 'required|string|max:255',
                'departamento' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $empleado->update($request->all());

        return redirect()->route('empleados.index');
    }

    public function destroy(Empleados $empleado) // Cambia $empleados a $empleado
    {
        $empleado->delete();
        return redirect()->route('empleados.index');
    }
}
