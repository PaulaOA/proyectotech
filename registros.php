<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Registros | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
</head>

<body>
<nav class="navbar navbar-dark bg-success navbar-expand-lg static-top"> 
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/assets/img/logo.png" alt="..." height="36">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registros.php">Registros</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<br>        

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-primary card-outline text-center">
                        <h5>Registro de Usuarios</h5>
                        <?php
                        include "archivos/conexion.php";
                        $consulta = $conn->query("SELECT * FROM registro");
                        $row = mysqli_num_rows($consulta);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contraseña</th>
                                    <th scope="col">Cargo</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($guardar = $consulta->fetch_assoc()) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $guardar['id_usuario']; ?>
                                        </th>
                                        <td>
                                            <?php echo mb_strtoupper($guardar['nombre']); ?>
                                        </td>
                                        <td>
                                            <?php echo mb_strtoupper($guardar['apellidos']); ?>
                                        </td>
                                        <td>
                                            <?php echo mb_strtoupper($guardar['fecha']); ?>
                                        </td>
                                        <td>
                                            <?php echo mb_strtoupper($guardar['email']); ?>
                                        </td>
                                        <td>
                                            <?php echo mb_strtoupper($guardar['contraseña']); ?>
                                        </td>
                                        <td>
                                            <?php echo mb_strtoupper($guardar['cargo']); ?>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <a href="registro.php" class="btn btn-primary btn-lg">Nuevo Registro</a>
                </div>
            </div>
        </div>
    </section>
    <br>

    <footer class="footer bg-dark text-white py-4">
    <div class="container">
    <div class="row">
    <div class="col-md-8">
        <p>© 2024 Technovation. Todos los derechos reservados.</p>
      </div>
      <div class="text-center">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="bi bi-facebook text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-twitter text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-instagram text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-linkedin text-white"></i></a></li>
        </ul>
      </div>
    </div>
    </div>
    </footer>


    <script src="js/bootstrap.min.js"></script>
</body>
</html>