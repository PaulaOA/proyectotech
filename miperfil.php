<?php
session_start();
if (empty($_SESSION["nombre"])) {
    header("location: index.php");   
}
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
  </style>
  
  </head>
  <body>
      <div class="contenedor" id="contenedorMiPerfil">

       <?php include "menu-superior.php" ?>

<div class="responsive bg-dark text-white py-4">
  <div class="row">
    <div class="col-md-8"> 
    <h1>
  <?php
   echo "Perfil de"." ".$_SESSION["nombre"]." ". $_SESSION["apellidos"];
  ?>
  </h1>
  <p>Aquí aparecerá toda la información de <?php echo $_SESSION["nombre"];?></p>
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
                <td><?php echo $_SESSION["contraseña"]; ?></td>
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
      <form action="./archivos/subir.php" method="POST" enctype="multipart/form-data">
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
            </div>
            <button type="submit" class="btn btn-outline-secondary btn-outline-success">Subir</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <form action="./archivos/recibvideo.php" method="POST" enctype="multipart/form-data">
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
<?php 
   require_once("./archivos/conexion.php");
    $sqlVideo   = ("SELECT * FROM videos ORDER BY id DESC");
    $queryVideo = mysqli_query($conn, $sqlVideo);

  ?>
<h2 class="text-center mt-5 mb-3">Mis videos</h2>
  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th>Titulo del video</th>
          <th>Video</th>
           <th>Acción</th>
        </tr>
      </thead>
      <tbody>
      <?php
        while ($dataVideo = mysqli_fetch_array($queryVideo)) { ?>
        <tr>
          <td><?php  echo $dataVideo['nombrevideo']; ?></td>
          <td>
            <iframe width="253" height="200" src="<?php echo $dataVideo['urlvideo']; ?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </td>
          <td>
            <a href="./archivos/borrarvideo.php?idVideo=<?php echo $dataVideo['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro que deseas eliminar el video?');">Borrar video</a>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- MANEJAR BOTONES MENÚ SUPERIOR -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
                window.onpopstate = function(event){
                $("#contenedorMiPerfil").load("miperfil.php");
              };
            });
          });

        </script>

        <script>
          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
                window.onpopstate = function(event){
                $("#contenedorMiPerfil").load("miperfil.php");
              };
            });
          });

        </script>

        <script>
          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
                window.onpopstate = function(event){
                $("#contenedorMiPerfil").load("miperfil.php");
              };
            });
          });

        </script>

         <script>
          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorMiPerfil").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
                window.onpopstate = function(event){
                $("#contenedorMiPerfil").load("miperfil.php");
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