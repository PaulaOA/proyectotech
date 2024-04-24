<?php
session_start();
if (empty($_SESSION["nombre"])) {
    header("location: index.php");   
}
$currentPage = 'crearequipo';
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
      .contenedor {
        width: 100%;
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div class="contenedor" id="contenedorCrearEquipo">

      <?php include "menu-superior.php" ?>

        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="card bg-primary text-left text-white">
                        <h4>Crea tu equipo</h4>  
                    </div>
                    <form action="archivos/recovery.php" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    

                                   <div class="form-group mt-2 mb-2">
                                    <label for="contraseña">Nombre de equipo</label>
                                    <input type="text" class="form-control" name="contraseña" id="contraseña" required>
                                   </div> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-outline-success">Crea este equipo</button>
                            <a class="middle" href="encontrarequipo.php">o encuentra tu equipo</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
                window.onpopstate = function(event){
                $("#contenedorCrearEquipo").load("crearequipo.php");
              };
            });
          });

        </script>

        <script>
          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
                window.onpopstate = function(event){
                $("#contenedorCrearEquipo").load("crearequipo.php");
              };
            });
          });

        </script>

        <script>
          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
                window.onpopstate = function(event){
                $("#contenedorCrearEquipo").load("crearequipo.php");
              };
            });
          });

        </script>

         <script>
          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
                window.onpopstate = function(event){
                $("#contenedorCrearEquipo").load("crearequipo.php");
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
                    $("#contenedorCrearEquipo").load("index.php", function(){
                      history.pushState(null,null,"index.php");
                    });
                    window.onpopstate = function(event){
                    $("#contenedorCrearEquipo").load("index.php");
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