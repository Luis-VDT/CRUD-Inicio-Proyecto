<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use Illuminate\Validation\ValidationException;

class HerramientaController extends Controller
{
    public function index()
    {
        $herramientas = Herramienta::all();
        return view('herramientas.index', compact('herramientas'));
    }

    public function create()
    {
        return view('herramientas.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'cantidadDisponible' => 'required|integer',
                'descripcion' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();            
        }
        Herramienta::create($request->all());
        return redirect()->route('herramientas.index');
    }

    public function show(Herramienta $herramienta)
    {
        return view('herramientas.show', compact('herramienta'));
    }

    public function edit(Herramienta $herramienta)
    {
        return view('herramientas.edit', compact('herramienta'));
    }

    public function update(Request $request, Herramienta $herramienta)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'cantidadDisponible' => 'required|integer',
                'descripcion' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();            
        }
        $herramienta->update($request->all());
        return redirect()->route('herramientas.index');
    }

    public function destroy(Herramienta $herramienta)
    {
        $herramienta->delete();
        return redirect()->route('herramientas.index');
    }
}

