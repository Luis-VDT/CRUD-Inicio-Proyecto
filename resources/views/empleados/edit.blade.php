<!-- resources/views/empleados/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Editar empleado</title>
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
                    @if ($empleado->foto_perfil)
                        <div id="image-preview" class="col-lg-5 d-none d-lg-block bg-register-image" style="background-image: url('{{ asset('storage/' . $empleado->foto_perfil) }}');"></div>
                    @else
                    <div id="image-preview" class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    @endif                    
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Editar empleado</h1>
                            </div>
                            <form method="POST" action="{{ route('empleados.update', $empleado) }}" class="user">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nombre" name="nombre" value="{{ $empleado->nombre }}" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="apellidoP" name="apellidoP" value="{{ $empleado->apellidoP }}" placeholder="Apellido Paterno">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="apellidoM" name="apellidoM" value="{{ $empleado->apellidoM }}" placeholder="Apellido Materno">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="departamento" name="departamento" value="{{ $empleado->departamento }}" placeholder="Departamento">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="puesto" name="puesto" value="{{ $empleado->puesto }}" placeholder="Puesto">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $empleado->fecha_nacimiento }}" placeholder="Fecha de Nacimiento">
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" value="{{$empleado->email}}" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"   id="password" name="password" placeholder="Contraseña" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Privilegios de administrador:</label><br>
                                    <div class="form-check">                                        
                                        <input class="form-check-input" type="radio" name="privilegios_admin" id="privilegios_admin1" value="0">                                        
                                        <label class="form-check-label" for="privilegios_admin1">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check">                                        
                                        <input class="form-check-input" type="radio" name="privilegios_admin" id="privilegios_admin2" value="1" >                                        
                                        <label class="form-check-label" for="privilegios_admin2">
                                            Sí
                                        </label>
                                    </div>
                                </div>                                
                                
                                <button type="submit" class="btn btn-primary btn-user btn-block">Actualizar</button>
                            </form>
                            <br>
                            <br>
                            <div class="form-group">
                                <a href="{{ asset('storage/' . $empleado->foto_perfil) }}" download class="btn btn-primary">
                                    Descargar foto de perfil actual
                                </a>
                            </div>
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
    <script>
        document.getElementById('foto_perfil').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('image-preview').style.backgroundImage = 'url(' + event.target.result + ')';
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>    
</body>
</html>
