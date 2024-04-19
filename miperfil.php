<?php
session_start();
if (empty($_SESSION["nombre"])) {
    header("location: inicio.php");   
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href= "css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Inicio | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  
    <style>
    /* Estilo personalizado para el área de carga */
    .upload-area {
      border: 2px dashed #ccc;
      padding: 20px;
      text-align: center;
      cursor: pointer;
    }
    .upload-area:hover {
      background-color: #f8f9fa;
    }
  </style>
  
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
          <a class="nav-link" href="miperfil.php">Mi perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="crearequipo.php">Crea tu equipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="encontrarequipo.php">Encuentra tu equipo</a>
        </li>
        <a class="nav-item nav-link text-justify ml-3 hover-primary" href="archivos/controlador_cerrarsesion.php">Salir</a>
      </ul>
    </div>
  </div>
</nav>

<div class="responsive bg-dark text-white py-4">
  <div class="row">
    <div class="col-md-8"> 
    <h1>
  <?php
   echo "Perfil de"." ".$_SESSION["nombre"]." ". $_SESSION["apellidos"];
  ?>
  </h1>
  <p>Aquí aparecerá toda la información de <?php echo $_SESSION["nombre"];?></p>
    </div>
  </div>
</div>

<div class="col-md-5">
    <div class="card mt-4 mb-4">
      <div class="card-body">
        <table class="table table-striped mb-2">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Cargo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $_SESSION["nombre"]; ?></td>
                <td><?php echo $_SESSION["apellidos"]; ?></td>
                <td><?php echo $_SESSION["fecha"]; ?></td>
                <td><?php echo $_SESSION["email"]; ?></td>
                <td><?php echo $_SESSION["contraseña"]; ?></td>
                <td><?php echo $_SESSION["cargo"]; ?></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="card mt-4 mb-4">
    <div class="card-header bg-primary text-white">Subida de contenido</div>
    <div class="card-body">
    <div class="col-md-10 justify-content-center">
    <div class="input-group">
      <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
      <button class="btn btn-outline-secondary btn-outline-success" type="button" id="inputGroupFileAddon04">Botón</button>
    </div>
    </div>
  </div>
  </div>
</div>

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