<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleados; // Cambia 'User' a 'Empleados'
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('login.register');
    }

    public function register(Request $request)
    {        
        // Valida los datos del formulario
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellidoP' => 'required|string|max:255',
                'apellidoM' => 'required|string|max:255',
                'email' => 'required|email|unique:empleados|max:255', // Cambia 'users' a 'empleados'
                'password' => 'required|string|confirmed', // Agrega la regla 'confirmed'
                'privilegios_admin' => 'required|boolean', // Agrega la validación para 'privilegios_admin'
            ]);
        } catch (ValidationException $e) {            
            // Manejar la excepción de validación aquí, como redireccionar de nuevo al formulario con los errores
            return redirect()->back()->withErrors($e->errors())->withInput();
        }                
        //dd($validatedData);
        // Crea un nuevo empleado     
        if ($request->hasFile('foto_perfil')) {
            $rutaImagen = $request->file('foto_perfil')->store('img', 'public');                 
            Empleados::create([
                'nombre' => $request->nombre,
                'apellidoP' => $request->apellidoP,
                'apellidoM' => $request->apellidoM,
                'puesto' => $request->puesto,
                'departamento' => $request->departamento,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'privilegios_admin' => $validatedData['privilegios_admin'], // Agrega 'privilegios_admin' a la creación del empleado
                'foto_perfil' => $rutaImagen,
            ]);
        } else {                
            // Si no se proporciona ninguna imagen, crear el empleado sin ella
            Empleados::create($request->except('foto_perfil'));
        }

        // Redirecciona al usuario a la página de inicio de sesión
        return redirect('/')->with('success', 'Cuenta creada correctamente');
    }
}
