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

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href= "css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Inicio | Technovation Girl</title>
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

<div class="container">  
  <h2 class="mt-4">
  <?php
   echo "Perfil de"." ".$_SESSION["nombre"]." ". $_SESSION["apellidos"];
  ?>
  </h2>
  <p>Aquí aparecerá toda la información de <?php echo $_SESSION["nombre"];?></p>
</div>

<div class="table-responsive">
    <table class="table table-striped">
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


    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>