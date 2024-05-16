<?php
// Verificar si se han recibido los parámetros necesarios
if(isset($_REQUEST['tokenuser']) && isset($_REQUEST['id_usuario'])) {

    // Incluir la conexión a la base de datos
    include('conexion.php');

    // Limpiar y validar los datos recibidos del formulario
    $id_usuario = mysqli_real_escape_string($conn, $_REQUEST['id_usuario']);
    $tokenuser = mysqli_real_escape_string($conn, $_REQUEST['tokenuser']);

    // Si se ha enviado el formulario de actualización de contraseña
    if(isset($_POST['contraseña'])) {
        // Limpiar y validar la nueva contraseña
        $contraseña = mysqli_real_escape_string($conn, $_POST['contraseña']);

        // Hash de la contraseña
        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $updatecontraseña = "UPDATE registro SET contraseña='$contraseña_hash' WHERE id_usuario='$id_usuario' AND tokenuser='$tokenuser'";
        $sql = mysqli_query($conn, $updatecontraseña);

        if($sql) {
            echo "Contraseña actualizada exitosamente.";
            // Redirigir a alguna página después de actualizar la contraseña
            // header("Location: index.php");
            // exit();
        } else {
            echo "Error al actualizar la contraseña: " . mysqli_error($conn);
        }
    }
} else {
    // Mostrar un mensaje de error si no se reciben los parámetros necesarios
    echo "No se han recibido los parámetros necesarios para restablecer la contraseña.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Recuperar contraseña | Technovation Girl</title>
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
      </ul>
    </div>
  </div>
</nav>
<br>    
<section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="card bg-primary text-left text-white">
                        <h4>Restablece tu contraseña</h4>  
                    </div>
                    <form action="archivos/actualizarcontraseña.php" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>
                                    
                                   <div class="form-group">
                                    <label for="contraseña">Nueva contraseña</label>
                                    <input type="text" class="form-control" name="contraseña" id="contraseña" placeholder="Introduce tu nueva contraseña" required>
                                    
                                   </div> 
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-outline-success btn-lg">Enviar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
    <br>

<footer class="footer bg-dark text-white py-4">
  <div class="container">
    <div class="row">
      <div class="text-center">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="bi bi-facebook text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-twitter text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-instagram text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-linkedin text-white"></i></a></li>
        </ul>
      </div>
      <div class="text-center">
        <p class="text-sm text-center">© 2024 Technovation. Todos los derechos reservados.</p>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>