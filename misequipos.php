<?php
session_start();
include "archivos/conexion.php";

if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $id_usuario = $_SESSION["id_usuario"];
}

require "consultas/sql-misequipos.php";

$currentPage = 'misequipos';

?>
<!DOCTYPE html>
<html lang="es">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link rel="stylesheet" href= "css/bootstrap.min.css"/>
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
          height: 250px;
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
        .modal-footer-this .btn {
            padding: 10px 20px 10px 20px; /* Aumenta el tamaño de los botones */
            width: 100px; /* Aumenta el ancho de los botones */
            margin: 0 20px; /* Agrega espacio entre los botones */
        }
    </style>
  </head>
  <body>
    <div class="contenedor" id="contenedorMisEquipos">
      <?php include "menu-superior.php" ?>

<div class="container-fluid" style="max-width: 100%;">
  <div class="row justify-content-center">
    <div class="col-md-4 pl-4">
        <div class="card mt-4 mb-2">
        <div class="card-header bg-primary text-white">Mis equipos</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped mb-2">

              <tbody>
                    <tr>
                      <th colspan="2" style="background-color: royalblue; color: white;">Equipos como creador</th>
                    </tr>
                    <?php if ($consulta_equiposCreados && $consulta_equiposCreados->num_rows > 0) {
                      while ($equiposCreados = $consulta_equiposCreados->fetch_assoc()): ?>
                  <tr>
                      <td><?=$equiposCreados['nombre_equipo']?></td>
                      <td style="text-align: right;"><a href="#" class="ver-detalles-equipo" data-id="<?=$equiposCreados['id_equipo']?>" data-nombre="<?=$equiposCreados['nombre_equipo']?>" data-mentor="<?=$equiposCreados['nombre_mentor']?>" data-creador="<?=$equiposCreados['nombre_creador']?>" data-participantes="<?=$equiposCreados['nombre_participantes']?>">Ver detalles</a></td>
                    </tr>
                    <?php endwhile;
                     } else {?>
                    <tr>
                      <td colspan="2">Aún no tienes ningún equipo</td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <th colspan="2" style="background-color: royalblue; color: white;">Equipos como participante</th>
                    </tr>
                    <?php if ($resultado_equiposParticipante && $resultado_equiposParticipante->num_rows > 0) {
                      while ($equiposParticipante = $resultado_equiposParticipante->fetch_assoc()): ?>
                  <tr>
                      <td><?=$equiposParticipante['nombre_equipo']?></td>
                      <td style="text-align: right;"><a href="#" class="ver-detalles-equipo-participante" data-id="<?=$equiposParticipante['id_equipo']?>" data-nombre="<?=$equiposParticipante['nombre_equipo']?>" data-mentor="<?=$equiposParticipante['nombre_mentor']?>" data-creador="<?=$equiposParticipante['nombre_creador']?>" data-participantes="<?=$equiposParticipante['nombre_participantes']?>">Ver detalles</a></td>
                    </tr>
                    <?php endwhile;
                     } else {?>
                    <tr>
                      <td colspan="2">Aún no tienes ningún equipo</td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <th colspan="2" style="background-color: #4f4f4f; color: white;">Solicitudes para unirte</th>
                    </tr>
                    <?php if ($resultado_unirse && $resultado_unirse->num_rows > 0) {
                      while ($solicitudesParaUnirse = $resultado_unirse->fetch_assoc()): ?>
                  <tr>
                      <td><?= $solicitudesParaUnirse['nombre_equipo']?></td>
                      <td style="text-align: right;"><a href="#" class="borrar-solicitud-unirse" data-solicitud="<?=$solicitudesParaUnirse['id_solicitud']?>" data-equipo="<?=$solicitudesParaUnirse['id_equipo']?>" data-nombre="<?=$solicitudesParaUnirse['nombre_equipo']?>" data-participante="<?=$solicitudesParaUnirse['id_participante']?>"><i class="bi bi-trash"></i></a></td>
                    </tr>
                      <?php endwhile;
                     } else {?>
                    <tr>
                      <td colspan="2">No tienes solicitudes pendientes</td>
                    </tr>
                    <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
        <div class="col-md-5 pl-4">
        <div class="card mt-4 mb-2">
        <div class="card-header bg-primary text-white">Solicitudes de participantes</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped mb-2">
              <thead>
                  <tr>
                      <th>Participante</th>
                      <th>Equipo</th>
                      <th colspan="2" class="text-center">Responder solicitud</th>
                  </tr>
              </thead>
              <tbody>
                    <?php if ($consulta_participantes && $consulta_participantes->num_rows > 0) {
                      while ($participante = $consulta_participantes->fetch_assoc()): ?>
                  <tr>
                      <td><?=$participante['nombre_participante']?></td>
                      <td><?=$participante['nombre_equipo']?></td>
                      <td class="text-center">
                        <a href="#" class="aceptar-participante" data-id="<?=$participante['id_equipo']?>" data-accion="aceptar" data-nombre-participante="<?=$participante['nombre_participante']?>" data-nombre-equipo="<?=$participante['nombre_equipo']?>" data-id-participante="<?=$participante['id_participante']?>">Aceptar</a>
                      </td>
                      <td class="text-center">
                        <a href="#" class="rechazar-participante" data-id="<?=$participante['id_equipo']?>" data-accion="rechazar" data-nombre-participante="<?=$participante['nombre_participante']?>" data-nombre-equipo="<?=$participante['nombre_equipo']?>" data-id-participante="<?=$participante['id_participante']?>">Rechazar</a>
                      </td>
                    </tr>
                    <?php endwhile;
                     } else {?>
                    <tr>
                      <td colspan="4">No tienes solicitudes pendientes</td>
                    </tr>
                    <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- RESPONDER SOLICITUDES PARTICIPANTES -->
<script>
    $(document).ready(function() {
        var id, accion, idParticipante, nombreParticipante, nombreEquipo, nombreParticipanteRechazar, nombreEquipoRechazar;

        $(".aceptar-participante").click(function(e) {
          e.preventDefault();
          id = $(this).data('id');
          accion = $(this).data('accion');
          idParticipante = $(this).data('id-participante');
          nombreParticipante = $(this).data('nombre-participante');
          nombreEquipo = $(this).data('nombre-equipo');
          $("#nombreParticipante").text(nombreParticipante);
          $("#nombreEquipo").text(nombreEquipo);
          $("#modalAceptarParticipante").css("display", "block");
        });

          $("#btnConfirmarParticipante").click(function() {
            $.ajax({
                type: "POST",
                url: "archivos/responder-participante.php",
                data: { id: id, accion: accion, idParticipante: idParticipante },
                success: function(response) {
                   if (response == "correcto") {
                    $("#contenedorMisEquipos").load("misequipos.php");
                   } else {
                    alert ("Error al procesar la solicitud");
                   }
                  $("#modalAceptarParticipante").css("display", "none");
                },
            });
        });

            $(".rechazar-participante").click(function(e) {
             e.preventDefault();
              id = $(this).data('id');
              accion = $(this).data('accion');
              idParticipante = $(this).data('id-participante');
              nombreParticipanteRechazar = $(this).data('nombre-participante');
              nombreEquipoRechazar = $(this).data('nombre-equipo');
              $("#nombreParticipanteRechazar").text(nombreParticipanteRechazar);
              $("#nombreEquipoRechazar").text(nombreEquipoRechazar);
             $("#modalRechazarParticipante").css("display", "block");
          });

          $("#btnRechazarParticipante").click(function() {
            $.ajax({
                type: "POST",
                url: "archivos/responder-participante.php",
                data: { id: id, accion: accion, idParticipante: idParticipante },
                success: function(response) {
                   if (response == "correcto") {
                    $("#contenedorMisEquipos").load("misequipos.php");
                   } else {
                    alert ("Error al procesar la solicitud")
                   }
                  $("#modalRechazarParticipante").css("display", "none");
                },
            });
        });
            $(".close-modal").click(function(){
            $(".modal").css("display", "none");
          });

         function updateModalContent(nombreParticipante, nombreEquipo) {
          $("#nombreParticipante").text(nombreParticipante);
          $("#nombreEquipo").text(nombreEquipo);
        }
      });
</script>

<!-- MOSTRAR MODAL DETALLES EQUIPO-->
<script>
$(document).ready(function() {
  var solicitudParaEliminar;
  $(".ver-detalles-equipo").click(function(e) {
    e.preventDefault();
    
    var nombreEquipo = $(this).data('nombre');
    var nombreMentor = $(this).data('mentor');
    var nombreCreador = $(this).data('creador');
    var nombreParticipantes = $(this).data('participantes');
    
    $("#detallesNombreEquipo").text(nombreEquipo);
    $("#detallesNombreCreador").text(nombreCreador);
    $("#detallesNombreMentor").text(nombreMentor);
    $("#detallesNombreParticipantes").text(nombreParticipantes);
    
    $("#modalDetallesEquipo").css("display", "block");
  });

   $(".ver-detalles-equipo-participante").click(function(e) {
    e.preventDefault();
    
    var equipo = $(this).data('nombre');
    var mentor = $(this).data('mentor');
    var creador = $(this).data('creador');
    var participantes = $(this).data('participantes');
    
    $("#detallesEquipo").text(equipo);
    $("#detallesCreador").text(creador);
    $("#detallesMentor").text(mentor);
    $("#detallesParticipantes").text(participantes);
    
    $("#modalDetallesEquipoParticipantes").css("display", "block");
  });

   $(".borrar-solicitud-unirse").click(function(e) {
    e.preventDefault();
    
    var solicitud = $(this).data('solicitud');
    var nombreEquipoUnirse = $(this).data('nombre');
    
    $("#nombreEquipoUnirse").text(nombreEquipoUnirse);
    
    $("#modalBorrarUnirse").css("display", "block");

    solicitudParaEliminar = solicitud;
  });

  $(".close-modal").click(function() {
    $(".modal").css("display", "none");
  });

  $(window).click(function(event) {
    if ($(event.target).hasClass("modal")) {
      $(".modal").css("display", "none");
    }
  });

 $("#btnEliminarSolicitudUnirse").click(function() {
        $.ajax({
            url: 'archivos/eliminar-solicitud-unirse.php',
            type: 'POST',
            data: { id_solicitud: solicitudParaEliminar },
            success: function(response) {
                if (response == "solicitudEliminada") {
                    $("#modalBorrarUnirse").hide();
                    $("#contenedorMisEquipos").load("misequipos.php");
                } else {
                    alert('Error al eliminar la solicitud.');
                }
            },
            error: function() {
                alert('Error en la solicitud.');
            }
        });
    });
});
</script>


<!-- MANEJAR BOTONES MENÚ -->

    <script>

        $(document).ready(function() {
        window.onpopstate = function(event) {
        $("#contenedorMisEquipos").load(location.pathname);
        };
      });

          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorMisEquipos").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorMisEquipos").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorMisEquipos").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorMisEquipos").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnMensajes").click(function(e){
              e.preventDefault();
                $("#contenedorMisEquipos").load("mensajes.php", function(){
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
                    $("#contenedorMisEquipos").load("index.php", function(){
                      history.pushState(null,null,"index.php");
                    });
                    window.onpopstate = function(event){
                    $("#contenedorMisEquipos").load("index.php");
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

 <div id="modalAceptarParticipante" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Aceptar solicitud</h1>
      <p class="text-center">¿Desea aceptar la solicitud de <i><span id="nombreParticipante"></span></i> para el equipo <i><span id="nombreEquipo"></span></i>?</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal" id="btnCancelar">Cancelar</button>
        <button type="button" class="btn btn-primary close-modal" id="btnConfirmarParticipante">Aceptar</button>
      </div>
  </div>
</div>

 <div id="modalRechazarParticipante" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Rechazar solicitud</h1>
      <p class="text-center">¿Desea rechazar la solicitud de <i><span id="nombreParticipanteRechazar"></span></i> para el equipo <i><span id="nombreEquipoRechazar"></span></i>?</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal" id="btnCancelar">Cancelar</button>
        <button type="button" class="btn btn-primary close-modal" id="btnRechazarParticipante">Rechazar</button>
      </div>
  </div>
</div>

<div id="modalDetallesEquipo" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center"></h1>
     <p><strong>Nombre del equipo:</strong> <span id="detallesNombreEquipo"></span></p>
    <p><strong>Mentor:</strong> <span id="detallesNombreMentor"></span></p>
    <p><strong>Creador:</strong> <span id="detallesNombreCreador"></span></p>
    <p><strong>Participantes:</strong> <span id="detallesNombreParticipantes"></span></p>
    <div class="modal-footer-this">
        <button type="button" class="btn btn-secondary close-modal">Cerrar</button>
      </div>
  </div>
</div>

<div id="modalDetallesEquipoParticipantes" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center"></h1>
     <p><strong>Nombre del equipo:</strong> <span id="detallesEquipo"></span></p>
    <p><strong>Mentor:</strong> <span id="detallesMentor"></span></p>
    <p><strong>Creador:</strong> <span id="detallesCreador"></span></p>
    <p><strong>Participantes:</strong> <span id="detallesParticipantes"></span></p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal">Cerrar</button>
      </div>
  </div>
</div>

<div id="modalBorrarUnirse" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center"></h1>
     <p>¿Desea eliminar la solicitud para participar en el equipo <strong><span id="nombreEquipoUnirse"></span></strong>?</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarSolicitudUnirse">Eliminar</button>
      </div>
  </div>
</div>
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