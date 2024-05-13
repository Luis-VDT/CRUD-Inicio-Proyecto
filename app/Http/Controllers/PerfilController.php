<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleados;
use Illuminate\Validation\ValidationException;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('perfil.edit', compact('user'));
    }

    public function update(Request $request, Empleados $empleado)
    {
        $empleado = Auth::user(); 
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
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();            
        }
        
        $empleado->update($request->except(['password', 'foto_perfil', 'privilegios_admin']));

        
        if ($request->password) {
            $empleado->password = bcrypt($request->password);
        }
               
        $empleado->save();

        return redirect()->route('perfil.edit');
    }    
}
