<?php
session_start();
include "../archivos/conexion.php";
if (empty($_SESSION["admin"])) {
    header("location: ../index.php");   
}
$currentPage = 'equipos';

$sql = "SELECT * FROM equipos";
$equipos = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href= "../css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Administración | Gestión de equipos</title>
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
    margin-bottom: 120px; /* Ajusta este valor según la altura de tu footer */
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
      <div class="contenedor" id="contenedorEquipos">
         <?php include "menu-admin.php" ?>

<div class="responsive bg-dark text-white py-4">
  <div class="row" style="max-width: 100%">
    <div class="col-md-8"> 
    <h1 class="texto-margen-izquierdo">Panel de Administración</h1>
  <p class="texto-margen-izquierdo">Gestión de Equipos</p>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8 pl-4">
        <div class="card mt-4 mb-4">
        <div class="card-header bg-primary text-white">Equipos</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped mb-2">
              <thead>
                  <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">ID creador</th>
                      <th class="text-center">Creador</th>
                      <th class="text-center">ID mentor</th>
                      <th class="text-center">Mentor</th>
                      <th class="text-center">División</th>
                      <th class="text-center">Estado solicitud</th>
                      <th class="text-center">Editar</th>
                      <th class="text-center">Eliminar</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                 while ($equipo = $equipos->fetch_assoc()):
                  $consulta_mentor = "SELECT registro.nombre FROM registro INNER JOIN mentores ON registro.id_usuario = mentores.id_usuario WHERE mentores.id_mentor = " .$equipo['id_mentor'];
                  $resultado_mentor = $conn->query($consulta_mentor);
                  $nombre_mentor = $resultado_mentor->fetch_assoc()['nombre'];
                  
                  $consulta_creador = "SELECT registro.nombre FROM registro INNER JOIN equipos ON registro.id_usuario = equipos.id_creador WHERE equipos.id_creador =" .$equipo['id_creador'];
                  $resultado_creador = $conn->query($consulta_creador);
                  $nombre_creador = $resultado_creador->fetch_assoc()['nombre'];
                 ?>
                  <tr>
                      <td class="text-center"><?= $equipo['id_equipo']; ?></td>
                      <td class="text-center"><?= $equipo['nombre_equipo']; ?></td>
                      <td class="text-center"><?= $equipo['id_creador']; ?></td>
                      <td class="text-center"><?= $nombre_creador; ?></td>
                      <td class="text-center"><?= $equipo['id_mentor']; ?></td>
                      <td class="text-center"><?= $nombre_mentor; ?></td>
                      <td class="text-center"><?= $equipo['division']; ?></td>
                      <td class="text-center"><?= $equipo['estado']; ?></td>
                      <td class="text-center">
                        <a href="#" class="editar-equipo" data-id="<?= $equipo['id_equipo']?>">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                      </td>
                        <td class="text-center">
                        <a href="#" class="borrar-equipo" data-id="<?= $equipo['id_equipo']?>" data-nombre="<?= $equipo['nombre_equipo']?>">
                         <i class="bi bi-trash"></i>
                        </a>
                      </td>
                  </tr>
               <?php endwhile ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="text-end mb-4">
          <button class="btn btn-primary py-3 px-3" id="btnNuevoEquipo">Nuevo equipo</button>
        </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $(".editar-equipo").click(function(e) {
            e.preventDefault();
            var id_equipo = $(this).data('id');
            $.ajax({
                url: "editar-equipo.php",
                method: "GET",
                data: { id_equipo: id_equipo },
                success: function(response) {
                    $('#modalEditarEquipo .modal-body').html(response);
                    $('#modalEditarEquipo').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Error al obtener datos:", error);
                }
            });
        });
    });
     $(document).ready(function() {
        $("#btnNuevoEquipo").click(function() {
            $('#modalNuevoEquipo').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".borrar-equipo").click(function(e) {
            e.preventDefault();
            var id_equipo = $(this).data('id');
            var nombre_equipo = $(this).data('nombre');
            $("#idEquipoEliminar").text(id_equipo);
            $("#nombreEquipoEliminar").text(nombre_equipo);
            $('#modalEliminarEquipo').modal('show');

            $("#btnEliminarEquipo").click(function(e) {
            $.ajax({
                url: "eliminar-equipo.php",
                method: "POST",
                data: { id_equipo: id_equipo },
                success: function(response) {
                    if (response == "equipoEliminado") {
                      $("#modalEliminarEquipo").modal("hide");
                      $("#contenedorEquipos").load("equipos.php");
                    } else {
                      alert("No se pudo eliminar el equipo");
                    }
                }
               
            });
        });
        });
    });
</script>

<?php require "modales-edicion-equipos.php"; ?>


<!-- MANEJAR BOTONES MENÚ SUPERIOR -->

<script>
  $(document).ready(function() {
    window.onpopstate = function(event) {
        $("#contenedorEquipos").load(location.pathname);
    };
  });

    $(document).ready(function(){
      $("#btnAdmin").click(function(e){
        e.preventDefault();
          $("#contenedorEquipos").load("../admin.php", function(){
            history.pushState(null,null,"../admin.php");
          });
      });
    });

    $(document).ready(function(){
      $("#btnUsuarios").click(function(e){
        e.preventDefault();
          $("#contenedorEquipos").load("usuarios.php", function(){
            history.pushState(null,null,"usuarios.php");
          });
      });
    });

    $(document).ready(function(){
      $("#btnEquipos").click(function(e){
        e.preventDefault();
          $("#contenedorEquipos").load("equipos.php", function(){
            history.pushState(null,null,"equipos.php");
          });
      });
    });

    $(document).ready(function(){
      $("#btnProyectos").click(function(e){
        e.preventDefault();
          $("#contenedorEquipos").load("proyectos.php", function(){
            history.pushState(null,null,"proyectos.php");
          });
      });
    });

    $(document).ready(function(){
      $("#btnEvaluaciones").click(function(e){
        e.preventDefault();
          $("#contenedorEquipos").load("evaluaciones.php", function(){
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
              $("#contenedorEquipos").load("../index.php", function(){
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