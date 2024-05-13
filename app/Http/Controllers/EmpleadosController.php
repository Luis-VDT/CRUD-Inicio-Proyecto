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
        //dd($request->all());        
        try {        
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellidoP' => 'required|string|max:255',
                'apellidoM' => 'required|string|max:255',
                'puesto' => 'required|string|max:255',
                'departamento' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
                'email' => 'required|email|unique:empleados|max:255',
                'password' => 'required|string|confirmed',
                'privilegios_admin' => 'required|boolean',
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
                    'email' => $request->email,
                    'password' => bcrypt($request->password), 
                    'privilegios_admin' => $request->privilegios_admin,
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
    


    public function show(Empleados $empleado) 
    {
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleados $empleado)
    {
        //dd($empleado); // Imprime el contenido de $empleado
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleados $empleado)
    {
        //dd($request->all());
        //dd($request->file('foto_perfil'));
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellidoP' => 'required|string|max:255',
                'apellidoM' => 'required|string|max:255',
                'puesto' => 'required|string|max:255',
                'departamento' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
                'email' => 'required|email|max:255',
                'password' => 'required|string|confirmed',
                'privilegios_admin' => 'required|boolean',
                'foto_perfil' => 'image|mimes:jpeg,png,jpg,gif|max:2048' , // Max 2MB
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();            
        }
        
        $empleado->update($request->except(['password', 'foto_perfil']));

        // Actualizar la contraseña con cifrado
        if ($request->password) {
            $empleado->password = bcrypt($request->password);
        }

        // Actualizar la foto de perfil
        if ($request->hasFile('foto_perfil')) {
            // Eliminar la foto de perfil antigua
            Storage::disk('public')->delete($empleado->foto_perfil);

            // Almacenar la nueva foto de perfil
            $rutaImagen = $request->file('foto_perfil')->store('img', 'public');
            $empleado->foto_perfil = $rutaImagen;
        } else {
            // Si no se proporciona una nueva imagen, mantener la antigua
            $empleado->foto_perfil = $empleado->getOriginal('foto_perfil');
        }

        // Guardar los cambios en la base de datos
        $empleado->save();

        return redirect()->route('empleados.index');
    }



    public function destroy(Empleados $empleado) // Cambia $empleados a $empleado
    {
        Storage::disk('public')->delete($empleado->foto_perfil);
        $empleado->delete();
        return redirect()->route('empleados.index');
    }
}
