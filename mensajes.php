<?php
session_start();
require_once("archivos/conexion.php");
$currentPage = 'mensajes';

if (empty($_SESSION["nombre"])|| empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];
}
  $solicitudesPendientes = "SELECT equipos.*, registro.nombre AS nombre_creador
    FROM equipos
    INNER JOIN registro ON equipos.id_creador = registro.id_usuario
    INNER JOIN mentores ON equipos.id_mentor = mentores.id_mentor
    WHERE mentores.id_usuario =" .$id_usuario;
$solicitudes = $conn->query($solicitudesPendientes);

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

  .modal {
      display: none; /* Por defecto, ocultar el modal */
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3);
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
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Mensajes | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  </head>
  <body>

    <div class="contenedor" id="contenedorMensajes">

 <?php include "menu-superior.php" ?>

<div class="container-fluid" style="max-width: 100%;">
  <div class="row justify-content-center">
    <div class="col-md-6 pl-4">
        <div class="card mt-4 mb-2">
        <div class="card-header bg-primary text-white">Solicitudes</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped mb-2">
              <thead>
                  <tr>
                      <th class="text-center">Nombre Equipo</th>
                      <th class="text-center">Creador</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                  </tr>
              </thead>
              <tbody>
                <?php
                 while ($fila = $solicitudes->fetch_assoc()):
                 ?>
                  <tr>
                      <td class="text-center"><?= $fila['nombre_equipo']; ?></td>
                      <td class="text-center"><?= $fila['nombre_creador']; ?></td>
                      <td class="text-center"><?= $fila['estado']; ?></td>
                      <td class="text-center">
                        <?php if ($fila['estado'] == 'pendiente'): ?>
                          <a href="#" class="aceptar-solicitud" data-id="<?= $fila['id_equipo']; ?>" data-accion="aceptar">
                            Aceptar
                          </a>
                      </td>
                      <td class="text-center">
                        <a href="#" class="rechazar-solicitud" data-id="<?= $fila['id_equipo']; ?>" data-accion="rechazar">
                            Rechazar
                          </a>
                          <?php endif; ?>
                      </td>
                  </tr>
                  <?php endwhile ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- RESPONDER SOLICITUDES PENDIENTES -->

<script>
    $(document).ready(function() {
      var equipoId, accion;
          $(".aceptar-solicitud").click(function(e) {
             e.preventDefault();
             id = $(this).data('id');
             accion = $(this).data('accion');
             $("#modalAceptarSolicitud").css("display", "block");
          });

            $("#btnConfirmarSolicitud").click(function() {
            $.ajax({
                type: "POST",
                url: "archivos/responder-solicitud.php",
                data: { id: id, accion: accion },
                success: function(response) {
                   if (response == "correcto") {
                    $("#contenedorMensajes").load("mensajes.php");
                   } else {
                    alert ("Error al procesar la solicitud")
                   }
                  $("#modalAceptarSolicitud").css("display", "none");
                },
            });
        });

          $(".rechazar-solicitud").click(function(e) {
             e.preventDefault();
             id = $(this).data('id');
             accion = $(this).data('accion');
             $("#modalRechazarSolicitud").css("display", "block");
          });

            $("#btnRechazarSolicitud").click(function() {
            $.ajax({
                type: "POST",
                url: "archivos/responder-solicitud.php",
                data: { id: id, accion: accion },
                success: function(response) {
                   if (response == "correcto") {
                    $("#contenedorMensajes").load("mensajes.php");
                   } else {
                    alert ("Error al procesar la solicitud");
                   }
                  $("#modalRechazarSolicitud").css("display", "none");
                },
            });
        });
      });
</script>

 <div id="modalAceptarSolicitud" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Confirmar solicitud</h1>
    <p class="text-center">¿Desea aceptar la solicitud del equipo?</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="btnCancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnConfirmarSolicitud">Confirmar</button>
      </div>
  </div>
</div>

 <div id="modalRechazarSolicitud" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Rechazar solicitud</h1>
    <p class="text-center">¿Desea rechazar la solicitud del equipo?</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="btnCerrar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnRechazarSolicitud">Rechazar</button>
      </div>
  </div>
</div>

   <!-- MANEJAR BOTONES MENÚ SUPERIOR -->


<script>
  $(document).ready(function() {
    window.onpopstate = function(event) {
        $("#contenedorMensajes").load(location.pathname);
    };
  });

          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorMensajes").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorMensajes").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorMensajes").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorMensajes").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnMisEquipos").click(function(e){
              e.preventDefault();
                $("#contenedorMensajes").load("mis-equipos.php", function(){
                  history.pushState(null,null,"mis-equipos.php");
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
                    $("#contenedorMensajes").load("index.php", function(){
                      history.pushState(null,null,"index.php");
                    });
                    window.onpopstate = function(event){
                    $("#contenedorMensajes").load("index.php");
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