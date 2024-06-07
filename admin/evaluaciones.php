<?php
session_start();
include "../archivos/conexion.php";
if (empty($_SESSION["admin"])) {
    header("location: ../index.php");   
}
$currentPage = 'evaluaciones';

$sql_jueces = "SELECT j.id_juez, r.nombre
                  FROM jueces j
                  INNER JOIN registro r ON r.id_usuario = j.id_usuario";
$resultado_jueces = $conn->query($sql_jueces);

$sql_equipos = "SELECT id_equipo, nombre_equipo FROM equipos";
$resultado_equipos = $conn->query($sql_equipos);

$sql_jueces_equipo = "SELECT je.id_juez, je.id_equipo, e.nombre_equipo, GROUP_CONCAT(r.nombre SEPARATOR ', ') AS nombre_jueces
                        FROM jueces_equipos je
                        JOIN jueces j ON je.id_juez = j.id_juez
                        JOIN registro r ON r.id_usuario = j.id_usuario
                        JOIN equipos e ON e.id_equipo = je.id_equipo
                        GROUP BY je.id_equipo";
$resultado_jueces_equipo = $conn->query($sql_jueces_equipo);

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
    <title>Administración | Evaluaciones</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  
    <style>

    .texto-margen-izquierdo {
      margin-left: 40px;
    }

    .contenedor {
        width: 100%;
        height: 100%;
      }

    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* color semitransparente */
    }

       html {
    position: relative;
    min-height: 100%;
    }

    body {
    margin-bottom: 80px; /* Ajusta este valor según la altura de tu footer */
    }

    footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 120px; /* Ajusta la altura de tu footer según lo necesites */
    background-color: #343a40; /* Color de fondo del footer */
    color: white; /* Color del texto del footer */
    }

     .navbar-nav .nav-link {
    font-size: 18px; 
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
      <div class="contenedor" id="contenedorEvaluaciones">
         <?php include "menu-admin.php" ?>

<div class="responsive bg-dark text-white py-4">
  <div class="row" style="max-width: 100%">
    <div class="col-md-8"> 
    <h1 class="texto-margen-izquierdo">Panel de Administración</h1>
  <p class="texto-margen-izquierdo">Evaluaciones</p>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-3 pl-4">
        <div class="card mt-4 mb-4">
        <div class="card-header bg-primary text-white">Asignación de jueces</div>
          <div class="card-body">
            <div class="table-responsive">

              <form id="formJuecesEquipos">
              <label for="id_equipo" class="texto-label">Equipo</label>
              <select name="id_equipo" id="id_equipo" class="form-control">
                <option value="">Selecciona un equipo</option>
                <?php 
                if ($resultado_equipos->num_rows > 0) {
                  while ($equipo = $resultado_equipos->fetch_assoc()) {
                    echo "<option value='".$equipo["id_equipo"]."'>".$equipo['nombre_equipo']. "</option>";
                  }
                } else {
                  echo "<option value=''>No existen equipos</option>";
                }
                ?>
              </select>
            <label for="id_juez" class="texto-label">Juez</label>
              <select name="id_juez" id="id_juez" class="form-control">
                <option value="">Selecciona un juez</option>
               <?php 
                if ($resultado_jueces->num_rows > 0) {
                  while ($juez = $resultado_jueces->fetch_assoc()) {
                    echo "<option value='".$juez["id_juez"]."'>".$juez['nombre']. "</option>";
                  }
                } else {
                  echo "<option value=''>No existen jueces</option>";
                }
                ?>
              </select>
              <div class="d-flex justify-content-end mt-2">
               <button type="button" class="btn btn-primary" id="btnAsignarJuez">Asignar</button>
             </div>
            </form>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-5 pl-4">
        <div class="card mt-4 mb-4">
        <div class="card-header bg-primary text-white">Jueces de equipos</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped mb-2">
              <thead>
                  <tr>
                      <th class="text-center">ID Equipo</th>
                      <th class="text-center">Nombre Equipo</th>
                      <th class="text-center">Jueces</th>  
                  </tr>
              </thead>
              <tbody>
                
                  <tr>
                  <?php if ($resultado_jueces_equipo && $resultado_jueces_equipo->num_rows > 0) {
                      while ($jueces_equipo = $resultado_jueces_equipo->fetch_assoc()): ?>
                      <td class="text-center"><?=$jueces_equipo['id_equipo']?></td>
                      <td class="text-center"><?=$jueces_equipo['nombre_equipo']?></td>
                      <td class="text-center"><?=$jueces_equipo['nombre_jueces']?></td>
                  </tr>
                  <?php endwhile;
                     } else {?>
                    <tr>
                      <td colspan="2">Aún no se ha asignado ningún juez a un equipo</td>
                    </tr>
                    <?php } ?>
                    <tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
 </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- MANEJAR BOTONES MENÚ SUPERIOR -->

<script>
  $(document).ready(function() {
    window.onpopstate = function(event) {
        $("#contenedorEvaluaciones").load(location.pathname);
    };
  });

    $(document).ready(function(){
      $("#btnAdmin").click(function(e){
        e.preventDefault();
          $("#contenedorEvaluaciones").load("../admin.php", function(){
            history.pushState(null,null,"../admin.php");
          });
      });
    });

    $(document).ready(function(){
      $("#btnUsuarios").click(function(e){
        e.preventDefault();
          $("#contenedorEvaluaciones").load("usuarios.php", function(){
            history.pushState(null,null,"usuarios.php");
          });
      });
    });

    $(document).ready(function(){
      $("#btnEquipos").click(function(e){
        e.preventDefault();
          $("#contenedorEvaluaciones").load("equipos.php", function(){
            history.pushState(null,null,"equipos.php");
          });
      });
    });

    $(document).ready(function(){
      $("#btnProyectos").click(function(e){
        e.preventDefault();
          $("#contenedorEvaluaciones").load("proyectos.php", function(){
            history.pushState(null,null,"proyectos.php");
          });
      });
    });

     $(document).ready(function(){
      $("#btnEvaluaciones").click(function(e){
        e.preventDefault();
          $("#contenedorEvaluaciones").load("evaluaciones.php", function(){
            history.pushState(null,null,"evaluaciones.php");
          });
      });
    });

  $(document).ready(function(){
  $("#btnSalir").click(function(e){
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: "../archivos/controlador_cerrarsesion.php",
          success: function(data){
              $("#contenedorEvaluaciones").load("../index.php", function(){
                history.pushState(null,null,"../index.php");
              });
              window.onpopstate = function(event){
              $("#contenedorEquipos").load("../index.php");
            };
              }
          });
      });
  });
    </script>

        <script>
          $(document).ready(function(){
            $("#btnAsignarJuez").click(function(event){
              event.preventDefault();
              $.ajax({
                type: "POST",
                url: "asignar-juez.php",
                data: $("#formJuecesEquipos").serialize(),
                success: function(response){
                  if (response == "asignado"){
                    $("#modalJuezAsignado").css("display", "block");
                  } else if (response == "yaAsignado"){
                    $("#modalYaAsignado").css("display", "block");
                  } else if (response == "elige") {
                    $("#modalElige").css("display", "block");
                  } else {
                    $("#modalError").css("display", "block");
                  }
                }
              });
              return false;
            });
              $(".close-modal").click(function(){
                $(".modal").css("display", "none");
                  if ($(this).closest(".modal").attr("id") === "modalJuezAsignado") {
                $("#contenedorEvaluaciones").load("evaluaciones.php", function(){
                  history.pushState(null, null, "evaluaciones.php");
                 });
                }
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

<div id="modalJuezAsignado" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Asignado</h1>
    <p class="text-center">El juez ha sido asignado al equipo</p>
    <button class="btnModal mx-auto close-modal">Aceptar</button>
  </div>
</div>

<div id="modalYaAsignado" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Juez ya asignado</h1>
    <p class="text-center">El juez seleccionado ya fue asignado al equipo</p>
    <button class="btnModal mx-auto close-modal">Aceptar</button>
  </div>
</div>

<div id="modalElige" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Marca una opción</h1>
    <p class="text-center">Elige un equipo y un juez para poder asignar</p>
    <button class="btnModal mx-auto close-modal">Aceptar</button>
  </div>
</div>

<div id="modalError" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Error</h1>
    <p class="text-center">No se pudo completar la acción</p>
    <button class="btnModal mx-auto close-modal">Aceptar</button>
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