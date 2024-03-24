<!-- resources/views/empleados/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="{{ asset('resources/css/sb-admin-2.min.css') }}">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Empleados</h1>
                <table class="table">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Departamento</th>
                        <th>Puesto</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->apellidoP }}</td>
                            <td>{{ $empleado->apellidoM }}</td>
                            <td>{{ $empleado->departamento }}</td>
                            <td>{{ $empleado->puesto }}</td>
                            <td>{{ $empleado->fecha_nacimiento }}</td>
                            <td>
                                <a href="{{ route('empleados.show', $empleado) }}">Ver detalles</a>
                                <a href="{{ route('empleados.edit', $empleado) }}">Editar</a>
                                <form method="POST" action="{{ route('empleados.destroy', $empleado) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <a href="{{ route('empleados.create') }}">Crear nuevo empleado</a>
            </div>
        </div>
    </div>
</body>
</html>
