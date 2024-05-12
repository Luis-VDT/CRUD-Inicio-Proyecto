<!-- resources/views/empleados/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herramientas</title>
    <link href="{{asset('resources/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('resources/css/sb-admin-2.min.css') }}">
</head>
<body>
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-gradient-primary topbar mb-4 static-top shadow">
            <a class="navbar-brand" href="#">ProjectManager</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                <!-- Menú de Empleados -->
                <li class="nav-item">
                    <a class="nav-link" href="/empleados"  role="button">
                    Empleados
                    </a>                    
                </li>
                <!-- Menú de Proyectos -->
                <li class="nav-item">
                    <a class="nav-link" href="/proyectos"  role="button">
                        Proyectos
                    </a>                    
                                   
                </li>
                <!-- Menú de Herramientas -->
                <li class="nav-item">
                    <a class="nav-link" href="/herramientas"  role="button" >
                    Herramientas
                    </a>                    
                </li>
                </ul>
            </div>            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline ">{{ Auth::user()->name }}</span>

                        <img class="img-profile rounded-circle"
                            src="{{asset('resources/img/undraw_profile.svg')}}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">                        
                        <form action="/logout" method="POST">
                            @csrf
                            <a class="dropdown-item" href="#" onclick="this.closest('form').submit()" data-toggle="modal" data-target="#logoutModal">                        
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout                            
                            </a>
                        </form>                        
                    </div>
                </li>
            </ul>
        </nav>      
        
        
        <div class="container mt-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Herramientas</h1>
                    <table class="table">
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Descripcción</th>                            
                        </tr>
                        @foreach ($herramientas as $herramienta)
                            <tr>
                                <td>{{ $herramienta->nombre }}</td>
                                <td>{{ $herramienta->cantidadDisponible }}</td>
                                <td>{{ $herramienta->descripcion }}</td>                                
                                <td>
                                    <a href="{{ route('herramientas.show', $herramienta) }}">Ver detalles</a>
                                    <a href="{{ route('herramientas.edit', $herramienta) }}">Editar</a>
                                    <form method="POST" action="{{ route('herramientas.destroy', $herramienta) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="{{ route('herramientas.create') }}">Crear nueva herramienta</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('resources/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('resources/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('resources/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('resources/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('resources/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('resources/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('resources/js/demo/chart-pie-demo.js')}}"></script>
</body>
</html>