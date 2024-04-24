<?php
session_start();
if (empty($_SESSION["nombre"])) {
    header("location: index.php");   
}

$currentPage = 'inicio';

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

    </style>
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Inicio | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  </head>
  <body>

    <div class="contenedor" id="contenedorInicio">

 <?php include "menu-superior.php" ?>


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
      <a href="#" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>  
    </div>
    <div class="carousel-item d-item">
      <img src="images/imagen2.jpg" class="d-block w-100 darken-img" alt="slider 2">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Concursos</h1>
      <a href="#" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>  
    </div>
    <div class="carousel-item d-item">
      <img src="images/imagen3.jpg" class="d-block w-100 darken-img" alt="slider 3">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Sobre nosotros</h1>
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
   echo "Bienvenid@,"." ".$_SESSION["nombre"]." ". $_SESSION["apellidos"]."!";
  ?>
  </h1>
  <p></p>
</div>

<!-- MANEJAR BOTONES MENÚ SUPERIOR -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
                window.onpopstate = function(event){
                $("#contenedorInicio").load("inicio.php");
              };
            });
          });

        </script>

        <script>
          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
                window.onpopstate = function(event){
                $("#contenedorInicio").load("inicio.php");
              };
            });
          });

        </script>

        <script>
          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
                window.onpopstate = function(event){
                $("#contenedorInicio").load("inicio.php");
              };
            });
          });

        </script>

         <script>
          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
                window.onpopstate = function(event){
                $("#contenedorInicio").load("inicio.php");
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
                    $("#contenedorInicio").load("index.php", function(){
                      history.pushState(null,null,"index.php");
                    });
                    window.onpopstate = function(event){
                    $("#contenedorInicio").load("index.php");
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

<!-- Script para resaltar la palabra del menú-->

<script>
    var url = window.location.pathname;
    var filename = url.substring(url.lastIndexOf('/') + 1);

    var currentPage = filename.split('.')[0];
    
    var element = document.getElementById('btn' + currentPage.charAt(0).toUpperCase() + currentPage.slice(1));
    if (element) {
        element.classList.add('active');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>