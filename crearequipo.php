<?php
session_start();
if (empty($_SESSION["nombre"])) {
    header("location: index.php");   
}

/*$nombre = $_SESSION["nombre"];
$id_usuario = $_SESSION["id_usuario"];*/

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

       .modal {
          display: none; /* Por defecto, ocultar el modal */
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0,0,0,0.7);
          align-items: center;
        }

      .modal-content {
          background-color: #fefefe;
          margin: 20% auto;
          padding: 20px;
          border: 1px solid #888;
          width: 40%;
          max-width: 350px;
          height: 220px;
          z-index: 1100;
        }

     .btnModal {
          display: block; 
          background-color: #007bff;
          color: #fff;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          width: 35%;
          margin: 20px auto 0;
          padding: 10px;
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
                        <h4 style="margin-left: 10px;">Crea tu equipo</h4>  
                    </div>
                    <form id="formCrearEquipo" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                   <div class="form-group mt-2 mb-2">
                                    <label for="nombreEquipo" style="margin-bottom: 10px;">Nombre de equipo</label>
                                    <input type="text" class="form-control" name="nombreEquipo" id="nombreEquipo" required>
                                   </div> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer text-left">
                            <button class="btn btn-outline-success" id="btnCrearEsteEquipo">Crea este equipo</button>
                            <div style="margin-top: 5px;">
                            <a class="middle" href="#" id="btnEncuentraTuEquipo">o encuentra tu equipo</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

     <script>
                  $(document).ready(function(){
                    $("#btnCrearEsteEquipo").click(function(event){
                      event.preventDefault();
                      $.ajax({
                        type: "POST",
                        url: "archivos/nuevo-equipo.php",
                        data: $("#formCrearEquipo").serialize(),
                        success: function(response){
                          if (response == "equipoCreado"){
                            $("#modalEquipoCreado").css("display", "block");
                          } else if (response == "rellenaCampos"){
                            $("#modalRellenaCampos").css("display", "block");
                          } else if (response == "errorSesion") {
                            $("#modalError").css("display", "block");
                          } else {
                            alert ("Error");
                          }
                        }
                      });
                      return false;
                    });
                     $(".close, #btnAceptar").click(function(){
                     $("#modalEquipoCreado, #modalRellenaCampos, #modalError").css("display", "none");
                   });
                  });
                </script>

       <div id="modalEquipoCreado" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">¡Equipo creado!</h1>
            <button class="btnModal mx-auto" id="btnAceptar">Aceptar</button>
          </div>
        </div>

        <div id="modalRellenaCampos" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Nombre Vacío</h1>
            <p class="text-center">Introduce un nombre para tu equipo</p>
            <button class="btnModal mx-auto" id="btnAceptar">Aceptar</button>
          </div>
        </div>

         <div id="modalError" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Error</h1>
            <p class="text-center">No se pudo crear el equipo</p>
            <button class="btnModal mx-auto" id="btnAceptar">Aceptar</button>
          </div>
        </div>

    <!-- Manejar botones menú superior -->

    <script>
      $(document).ready(function() {
        window.onpopstate = function(event) {
        $("#contenedorCrearEquipo").load(location.pathname);
        };
      });
          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnEncontrarEquipo, #btnEncuentraTuEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
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