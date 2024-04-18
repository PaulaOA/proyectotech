<?php
session_start();
if (empty($_SESSION["nombre"])) {
    header("location: index.php");   
}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href= "css/bootstrap.min.css">
    <style>
    /* Estilo para las imágenes del carousel */
    .carousel-item img {
      width: 100%;
      height: 300px; /* Altura deseada para las imágenes */
      object-fit: cover; /* Ajustar la imagen para cubrir todo el contenedor */
    }

    .darken-img {
      width: 100%;
      height: 300px; /* Altura deseada para las imágenes */
      object-fit: cover; /* Ajustar la imagen para cubrir todo el contenedor */
      filter: brightness(50%); /* Oscurecer la imagen al 50% */
    }

    </style>
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


<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active d-item">
      <img src="images/imagen1.jpg" class="d-block w-100 darken-img" alt="slider 1">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Proyectos<h1>
      <a href="#" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>  
    </div>
    <div class="carousel-item d-item">
      <img src="images/imagen2.jpg" class="d-block w-100 darken-img" alt="slider 2">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Concursos<h1>
      <a href="#" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>  
    </div>
    <div class="carousel-item d-item">
      <img src="images/imagen3.jpg" class="d-block w-100 darken-img" alt="slider 3">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Sobre nosotros<h1>
      <a href="#" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>


<div class="container">
  <h1 class="mt-4">
  <?php
   echo "Hola,"." ".$_SESSION["nombre"]." ". $_SESSION["apellidos"];
  ?>
  </h1>
  <p></p>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>