<?php
session_start();
include "consultas/sql-miperfil.php";
$currentPage = 'miperfil';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Inicio | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  
    <style>
    .upload-area {
      border: 2px dashed #ccc;
      padding: 20px;
      text-align: center;
      cursor: pointer;
    }
    .upload-area:hover {
      background-color: #f8f9fa;
    }

    .contenedor {
        width: 100%;
        height: 100%;
      }

    .texto-margen-izquierdo {
      margin-left: 40px;
    }  

      html {
    position: relative;
    min-height: 100%;
    }
   html {
    position: relative;
    min-height: 100%;
    }

    body {
    margin-bottom: 140px; /* Ajusta este valor según la altura de tu footer */
    }

    footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 120px; /* Ajusta la altura de tu footer según lo necesites */
    background-color: #343a40;
    color: white;
    }

    .table-videos {
      max-width: 850px;
      margin: auto;
    }

    .table-videos th,
    .table-videos td {
      text-align: center;
      vertical-align: middle;
    }

    .table-videos iframe {
      max-width: 100%;
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
      <div class="contenedor" id="contenedorMiPerfil">

       <?php include "menu-superior.php" ?>

<div class="responsive bg-dark text-white py-4">
  <div class="row">
    <div class="col-md-8"> 
    <h1 class="texto-margen-izquierdo">
  <?= "Perfil de"." ".$_SESSION["nombre"]." ". $_SESSION["apellidos"];?>
  </h1>
  <p class="texto-margen-izquierdo">Aquí aparecerá toda la información de <?= $_SESSION["nombre"];?></p>
    </div>
  </div>
</div>

<div class="container">
 <div class="row"> 
<div class="col-md-8">
    <div class="card mt-4 mb-4">
    <div class="card-header bg-primary text-white">Datos usuario</div>
      <div class="card-body col-md-8">
        <table class="table table-striped mb-2">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Cargo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $_SESSION["nombre"]; ?></td>
                <td><?= $_SESSION["apellidos"]; ?></td>
                <td><?= $_SESSION["fecha"]; ?></td>
                <td><?= $_SESSION["email"]; ?></td>
                <td><?= $_SESSION["contraseña"]; ?><br><a class="small" href="contraseña.php" id="btnRecuperar">Actualizar contraseña</a></td>
                <td><?= $_SESSION["cargo"]; ?></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <form id="formSubidaContenido" enctype="multipart/form-data">
        <div class="card mt-4 mb-4">
          <div class="card-header bg-primary text-white">Subida de contenido</div>
          <div class="card-body">
            <!-- Contenido del primer formulario -->
            <div class="mb-3">
              <label for="file" class="form-label">Archivo</label>
              <input type="file" class="form-control" id="file" name="file" aria-describedby="file1">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Descripción</label>
              <input type="text" class="form-control" id="desc" name="desc">

              <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?=$id_usuario?>" >

            </div>
            <button class="btn btn-outline-secondary btn-outline-success" id="btnSubidaContenido">Subir</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <form action="./archivos/subirautorizacion.php" method="POST" enctype="multipart/form-data">
        <div class="card mt-4 mb-4">
          <div class="card-header bg-primary text-white">Envío de autorización paterna</div>
          <div class="card-body">
            <!-- Contenido del formulario de envio de autorización-->
            <div class="mb-3">
              <label for="file" class="form-label">Archivo</label>
              <input type="file" class="form-control" id="file" name="file" accept=".pdf" aria-describedby="file1">
            </div>
            <button type="submit" name='submit' class="btn btn-outline-secondary btn-outline-success">Enviar</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <form action="./archivos/recibvideo.php" method="POST">
        <div class="card mt-4 mb-4">
          <div class="card-header bg-primary text-white">Subida de vídeo <em>(Desde Youtube)</em></div>
          <div class="card-body">
            <!-- Contenido del segundo formulario -->
            <div class="mb-3">
              <label for="nombrevideo" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombrevideo" name="nombrevideo">
            </div>
            <div class="mb-3">
              <label for="urlvideo" class="form-label">Url del vídeo</label>
              <input type="text" class="form-control" id="urlvideo" name="urlvideo">

              <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?=$id_usuario?>" >

            </div>
            <button type="submit" class="btn btn-outline-secondary btn-outline-success">Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--SUBIDA DE VIDEOS Y EDICION-->

<hr> 
<div class="container">
    <div class="col-md-12">
      <h2 class="text-center mt-5 mb-3">Mis vídeos</h2>
      <?php if (mysqli_num_rows($queryVideo) > 0): ?>
      <div class="table-responsive table-videos">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Título</th>
              <th>Vídeo</th>
               <th colspan="2">Compartir con</th>
               <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
          <?php
          while ($dataVideo = mysqli_fetch_array($queryVideo)) { ?>
      <tr>
        <td><?php  echo htmlspecialchars($dataVideo['nombrevideo']); ?></td>
        <td>
        <iframe width="400" height="230" src="<?php echo htmlspecialchars($dataVideo['urlvideo']); ?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </td>
        <td>
          <select name="id_equipo_video" id="equipoSeleccionadoVideo" class="form-control" style="margin-bottom:10px">
            <option value="">Selecciona un equipo</option>
            <?php 
                if (!empty($equiposArray)) {
                    foreach ($equiposArray as $equipo) {
                        echo "<option value='".$equipo['id_equipo']."'>".$equipo['nombre_equipo']. "</option>";
                    }
                } else {
                    echo "<option value=''>No existen equipos</option>";
                }
            ?>
          </select>
        </td>
        <td>
          <a href="#" id="compartirVideo" data-video="<?=$dataVideo['id']?>" data-user="<?=$id_usuario?>" class="btn btn-primary"><i class="fas fa-check-circle"></i></a>
        </td>
        <td>
        <a href="./archivos/borrarvideo.php?fecha=<?php echo htmlspecialchars($dataVideo['fecha']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro que deseas eliminar el video?');"><i class="bi bi-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
        
      </tbody>
    </table>
  </div>
  <?php else: ?>
      <p class="text-center mt-4">Aún no se ha subido ningún video.</p>
    <?php endif; ?>
</div>
</div>

<div class="container">
<div class="col-md-12">
    <h2 class="text-center mt-5 mb-3">Contenido subido</h2>
    <?php if (mysqli_num_rows($queryDocumentos) > 0): ?>
      <div class="table-responsive table-videos">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Archivo</th>
              <th>Descripción</th>
               <th>Ver</th>
               <th colspan="2">Compartir con</th>
               <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
          <?php
          while ($dataDocumento = mysqli_fetch_array($queryDocumentos)) { ?>
      <tr>
        <td><?php  echo htmlspecialchars($dataDocumento['nombre']); ?></td>
        <td><?php  echo htmlspecialchars($dataDocumento['descripcion']); ?></td>
        <td>
          <a href="<?php echo htmlspecialchars($dataDocumento['ruta']); ?>" target="_blank"><i class="fas fa-eye eye-icon"></i></a>
        </td>
        
        <td>
          <select name="id_equipo" id="equipoSeleccionado" class="form-control" style="margin-bottom:10px">
            <option value="">Selecciona un equipo</option>
            <?php 
                if (!empty($equiposArray)) {
                    foreach ($equiposArray as $equipo) {
                        echo "<option value='".$equipo['id_equipo']."'>".$equipo['nombre_equipo']. "</option>";
                    }
                } else {
                    echo "<option value=''>No existen equipos</option>";
                }
                ?>
          </select>
        </td>
        <td>
          <a href="#" id="compartirDocumento" data-id="<?=$dataDocumento['id']?>" data-usuario="<?=$id_usuario?>" class="btn btn-primary"><i class="fas fa-check-circle"></i></a>
        </td>
        <td>
        <a href="#" class="borrar-documento btn btn-danger" data-id="<?=$dataDocumento['id']?>"><i class="bi bi-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
        
      </tbody>
    </table>
  </div>
  <?php else: ?>
      <p class="text-center mt-4">Aún no se ha subido ningún archivo.</p>
    <?php endif; ?>
    </div>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
      $(document).ready(function() {
        var idDocumentoAEliminar;

       $("#btnSubidaContenido").click(function(event) {
        event.preventDefault();
        
        var formData = new FormData($('#formSubidaContenido')[0]);

        $.ajax({
            type: "POST",
            url: "archivos/subir.php",
            data: formData,
            processData: false,
            contentType: false, 
            success: function(response) {
                if (response == "insercionCorrecta") {
                    $("#contenedorMiPerfil").load("miperfil.php");
                } else {
                    alert('Error: ' + response);
                }
            }
        });
    });

      $(".borrar-documento").click(function(event) {
          event.preventDefault();
          var idDocumento = $(this).data('id');
      
           $("#modalEliminarDocumento").css("display", "block");

           idDocumentoAEliminar = idDocumento;
      });

      $(".close-modal").click(function() {
    $(".modal").css("display", "none");
  });

      $("#btnEliminarDocumento").click(function() {
        $.ajax({
            url: 'archivos/borrar-documento.php',
            type: 'POST',
            data: { idDocumentoAEliminar: idDocumentoAEliminar },
            success: function(response) {
                if (response == "documentoEliminado") {
                    $("#modalEliminarDocumento").hide();
                    $("#contenedorMiPerfil").load("miperfil.php");
                } else {
                    alert('Error al eliminar el documento.');
                }
            },
            error: function() {
                alert('Error en la solicitud.');
            }
        });
    });
});
</script>

<script>

$(document).ready(function() {
    $('#compartirDocumento').on('click', function(event) {
        event.preventDefault();

        var equipoSeleccionado = $('#equipoSeleccionado').val();
        var idDocumento = $(this).data('id');
        var idUsuario = $(this).data('usuario');

        if (equipoSeleccionado === "") {
              $("#modalSeleccioneEquipo").css("display", "block");
            return;
        }

        $.ajax({
            url: 'archivos/compartir-documento.php',
            type: 'POST',
            data: { id_equipo: equipoSeleccionado,
                    id_documento: idDocumento, id_usuario : idUsuario },
            success: function(response) {
                if (response == "compartidoConExito") {
                   $("#modalCompartidoConExito").css("display", "block");
                } else if (response == 'errorCompartir'){
                   $("#modalErrorCompartir").css("display", "block");
                } else if(response == 'documentoYaCompartido'){
                   $("#modalYaCompartido").css("display", "block");
                } else {
                  alert('Error');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                alert('Hubo un error al procesar la solicitud.');
            }
        });
    });

       $('#compartirVideo').on('click', function(event) {
        event.preventDefault();

        var equipoSeleccionado = $('#equipoSeleccionadoVideo').val();
        var idVideo = $(this).data('video');
        var idUsuario = $(this).data('user');

        if (equipoSeleccionado === "") {
              $("#modalSeleccioneEquipo").css("display", "block");
            return;
        }

        $.ajax({
            url: 'archivos/compartir-video.php',
            type: 'POST',
            data: { id_equipo: equipoSeleccionado,
                    id_video: idVideo, id_usuario : idUsuario },
            success: function(response) {
                if (response == "compartidoConExito") {
                   $("#modalCompartido").css("display", "block");
                } else if (response == 'errorCompartirVideo'){
                   $("#modalErrorCompartirVideo").css("display", "block");
                } else if(response == 'videoYaCompartido'){
                   $("#modalVideoYaCompartido").css("display", "block");
                } else {
                  alert('Error');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                alert('Hubo un error al procesar la solicitud.');
            }
        });
    });
    $(".close-modal").click(function() {
             $(".modal").css("display", "none");
          });
});
</script>

<!-- MANEJAR BOTONES MENÚ SUPERIOR -->

<script>
      $(document).ready(function() {
        window.onpopstate = function(event) {
        $("#contenedorMiPerfil").load(location.pathname);
        };
      });

          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnMisEquipos").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("misequipos.php", function(){
                  history.pushState(null,null,"misequipos.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnMensajes").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("mensajes.php", function(){
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
                    $("#contenedorMiPerfil").load("index.php", function(){
                      history.pushState(null,null,"index.php");
                    });
                    window.onpopstate = function(event){
                    $("#contenedorMiPerfil").load("index.php");
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

<div id="modalEliminarDocumento" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center"></h1>
     <p>¿Está seguro de eliminar el documento?</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarDocumento">Eliminar</button>
      </div>
  </div>
</div>

 <div id="modalYaCompartido" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Documento compartido</h1>
    <p class="text-center">El documento ya había sido compartido con el equipo seleccinado</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

<div id="modalVideoYaCompartido" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Vídeo compartido</h1>
    <p class="text-center">El vídeo ya había sido compartido con el equipo seleccinado</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

<div id="modalErrorCompartir" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Hubo un error</h1>
    <p class="text-center">No se pudo compartir el documento</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

<div id="modalErrorCompartirVideo" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Hubo un error</h1>
    <p class="text-center">No se pudo compartir el vídeo</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

<div id="modalCompartidoConExito" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">¡Compartido!</h1>
    <p class="text-center">El documento se compartió con éxito</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

<div id="modalCompartido" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">¡Compartido!</h1>
    <p class="text-center">El vídeo se compartió con éxito</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

<div id="modalSeleccioneEquipo" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Equipo sin marcar</h1>
     <p>Seleccione un equipo para poder compartir</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal">Aceptar</button>
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