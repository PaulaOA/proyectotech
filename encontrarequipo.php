<?php
session_start();
include "archivos/conexion.php";

if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $id_usuario = $_SESSION["id_usuario"];
}

$sql_id_participante = "SELECT id_participante FROM participantes WHERE id_usuario = $id_usuario";
$resultado_id_participante = $conn->query($sql_id_participante);
$id_participante = ($resultado_id_participante && $resultado_id_participante->num_rows > 0) ? $resultado_id_participante->fetch_assoc()['id_participante'] : null;

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
    background-color: #343a40;
    color: white;
    }

    .modal {
          display: none;
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0,0,0,0.7);
          align-items: center;
          z-index: 1050;
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
                <input type="hidden" id="idParticipante" name="idParticipante" value="<?= $id_participante; ?>">
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

    $(document).ready(function() {
        $(document).on('click', '#btnQuieroUnirme', function(e) {
            e.preventDefault();
            var idEquipo = $(this).data('id-equipo');
            var idParticipante = $(this).data('id-participante');
             var btn = $(this);
    
            // Desactivar el botón
            btn.prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: 'archivos/quiero-unirme.php',
                data: { id_equipo: idEquipo, id_participante: idParticipante },
                success: function(response) {
                   if (response == "solicitudEnviada"){
                    $("#modalSolicitudEnviada").css("display", "block");
                   } else if (response == "haySolicitudes") {
                    $("#modalHaySolicitudes").css("display", "block");
                   } else if (response == "errorSolicitud") {
                    $("#modalErrorSolicitud").css("display", "block");
                   } else if (response == "errorVariables") {
                    $("#modalErrorVariables").css("display", "block");
                   }

                    btn.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                     btn.prop('disabled', false);
                }
            });
        });

       $(".close, .btn-cerrar").click(function(){
       $(".modal").css("display", "none");
     });
    });

</script>

<!-- MANEJAR BOTONES MENÚ -->

    <script>

       $(document).ready(function() {
        window.onpopstate = function(event) {
        $("#contenedorEncontrarEquipo").load(location.pathname);
        };
      });

          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
            });
          });

          $(document).ready(function(){
             $("#btnMisEquipos").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("misequipos.php", function(){
                  history.pushState(null,null,"misequipos.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorEncontrarEquipo").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
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

  <div id="modalSolicitudEnviada" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Solicitud enviada</h1>
            <p class="text-center">Espera a que el equipo acepte la solicitud</p>
            <button class="btnModal btn-cerrar mx-auto">Aceptar</button>
          </div>
        </div>

 <div id="modalErrorSolicitud" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Error</h1>
    <p class="text-center">No se pudo enviar la solicitud. Por favor, inténtelo de nuevo</p>
    <button class="btnModal btn-cerrar mx-auto">Aceptar</button>
  </div>
</div>

 <div id="modalErrorVariables" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Error</h1>
    <p class="text-center">Hubo un error al procesar la información</p>
    <button class="btnModal btn-cerrar mx-auto">Aceptar</button>
  </div>
</div>

 <div id="modalHaySolicitudes" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Solicitud existente</h1>
    <p class="text-center">Ya has enviado una solicitud de unión a este equipo o eres el creador</p>
    <button class="btnModal btn-cerrar mx-auto">Aceptar</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>