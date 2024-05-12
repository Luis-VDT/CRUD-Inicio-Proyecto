<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Detalle del proyecto</title>
    <!-- Custom fonts for this template -->
    <link href="{{ asset('resources/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Detalle del Proyecto {{ $proyecto->nombre }}</h1>
                            </div>
                            <div class="user">
                                <div class="form-group">
                                    <p class="form-control form-control-user">Nombre: {{ $proyecto->nombre }}</p>
                                </div>
                                <div class="form-group">
                                    <p class="form-control form-control-user">Descripción: {{ $proyecto->descripcion }}</p>
                                </div>
                                <div class="form-group">
                                    <p class="form-control form-control-user">Empleados:</p>
                                    <ul>
                                        @foreach ($proyecto->empleados as $empleado)
                                            <li>{{ $empleado->nombre }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <p class="form-control form-control-user">Herramientas:</p>
                                    <ul>
                                        @foreach ($proyecto->herramientas as $herramienta)
                                            <li>{{ $herramienta->nombre }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <a href="{{ route('proyectos.index') }}" class="btn btn-primary btn-user btn-block">Volver a la lista de proyectos</a>
                        </div>                        
                    </div>
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ... -->
</body>
</html>
