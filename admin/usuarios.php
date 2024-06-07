<?php
session_start();
include "../archivos/conexion.php";
if (empty($_SESSION["admin"])) {
    header("location: ../index.php");   
}
$currentPage = 'usuarios';

$sql = "SELECT * FROM registro WHERE admin <> 1";
$usuarios = $conn->query($sql);

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
    <title>Administración | Gestión de usuarios</title>
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
    height: 120px; /* Ajusta la altura de tu footer según lo necesites */
    background-color: #343a40; /* Color de fondo del footer */
    color: white; /* Color del texto del footer */
    }

     .navbar-nav .nav-link {
    font-size: 18px; 
    }

  </style>
  
  </head>
  <body>
      <div class="contenedor" id="contenedorUsuarios">
         <?php include "menu-admin.php" ?>

<div class="responsive bg-dark text-white py-4">
  <div class="row" style="max-width: 100%">
    <div class="col-md-8"> 
    <h1 class="texto-margen-izquierdo">Panel de Administración</h1>
      <p class="texto-margen-izquierdo">Gestión de Usuarios</p>
    </div>
  </div>
</div>

<div class="container-fluid" style="max-width: 100%;">
  <div class="row justify-content-center">
    <div class="col-md-8 pl-4">
        <div class="card mt-4 mb-2">
        <div class="card-header bg-primary text-white">Usuarios registrados</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped mb-2">
              <thead>
                  <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Apellidos</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Contraseña</th>
                      <th class="text-center">Cargo</th>
                      <th class="text-center">Editar</th>
                      <th class="text-center">Eliminar</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                 while ($usuario = $usuarios->fetch_assoc()):
                 ?>
                  <tr>
                      <td class="text-center"><?= $usuario['id_usuario']; ?></td>
                      <td class="text-center"><?= $usuario['nombre']; ?></td>
                      <td class="text-center"><?= $usuario['apellidos']; ?></td>
                      <td class="text-center"><?= $usuario['fecha']; ?></td>
                      <td class="text-center"><?= $usuario['email']; ?></td>
                      <td class="text-center"><?= $usuario['contraseña']; ?></td>
                      <td class="text-center"><?= $usuario['cargo']; ?></td>
                      <td class="text-center">
                        <a href="#" class="editar-usuario" data-id="<?= $usuario['id_usuario']?>">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                      </td>
                      <td class="text-center">
                        <a href="#" class="borrar-usuario" data-id="<?= $usuario['id_usuario']?>" data-nombre="<?= $usuario['nombre']?>">
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
          <button class="btn btn-primary py-3 px-3" id="btnNuevoUsuario">Nuevo usuario</button>
        </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $(".editar-usuario").click(function(e) {
            e.preventDefault();
            var id_usuario = $(this).data('id');
            $.ajax({
                url: "editar-usuario.php",
                method: "GET",
                data: { id_usuario: id_usuario },
                success: function(response) {
                    $('#modalEditarUsuario .modal-body').html(response);
                    $('#modalEditarUsuario').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Error al obtener datos:", error);
                }
            });
        });
    });

    $(document).ready(function() {
        $("#btnNuevoUsuario").click(function() {
            $('#modalNuevoUsuario').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".borrar-usuario").click(function(e) {
            e.preventDefault();
            var id_usuario = $(this).data('id');
            var nombre_usuario = $(this).data('nombre');
            $("#idUsuarioEliminar").text(id_usuario);
            $("#nombreUsuarioEliminar").text(nombre_usuario);
            $('#modalEliminarUsuario').modal('show');

            $("#btnEliminarUsuario").click(function(e) {
            $.ajax({
                url: "eliminar-usuario.php",
                method: "POST",
                data: { id_usuario: id_usuario },
                success: function(response) {
                    if (response == "usuarioEliminado") {
                      $("#modalEliminarUsuario").modal("hide");
                      $("#contenedorUsuarios").load("usuarios.php");
                    } else {
                      alert("No se pudo eliminar al usuario");
                    }
                }
               
            });
        });
        });
    });
</script>

<?php require "modales-edicion-usuarios.php"; ?>

<!-- MANEJAR BOTONES MENÚ SUPERIOR -->

<script>
  $(document).ready(function() {
    window.onpopstate = function(event) {
        $("#contenedorUsuarios").load(location.pathname);
    };
  });

      $(document).ready(function(){
        $("#btnAdmin").click(function(e){
          e.preventDefault();
            $("#contenedorUsuarios").load("../admin.php", function(){
              history.pushState(null,null,"../admin.php");
            });
        });
      });

      $(document).ready(function(){
        $("#btnUsuarios").click(function(e){
          e.preventDefault();
            $("#contenedorUsuarios").load("usuarios.php", function(){
              history.pushState(null,null,"usuarios.php");
            });
        });
      });

      $(document).ready(function(){
        $("#btnEquipos").click(function(e){
          e.preventDefault();
            $("#contenedorUsuarios").load("equipos.php", function(){
              history.pushState(null,null,"equipos.php");
            });
        });
      });

      $(document).ready(function(){
        $("#btnProyectos").click(function(e){
          e.preventDefault();
            $("#contenedorUsuarios").load("proyectos.php", function(){
              history.pushState(null,null,"proyectos.php");
            });
        });
      });

      $(document).ready(function(){
        $("#btnEvaluaciones").click(function(e){
          e.preventDefault();
            $("#contenedorUsuarios").load("evaluaciones.php", function(){
              history.pushState(null,null,"evaluaciones.php");
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
            url: "../archivos/controlador_cerrarsesion.php",
            success: function(data){
                $("#contenedorUsuarios").load("../index.php", function(){
                  history.pushState(null,null,"../index.php");
                });
                window.onpopstate = function(event){
                $("#contenedorUsuarios").load("../index.php");
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