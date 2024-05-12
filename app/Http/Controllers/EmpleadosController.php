<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


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
                'foto_perfil' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            ]);            
            if ($request->hasFile('foto_perfil')) {
                $rutaImagen = $request->file('foto_perfil')->store('img', 'public');                
                Empleados::create([
                    'nombre' => $request->nombre,
                    'apellidoP' => $request->apellidoP,
                    'apellidoM' => $request->apellidoM,
                    'puesto' => $request->puesto,
                    'departamento' => $request->departamento,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'foto_perfil' => $rutaImagen,
                ]);
            } else {                
                // Si no se proporciona ninguna imagen, crear el empleado sin ella
                Empleados::create($request->except('foto_perfil'));
            }
        } catch (ValidationException $e) {            
            return redirect()->back()->withErrors($e->errors())->withInput();            
        }
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
        Storage::disk('public')->delete($empleado->foto_perfil);
        $empleado->delete();
        return redirect()->route('empleados.index');
    }
}
