<?php
session_start();
if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];
}
$currentPage = 'juez';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    .contenedor {
        width: 100%;
        height: 100%;
      }

      html {
    position: relative;
    min-height: 100%;
    }

    body {
    margin-bottom: 80px;
    }

    .navbar-nav .nav-link {
    font-size: 18px; 
    }

    footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 120px;
    background-color: #343a40;
    color: white;
    }

    </style>
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Inicio | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  </head>
  <body>

    <div class="contenedor" id="contenedorJuez">

      <?php include "juez/menu-juez.php" ?>


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
      <h1 class="display-1 fw-bolder text-capitalize">Proyectos</h1>
      <a href="https://technovation.tgmbp.com/eventos/" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>  
    </div>
    <div class="carousel-item d-item">
      <img src="images/imagen2.jpg" class="d-block w-100 darken-img" alt="slider 2">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Concursos</h1>
      <a href="https://technovation.tgmbp.com/ediciones-anteriores/" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>  
    </div>
    <div class="carousel-item d-item">
      <img src="images/imagen3.jpg" class="d-block w-100 darken-img" alt="slider 3">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Sobre nosotros</h1>
      <a href="https://technovation.tgmbp.com/" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
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
   echo "Bienvenid@,"." ".$_SESSION["nombre"]."!";
  ?>
  </h1>
  <p></p>
</div>

<!-- MANEJAR BOTONES MENÚ-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
          $(document).ready(function(){
            $("#btnJuez").click(function(e){
              e.preventDefault();
                $("#contenedorJuez").load("juez.php", function(){
                  history.pushState(null,null,"juez.php");
                });
            });

            $("#btnEvaluaciones").click(function(e){
              e.preventDefault();
                $("#contenedorJuez").load("juez/evaluaciones.php", function(){
                  history.pushState(null,null,"juez/evaluaciones.php");
                });
                window.onpopstate = function(event){
                $("#contenedorJuez").load("juez.php");
              };
            });
          });

        </script>

         <script>
        $(document).ready(function(){
        $("#btnSalir").click(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "archivos/controlador_cerrarsesion.php",
                success: function(data){
                    $("#contenedorJuez").load("index.php", function(){
                      history.pushState(null,null,"index.php");
                    });
                    window.onpopstate = function(event){
                    $("#contenedorJuez").load("index.php");
                  };
                    }
                });
            });
        });
    </script>


<footer class="footer bg-dark text-white py-4">
  <div class="container">
    <div class="row">
      <div class="text-center">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="bi bi-facebook text-white"></i></a></li>
          <li class="list-inline-item"><a href="https://www.twitter.com/TalentGrowthM"><i class="bi bi-twitter text-white"></i></a></li>
          <li class="list-inline-item"><a href="https://www.instagram.com/talentgrowthmbp/"><i class="bi bi-instagram text-white"></i></a></li>
          <li class="list-inline-item"><a href="https://www.linkedin.com/company/tgmbp/"><i class="bi bi-linkedin text-white"></i></a></li>
        </ul>
      </div>
      <div class="text-center">
        <p class="text-sm text-center">© 2024 Technovation. Todos los derechos reservados.</p>
      </div>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>