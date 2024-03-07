<!-- resources/views/empleados/create.blade.php -->

<h1>Crear nuevo empleado</h1>

<form method="POST" action="{{ route('empleados.store') }}">
    @csrf
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre">
    <label for="apellidoP">Apellido Paterno:</label>
    <input type="text" id="apellidoP" name="apellidoP">
    <label for="apellidoM">Apellido Materno:</label>
    <input type="text" id="apellidoM" name="apellidoM">
    <label for="departamento">Departamento:</label>
    <input type="text" id="departamento" name="departamento">
    <label for="puesto">Puesto:</label>
    <input type="text" id="puesto" name="puesto">
    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">
    <button type="submit">Crear</button>
</form>
