<?php
session_start();
if (empty($_SESSION["nombre"])) {
    header("location: index.php");   
}
$currentPage = 'encontrarequipo';
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

      html {
    position: relative;
    min-height: 100%;
    }

    body {
    margin-bottom: 120px; /* Ajusta este valor según la altura de tu footer */
    }

    footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 120px; /* Ajusta la altura de tu footer según lo necesites */
    background-color: #343a40; /* Color de fondo del footer */
    color: white; /* Color del texto del footer */
    }
    </style>
  </head>
  <body>
    <div class="contenedor" id="contenedorEncontrarEquipo">
      <?php include "menu-superior.php" ?>
<br>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
         <form id="formEncuentraEquipo">
            <div class="mb-3">
                <label class="mb-3" for="busquedaNombre">Búsqueda por nombre</label>
                <input type="text" class="form-control" id="busquedaNombre" name="busquedaNombre">
            </div>
            <div class="mb-3">
                <label class="mb-3" for="busquedaCiudad">Búsqueda por ciudad</label>
                <input type="text" class="form-control" id="busquedaCiudad" name="busquedaCiudad">
            </div>
            <button class="btn btn-primary btn-success" id="btnBuscarEquipos">Buscar</button>
              <hr>
             <fieldset class="row-auto">
              <legend class="col-form-label col-sm-2 pt-0">División</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Senior
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                  <label class="form-check-label" for="gridRadios2">
                    Junior
                  </label>
                </div>
                <div class="form-check disabled">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                  <label class="form-check-label" for="gridRadios3">
                    Sin asignar
                  </label>
                </div>
              </div>
              </fieldset> 
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-3">
    <div class="col-md-10">
    <div class="row"  id="resultadoBusqueda">

                  
            </div>
        </div>
     </div>
   </div>
   <br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>

$(document).ready(function() {
    $('#btnBuscarEquipos').click(function(e) {
      e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'archivos/buscar-equipo.php',
            data: $('#formEncuentraEquipo').serialize(),
            success: function(response) {
                $('#resultadoBusqueda').html(response);
            },
        });
    });
});

</script>

<!-- MANEJAR BOTONES MENÚ -->

    <script>
          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
                window.onpopstate = function(event){
                $("#contenedorEncontrarEquipo").html(response);
              };
            });
          });

        </script>

        <script>
          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
                window.onpopstate = function(event){
                $("#contenedorEncontrarEquipo").load("encontrarequipo.php");
              };
            });
          });

        </script>

        <script>
          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
                window.onpopstate = function(event){
                $("#contenedorEncontrarEquipo").load("encontrarequipo.php");
              };
            });
          });

        </script>

         <script>
          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
                window.onpopstate = function(event){
                $("#contenedorEncontrarEquipo").load("encontrarequipo.php");
              };
            });
          });

            $(document).ready(function(){
            $("#btnMensajes").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("mensajes.php", function(){
                  history.pushState(null,null,"mensajes.php");
                });
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
                    $("#contenedorEncontrarEquipo").load("index.php", function(){
                      history.pushState(null,null,"index.php");
                    });
                    window.onpopstate = function(event){
                    $("#contenedorEncontrarEquipo").load("index.php");
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
    document.addEventListener("DOMContentLoaded", function() {
        var currentPage = "<?php echo $currentPage; ?>";
        var element = document.getElementById('btn' + currentPage.charAt(0).toUpperCase() + currentPage.slice(1));
        if (element) {
            element.classList.add('active');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>