<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|string|confirmed', // Agrega la regla 'confirmed'
            ]);
        } catch (ValidationException $e) {            
            // Manejar la excepción de validación aquí, como redireccionar de nuevo al formulario con los errores
            return redirect()->back()->withErrors($e->errors())->withInput();
        }                
        //dd($validatedData);
        // Crea un nuevo usuario
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);                                

        // Redirecciona al usuario a la página de inicio de sesión
        return redirect('/')->with('success', 'Cuenta creada correctamente');
    }
}
