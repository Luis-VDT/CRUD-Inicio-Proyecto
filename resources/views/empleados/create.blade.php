<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Crear nuevo empleado</title>
    <!-- Custom fonts for this template -->
    <link href="{{ asset('resources/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
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
                    <div id="image-preview" class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crear nuevo empleado</h1>
                            </div>
                            <form method="POST" action="{{ route('empleados.store') }}" enctype="multipart/form-data" class="user">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="apellidoP" name="apellidoP" placeholder="Apellido Paterno">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="apellidoM" name="apellidoM" placeholder="Apellido Materno">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="departamento" name="departamento" placeholder="Departamento">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="puesto" name="puesto" placeholder="Puesto">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha de Nacimiento">
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Contraseña" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Privilegios de administrador:</label><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="privilegios_admin" id="privilegios_admin1" value="0" checked>
                                        <label class="form-check-label" for="privilegios_admin1">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="privilegios_admin" id="privilegios_admin2" value="1">
                                        <label class="form-check-label" for="privilegios_admin2">
                                            Sí
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="foto_perfil" accept="image/*" name="foto_perfil">
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-user btn-block">Crear</button>
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
