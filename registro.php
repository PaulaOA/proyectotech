<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Registro | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
</head>
<body>
    <a href="https://www.technovation.org" class="logo-holder">
        <img src="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/assets/img/logo.png" alt="logo" class="logo" />
    </a>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <nav class="navbar navbar-expand-lg bg-light">
                        <div class="container-fluid"> 
                            <a class="navbar-brand" href="index.php">Technovation Girl</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="registro.php">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="registros.php">Registros</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card bg-danger text-center text-white">
                        <h3>Formulario de registro</h3>  
                    </div>
                    <form action="archivos/registrar.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>
                                   <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Inserta tu nombre" required>
                                   </div> 

                                   <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Inserta tus apellidos" required>
                                   </div> 

                                   <div class="form-group">
                                    <label for="fecha">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Inserta tu segundo apellido" >
                                   </div> 

                                   <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Inserta tu email" >
                                   </div> 

                                   <div class="form-group">
                                   <label for="cargo" class="form-label">¿Quién eres?</label>
                                   <select id="cargo" class="form-select">
                                        <option selected>Elige una opción</option>
                                        <option>Mentor</option>
                                        <option>Participante</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-danger btn-lg">Registrar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>


    <form action="archivos/registrar.php" method="post">
        
        
    </form>
    <script src="js/bootstrap.min.js"></script>



</body>
</html>
