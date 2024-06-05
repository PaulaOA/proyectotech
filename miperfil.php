<?php
session_start();
require "archivos/conexion.php";

if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $id_usuario = $_SESSION["id_usuario"];
}

$sqlVideo = "SELECT nombrevideo, urlvideo, fecha FROM videos WHERE id_usuario = $id_usuario ORDER BY fecha DESC";
    $queryVideo = mysqli_query($conn, $sqlVideo);

    if (!$queryVideo) {
      die("Error al obtener los videos: " . mysqli_error($conn));
    }
$sqlDocumentos = "SELECT * FROM documentos WHERE id_usuario = $id_usuario";
$queryDocumentos = mysqli_query($conn, $sqlDocumentos);

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
    <title>Inicio | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  
    <style>
    /* Estilo personalizado para el área de carga */
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
    background-color: #343a40; /* Color de fondo del footer */
    color: white; /* Color del texto del footer */
    }

    /* Estilo personalizado para la tabla de videos */
    .table-videos {
      max-width: 800px;
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

  </style>
  
  </head>
  <body>
      <div class="contenedor" id="contenedorMiPerfil">

       <?php include "menu-superior.php" ?>

<div class="responsive bg-dark text-white py-4">
  <div class="row">
    <div class="col-md-8"> 
    <h1 class="texto-margen-izquierdo">
  <?php
   echo "Perfil de"." ".$_SESSION["nombre"]." ". $_SESSION["apellidos"];
  ?>
  </h1>
  <p class="texto-margen-izquierdo">Aquí aparecerá toda la información de <?php echo $_SESSION["nombre"];?></p>
    </div>
  </div>
</div>

<div class="container">
 <div class="row"> 
<div class="col-md-6">
    <div class="card mt-4 mb-4">
    <div class="card-header bg-primary text-white">Datos usuario</div>
      <div class="card-body col-md-6">
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
                <td><?php echo $_SESSION["nombre"]; ?></td>
                <td><?php echo $_SESSION["apellidos"]; ?></td>
                <td><?php echo $_SESSION["fecha"]; ?></td>
                <td><?php echo $_SESSION["email"]; ?></td>
                <td><?php echo $_SESSION["contraseña"]; ?><br><a class="small" href="contraseña.php" id="btnRecuperar">Actualizar contraseña</a></td>
                <td><?php echo $_SESSION["cargo"]; ?></td>
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
          <div class="card-header bg-primary text-white">Subida de video <em>(Desde Youtube)</em></div>
          <div class="card-body">
            <!-- Contenido del segundo formulario -->
            <div class="mb-3">
              <label for="nombrevideo" class="form-label">Nombre del video</label>
              <input type="text" class="form-control" id="nombrevideo" name="nombrevideo">
            </div>
            <div class="mb-3">
              <label for="urlvideo" class="form-label">Url del video</label>
              <input type="text" class="form-control" id="urlvideo" name="urlvideo">

              <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?=$id_usuario?>" >

            </div>
            <button type="submit" class="btn btn-outline-secondary btn-outline-success">Guardar video</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--SUBIDA DE VIDEOS Y EDICION-->

<hr> 
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2 class="text-center mt-5 mb-3">Mis videos</h2>
      <?php if (mysqli_num_rows($queryVideo) > 0): ?>
      <div class="table-responsive table-videos">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Titulo</th>
              <th>Video</th>
               <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
          <?php
          while ($dataVideo = mysqli_fetch_array($queryVideo)) { ?>
      <tr>
        <td><?php  echo htmlspecialchars($dataVideo['nombrevideo']); ?></td>
        <td>
        <iframe width="350" height="180" src="<?php echo htmlspecialchars($dataVideo['urlvideo']); ?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

<div class="col-md-6">
    <h2 class="text-center mt-5 mb-3">Contenido subido</h2>
    <?php if (mysqli_num_rows($queryDocumentos) > 0): ?>
      <div class="table-responsive table-videos">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Archivo</th>
              <th>Descripción</th>
               <th>Ver</th>
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
          <a href="<?php echo htmlspecialchars($dataDocumento['ruta']); ?>" target="_blank">Ver</a>
        </td>
        <td>
        <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
</div>

<!-- MANEJAR BOTONES MENÚ SUPERIOR -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

    <!--SUBIDA CONTENIDO -->
    <script>
      $(document).ready(function() {
       $("#btnSubidaContenido").click(function(event) {
        event.preventDefault();
        
        // Crear un objeto FormData y añadir los datos del formulario
        var formData = new FormData($('#formSubidaContenido')[0]);

        $.ajax({
            type: "POST",
            url: "archivos/subir.php",
            data: formData,
            processData: false, // Evitar que jQuery procese los datos
            contentType: false, // Evitar que jQuery establezca el tipo de contenido
            success: function(response) {
                if (response == "insercionCorrecta") {
                    $("#contenedorMiPerfil").load("miperfil.php");
                } else {
                    alert('Error: ' + response);
                }
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