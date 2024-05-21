<?php
session_start();
require_once("archivos/conexion.php");
$currentPage = 'crearequipo';
if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];
}

$consultaEquipos = "SELECT equipos.*, registro.nombre AS nombre_mentor
  FROM equipos
  INNER JOIN mentores ON equipos.id_mentor = mentores.id_mentor
  INNER JOIN registro ON mentores.id_usuario = registro.id_usuario
  WHERE equipos.id_creador = $id_usuario";
  $solicitudes = $conn->query($consultaEquipos);

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
    <div class="contenedor" id="contenedorCrearEquipo">

      <?php
      include "menu-superior.php";
      include "archivos/conexion.php";
      $sql = "SELECT registro.nombre, mentores.id_mentor FROM registro JOIN mentores ON registro.id_usuario = mentores.id_usuario";
      $resultado = $conn->query($sql);
      ?>

        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3">
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
                                    <label for="id_mentor" class="texto-label" style="margin-bottom: 10px; margin-top: 10px;">Mentor Equipo</label>
                                     <select name="id_mentor" id="id_mentor" class="form-control" style="margin-bottom:10px">
                                      <option value="">Selecciona un mentor</option>
                                      <?php 
                                      if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) {
                                          echo "<option value='".$fila['id_mentor']."'>".$fila['nombre']. "</option>";
                                        }
                                      } else {
                                        echo "<option value=''>No existen mentores</option>";
                                      }
                                      ?>
                                    </select>
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
                <div class="col-md-5">
                  <div class="card bg-secondary text-left text-white">
                    <h4 style="margin-left: 10px;">Solicitudes para crear equipo</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped mb-2">
                      <thead>
                          <tr>
                              <th class="text-center">Nombre equipo</th>
                              <th class="text-center">Mentor</th>
                              <th class="text-center">Estado</th>
                              <th class="text-center">Eliminar</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                        while ($solicitud = $solicitudes->fetch_assoc()):
                        ?>
                          <tr>
                              <td class="text-center"><?=$solicitud['nombre_equipo']?></td>
                              <td class="text-center"><?=$solicitud['nombre_mentor']?></td>
                              <td class="text-center"><?=$solicitud['estado']?></td>
                               <td class="text-center">
                                <?php if ($solicitud['estado'] == 'pendiente'): ?>
                                <a href="#" class="borrar-solicitud" data-id="<?= $solicitud['id_equipo']?>" data-nombre="<?= $solicitud['nombre_equipo']?>">
                                  <i class="bi bi-trash"></i>
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
              <div class="col-md-1"></div> 
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
                if (response == "solicitudEnviada"){
                  $("#modalSolicitudEnviada").css("display", "block");
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
           $("#modalSolicitudEnviada, #modalRellenaCampos, #modalError").css("display", "none");
           $("#contenedorCrearEquipo").load("crearequipo.php")
         });
        });
      </script>
      <script>
        $(document).ready(function() {
            $(".borrar-solicitud").click(function(e) {
                e.preventDefault();
                var id_equipo = $(this).data('id');
                var nombre_equipo = $(this).data('nombre');
                $(".nombreEquipoEliminar").text(nombre_equipo);
                $('#modalEliminarSolicitud').css("display", "block");
              
                $("#btnEliminarSolicitud").click(function(e) {
                  $.ajax({
                      url: "archivos/eliminar-solicitud.php",
                      method: "POST",
                      data: { id_equipo: id_equipo },
                      success: function(response) {
                          if (response == "solicitudEliminada") {
                            $("#modalEliminarSolicitud").modal("hide");
                            $("#contenedorCrearEquipo").load("crearequipo.php");
                          } else {
                            alert("No se pudo eliminar la solicitud");
                          }
                      }
                  });
              });
           $(".close, #btnCancelarEliminar").click(function(){
           $("#modalEliminarSolicitud").css("display", "none");
           $("#contenedorCrearEquipo").load("crearequipo.php")
         });
        });
      });
      </script>

        <div id="modalEliminarSolicitud" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">¿Eliminar solicitud?</h1>
            <p>Los datos del equipo "<span class="nombreEquipoEliminar"></span>" serán eliminados</p>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btnCancelarEliminar">Cancelar</button>
              <button type="button" class="btn btn-danger" id="btnEliminarSolicitud">Eliminar Solicitud</button>
            </div>
          </div>
        </div>

       <div id="modalSolicitudEnviada" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">¡Solicitud enviada!</h1>
            <p>El mentor responderá a tu solicitud</p>
            <button class="btnModal mx-auto" id="btnAceptar">Aceptar</button>
          </div>
        </div>

        <div id="modalRellenaCampos" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Solicitud incompleta</h1>
            <p class="text-center">Por favor, elige un nombre y un mentor para tu equipo</p>
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

          $(document).ready(function(){
            $("#btnMisEquipos").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("misequipos.php", function(){
                  history.pushState(null,null,"misequipos.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnMensajes").click(function(e){
              e.preventDefault();
                $("#contenedorCrearEquipo").load("mensajes.php", function(){
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