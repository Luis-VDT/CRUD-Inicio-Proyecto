<!-- resources/views/empleados/edit.blade.php -->

<h1>Editar empleado</h1>

<form method="POST" action="{{ route('empleados.update', $empleado) }}">
    @csrf
    @method('PUT')
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="{{ $empleado->nombre }}">
    <label for="apellidoP">Apellido Paterno:</label>
    <input type="text" id="apellidoP" name="apellidoP" value="{{ $empleado->apellidoP }}">
    <label for="apellidoM">Apellido Materno:</label>
    <input type="text" id="apellidoM" name="apellidoM" value="{{ $empleado->apellidoM }}">
    <label for="departamento">Departamento:</label>
    <input type="text" id="departamento" name="departamento" value="{{ $empleado->departamento }}">
    <label for="puesto">Puesto:</label>
    <input type="text" id="puesto" name="puesto" value="{{ $empleado->puesto }}">
    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $empleado->fecha_nacimiento }}">
    <button type="submit">Actualizar</button>
</form>
