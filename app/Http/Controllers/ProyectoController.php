<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Empleados;
use App\Models\Herramienta;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


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
        $empleados = Empleados::whereNull('proyecto_id')->get();        
        $herramientas = Herramienta::where('cantidadDisponible', '>', 0)->get();
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

        // crear proyecto a base de datos
        DB::beginTransaction();

        try {            
            $proyecto = new Proyecto;
            $proyecto->nombre = $request->nombre;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->save();

            // asignación de empleados al proyecto
            foreach ($request->empleados as $empleado_id) {
                $empleado = Empleados::find($empleado_id);
                if($empleado->proyecto_id){
                    return redirect()->back()->with('error', 'El empleado ' . $empleado->nombre . ' ya está asignado a otro proyecto.');
                }
                $empleado->proyecto_id = $proyecto->id;
                $empleado->save();
            }

            // asignación de herramientas al proyecto
            foreach ($request->herramientas as $herramienta_id) {
                $herramienta = Herramienta::find($herramienta_id);
                if ($herramienta->cantidadDisponible <= 0) {                
                    return redirect()->back()->with('error', 'La herramienta ' . $herramienta->nombre . ' no tiene cantidad disponible.');
                }
                $proyecto->herramientas()->attach($herramienta_id);
                $herramienta->cantidadDisponible--;
                $herramienta->save();
            }

            // si tno hay errores se confirma la creacion del proyecto
            DB::commit();

            return redirect()->route('proyectos.index');
        } catch (\Exception $e) {
            // si hay erroes se revierte la creacion
            DB::rollback();
            return redirect()->back()->with('error', 'Ocurrió un error al crear el proyecto. Por favor, inténtalo de nuevo.');
        }
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
        $empleados = Empleados::whereNull('proyecto_id')->get();        
        $herramientas = Herramienta::where('cantidadDisponible', '>', 0)->get();
        return view('proyectos.edit', compact('proyecto','empleados', 'herramientas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'empleados' => 'required|array|exists:empleados,id',
            'herramientas' => 'required|array|exists:herramientas,id',
        ]);
        DB::beginTransaction();
        try {
            // desasigna todos los empleados y herramientas actuales
            foreach ($proyecto->herramientas as $herramienta) {
                $herramienta->cantidadDisponible += $herramienta->pivot->cantidad_asignada;
                $herramienta->save();
            }
            $proyecto->empleados()->update(['proyecto_id' => null]);
            $proyecto->herramientas()->detach();

            // actualiza los campos individuales
            $proyecto->nombre = $request->nombre;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->save();

            // asigna los nuevos empleados y herramientas
            foreach ($request->empleados as $empleado_id) {
                $empleado = Empleados::find($empleado_id);
                if($empleado->proyecto_id){
                    return redirect()->back()->with('error', 'El empleado ' . $empleado->nombre . ' ya está asignado a otro proyecto.');
                }
                $empleado->proyecto_id = $proyecto->id;
                $empleado->save();
            }

            foreach ($request->herramientas as $herramienta_id) {
                $herramienta = Herramienta::find($herramienta_id);
                if ($herramienta->cantidadDisponible <= 0) {                
                    return redirect()->back()->with('error', 'La herramienta ' . $herramienta->nombre . ' no tiene cantidad disponible.');
                }
                $proyecto->herramientas()->attach($herramienta_id);
                $herramienta->cantidadDisponible--;
                $herramienta->save();
            }            
            DB::commit();
            return redirect()->route('proyectos.index');
        } catch (\Exception $e) {            
            DB::rollback();
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el proyecto. Por favor, inténtalo de nuevo.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {        
        foreach ($proyecto->herramientas as $herramienta) {
            $herramienta->cantidadDisponible += $herramienta->pivot->cantidad_asignada;
            $herramienta->save();
        }        
        $proyecto->empleados()->update(['proyecto_id' => null]);
        $proyecto->delete();
        return redirect()->route('proyectos.index');
    }

}
