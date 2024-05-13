<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Crear nueva herramienta</title>
    <!-- Custom fonts for this template -->
    <link href="{{ asset('resources/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-light">
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
                    <span class="mr-2 d-none d-lg-inline ">{{ Auth::user()->nombre }}</span>
                    <img class="img-profile rounded-circle"
                        src="{{asset('resources/img/undraw_profile.svg')}}">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">                        
                    <form action="/logout" method="POST">
                        @csrf
                        <a class="dropdown-item" href="{{ route('perfil.edit', Auth::user()) }}">                        
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Mi Perfil                            
                        </a>
                        <a class="dropdown-item" href="#" onclick="this.closest('form').submit()" data-toggle="modal" data-target="#logoutModal">                        
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Salir                            
                        </a>
                    </form>                        
                </div>
            </li>
        </ul>
    </nav>      
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crear nueva herramienta</h1>
                            </div>
                            <form method="POST" action="{{ route('herramientas.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="cantidadDisponible">Cantidad Disponible</label>
                                    <input type="number" class="form-control" id="cantidadDisponible" name="cantidadDisponible" required>
                                    </select>                                    
                                </div>                                

                                <button type="submit" class="btn btn-primary">Crear Herramienta</button>
                            </form>
                            <hr>                            
                        </div>
                    </div>
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
</body>
</html>
