<?php
session_start();
include "../archivos/conexion.php";

if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: ../index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];

  $sql_juez = "SELECT id_juez FROM jueces WHERE id_usuario = $id_usuario";
  $resultado_juez = $conn->query($sql_juez);
  if($resultado_juez->num_rows > 0) {
    $juez = $resultado_juez->fetch_assoc();
    $id_juez = $juez['id_juez'];
  }
}
include "../consultas/sql-equipos-juez.php";
$currentPage = 'evaluaciones';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Perfil juez | Evaluaciones</title>
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
        background-color: rgba(0, 0, 0, 0.5);
    }

       html {
    position: relative;
    min-height: 100%;
    }

    body {
    margin-bottom: 140px;
    }

    footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 120px;
    background-color: #343a40;
    color: white;
    }

     .navbar-nav .nav-link {
    font-size: 18px; 
    }
  </style>
  
  </head>
  <body>
    <div class="contenedor" id="contenedorEvaluaciones">

      <?php include "menu-juez.php" ?>

<!-- TABLA DE EQUIPOS A EVALUAR POR EL JUEZ -->

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8 pl-4">
        <div class="card mt-4 mb-4">
        <div class="card-header bg-primary text-white">Evaluaciones</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped mb-2">
              <thead>
                  <tr>
                      <th class="text-center">Equipo</th>
                      <th class="text-center">División</th>
                      <th class="text-center">Mentor</th>
                      <th class="text-center">Participantes</th>
                      <th class="text-center">Evaluación</th>
                      <th class="text-center"></th>

                  </tr>
              </thead>
              <tbody>
                <?php if ($consulta_equipos && $consulta_equipos->num_rows > 0) {
                  while ($equipo = $consulta_equipos->fetch_assoc()): ?>
                  <tr>
                      <td class="text-center"><?=$equipo['nombre_equipo']?></td>
                      <td class="text-center"><?=$equipo['division']?></td>
                      <td class="text-center"><?=$equipo['mentor']?></td>
                      <td class="text-center"><?=$equipo['nombre_participantes']?></td>
                      <td class="text-center"><?=$equipo['estado_evaluacion']?></td>

                      <!-- Distinguir según el estado de la evaluación -->
                      <?php if ($equipo['estado_evaluacion'] == "sin evaluaciones") { ?>
                        <td class="text-center"><a href="#" class="evaluar" data-equipo="<?=$equipo['id_equipo']?>" data-division="<?=$equipo['division']?>">Evaluar</a></td>
                      <?php } else if ($equipo['estado_evaluacion'] == "guardada") {  ?>
                        <td class="text-center"><a href="#" class="consultar" data-equipo="<?=$equipo['id_equipo']?>" data-division="<?=$equipo['division']?>">Consultar</a></td>
                      <?php } else if ($equipo['estado_evaluacion'] == "definitiva") {  ?>
                        <td class="text-center"><a href="#" class="ver" data-equipo="<?=$equipo['id_equipo']?>" data-division="<?=$equipo['division']?>">Ver</a></td>
                      <?php } ?>
                  </tr>
               <?php endwhile; 
               } else { ?>
                <tr>
                  <td colspan="6">Aún no tienes equipos para evaluar</td>
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

<script>
$(document).ready(function(){
  // Solicitud para equipo nunca evaluado
    $(".evaluar").click(function(e){
        e.preventDefault();

        var division = $(this).data('division');
        var id_equipo = $(this).data('equipo');
        var url;
        
        // Cargar formulario según división
        if (division == "Junior") {
          url = "formulario-junior.php?id_equipo=" + id_equipo;
        } else if (division == "Senior") {
          url = "formulario-senior.php?id_equipo=" + id_equipo;
        }

          $("#contenedorEvaluaciones").load(url, function(){
              history.pushState(null,null, url);
            });
    });

    // Solicitud para equipo con puntuaciones guardadas
    $('.consultar').click(function() {

        var division = $(this).data('division');
        var id_equipo = $(this).data('equipo');
        var url;

        if (division == "Junior") {
          url = "formulario-junior.php?id_equipo=" + id_equipo + "&puntuaciones=TRUE";
        } else if (division == "Senior") {
          url = "formulario-senior.php?id_equipo=" + id_equipo + "&puntuaciones=TRUE";
        }

       $("#contenedorEvaluaciones").load(url, function(){
              history.pushState(null,null, url);
            });
      }); 

    // Solicitud para equipo con puntuaciones definitivas
    $('.ver').click(function() {

        var division = $(this).data('division');
        var id_equipo = $(this).data('equipo');
        var id_juez= <?=$id_juez?>;
        var url;

        if (division == "Junior") {
          url = "revisar-junior.php?id_equipo=" + id_equipo + "&id_juez=" + id_juez;
        } else if (division == "Senior") {
          url = "revisar-senior.php?id_equipo=" + id_equipo + "&id_juez=" + id_juez;
        }

       $("#contenedorEvaluaciones").load(url, function(){
              history.pushState(null,null, url);
            });
      }); 
 });
</script>

<!-- MANEJAR BOTONES MENÚ SUPERIOR -->

  <script>
    $(document).ready(function(){
      $("#btnJuez").click(function(e){
        e.preventDefault();
          $("#contenedorEvaluaciones").load("../juez.php", function(){
            history.pushState(null,null,"../juez.php");
          });
          window.onpopstate = function(event){
          $("#contenedorEvaluaciones").load("evaluaciones.php");
            };
      });

      $("#btnEvaluaciones").click(function(e){
        e.preventDefault();
          $("#contenedorEvaluaciones").load("evaluaciones.php", function(){
            history.pushState(null,null,"evaluaciones.php");
          });
          window.onpopstate = function(event){
          $("#contenedorEvaluaciones").load("evaluaciones.php");
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
            url: "../archivos/controlador_cerrarsesion.php",
            success: function(data){
                $("#contenedorEvaluaciones").load("../index.php", function(){
                  history.pushState(null,null,"../index.php");
                });
                window.onpopstate = function(event){
                $("#contenedorEvaluaciones").load("../index.php");
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