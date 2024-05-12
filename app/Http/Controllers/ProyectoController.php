<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Empleados;
use App\Models\Herramienta;
use Illuminate\Validation\ValidationException;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::with('empleados')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = Empleados::all();
        $herramientas = Herramienta::all();
        return view('proyectos.create', compact('empleados', 'herramientas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'empleados' => 'required|array|exists:empleados,id',
            'herramientas' => 'required|array|exists:herramientas,id',
        ]);

        // Creación del proyecto
        $proyecto = new Proyecto;
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->save();

        // Asignación de empleados al proyecto
        foreach ($request->empleados as $empleado_id) {
            $empleado = Empleados::find($empleado_id);
            $empleado->proyecto_id = $proyecto->id;
            $empleado->save();
        }

        // Asignación de herramientas al proyecto
        foreach ($request->herramientas as $herramienta_id) {
            $proyecto->herramientas()->attach($herramienta_id);
        }

        return redirect()->route('proyectos.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        $empleados = Empleados::all();
        $herramientas = Herramienta::all();        
        return view('proyectos.edit', compact('proyecto','empleados', 'herramientas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'empleados' => 'required|array|exists:empleados,id',
                'herramientas' => 'required|array|exists:herramientas,id',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();            
        }

        // Actualizar los campos individuales
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->save();

        // Desasignar todos los empleados y herramientas actuales
        $proyecto->empleados()->update(['proyecto_id' => null]);
        $proyecto->herramientas()->detach();

        // Asignar los nuevos empleados y herramientas
        foreach ($request->empleados as $empleado_id) {
            $empleado = Empleados::find($empleado_id);
            $empleado->proyecto_id = $proyecto->id;
            $empleado->save();
        }

        foreach ($request->herramientas as $herramienta_id) {
            $proyecto->herramientas()->attach($herramienta_id);
        }

        return redirect()->route('proyectos.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('proyectos.index');
    }
}
