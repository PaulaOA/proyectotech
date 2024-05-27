<?php
session_start();
require_once("archivos/conexion.php");
$currentPage = 'inicio';
$solicitudesParticipantes = null;

if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];
}

if (!isset($_SESSION['modal_mostrado']) && $_SESSION["cargo"] == "Mentor") {
  $consultaEquipos = "SELECT equipos.*
        FROM equipos
        INNER JOIN mentores ON equipos.id_mentor = mentores.id_mentor
        INNER JOIN registro ON mentores.id_usuario = registro.id_usuario
        WHERE equipos.estado = 'pendiente' 
        AND mentores.id_usuario = " .$id_usuario;
$solicitudes = $conn->query($consultaEquipos);

} else if (!isset($_SESSION['modal_mostrado']) && $_SESSION["cargo"] == "Participante") {
$consultaParticipantes = "SELECT COUNT(se.id_solicitud) AS solicitudes_pendientes
                          FROM equipos e
                          JOIN solicitudes_equipo se ON e.id_equipo = se.id_equipo
                          JOIN participantes p ON se.id_participante = p.id_participante
                          WHERE e.id_creador = $id_usuario
                            AND se.estado = 'pendiente'
                            AND p.id_usuario != e.id_creador";
$solicitudesParticipantes = $conn->query($consultaParticipantes);
}
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
    /* Estilo para las imágenes del carousel */
    .carousel-item img {
      width: 100%;
      height: 300px; /* Altura deseada para las imágenes */
      object-fit: cover; /* Ajustar la imagen para cubrir todo el contenedor */
    }

    .darken-img {
      width: 100%;
      height: 300px; /* Altura deseada para las imágenes */
      object-fit: cover; /* Ajustar la imagen para cubrir todo el contenedor */
      filter: brightness(50%); /* Oscurecer la imagen al 50% */
    }

    .contenedor {
        width: 100%;
        height: 100%;
      }
    /* Estilos para el video */
    .video-responsive {
        position: relative;
        padding-bottom: 56.25%; /* 16/9 ratio */
        padding-top: 30px; /* IE6 workaround*/
        height: 0;
        overflow: hidden;
      }

    .video-responsive iframe,
    .video-responsive object,
    .video-responsive embed {  
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
      }
    iframe{
          width: 100%;
          height: 100vh;
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
    <title>Inicio | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  </head>
  <body>

    <div class="contenedor" id="contenedorInicio">

 <?php include "menu-superior.php" ?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active d-item">
      <img src="images/imagen1.jpg" class="d-block w-100 darken-img" alt="slider 1">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Proyectos</h1>
      <a href="https://technovation.tgmbp.com/eventos/" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>  
    </div>
    <div class="carousel-item d-item">
      <img src="images/imagen2.jpg" class="d-block w-100 darken-img" alt="slider 2">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Concursos</h1>
      <a href="https://technovation.tgmbp.com/ediciones-anteriores/" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>  
    </div>
    <div class="carousel-item d-item">
      <img src="images/imagen3.jpg" class="d-block w-100 darken-img" alt="slider 3">
      <div class="carousel-caption top-0 mt-4">
      <h1 class="display-1 fw-bolder text-capitalize">Sobre nosotros</h1>
      <a href="https://technovation.tgmbp.com/" class="btn btn-primary px-4 py-2 fs-5 mt-5">Información</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<div class="container">
  <h1 class="mt-4">
  <?php
   echo "¡Bienvenid@,"." ".$_SESSION["nombre"]." ". $_SESSION["apellidos"]."!";
  ?>
  </h1>
  <p></p>
</div>
<hr>

<!--MOSTRAR GALERIA DE VIDEOS SUBIDOS-->
<?php 
 require_once("./archivos/conexion.php");

  $sqlVideo   = ("SELECT nombrevideo, urlvideo, fecha FROM videos ORDER BY fecha DESC LIMIT 1");
  $queryVideo = mysqli_query($conn, $sqlVideo);
  $totalVideo = mysqli_num_rows($queryVideo);
  $dataVideo  = mysqli_fetch_array($queryVideo);
?>

    <div class="container">

      <div class="row text-center">
        <div class="col-6">
          <?php 
          if( $totalVideo >0){ ?>
          <h2><?php echo $dataVideo['nombrevideo']; ?></h2>

          <div class="video-responsive">
            <iframe src="<?php echo $dataVideo['urlvideo']; ?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
          </div>
        <?php }else{ ?>
        <h2>No hay contenido</h2>
        <?php } ?>

        </div>
      </div>
    </div> 
<hr>
    <!-- MANEJAR BOTONES MENÚ SUPERIOR -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    window.onpopstate = function(event) {
        $("#contenedorInicio").load(location.pathname);
    };
  });

          $(document).ready(function(){
            $("#btnInicio").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("inicio.php", function(){
                  history.pushState(null,null,"inicio.php");
                });
              });
             });

          $(document).ready(function(){
            $("#btnMiPerfil").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("miperfil.php", function(){
                  history.pushState(null,null,"miperfil.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnCrearEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("crearequipo.php", function(){
                  history.pushState(null,null,"crearequipo.php");
                });
            });
          });

          $(document).ready(function(){
            $("#btnEncontrarEquipo").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("encontrarequipo.php", function(){
                  history.pushState(null,null,"encontrarequipo.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnMisEquipos, #btnVer").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("misequipos.php", function(){
                  history.pushState(null,null,"misequipos.php");
                });
            });
           });

          $(document).ready(function(){
            $("#btnMensajes, #btnVerAhora").click(function(e){
              e.preventDefault();
                $("#contenedorInicio").load("mensajes.php", function(){
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
                    $("#contenedorInicio").load("index.php", function(){
                      history.pushState(null,null,"index.php");
                    });
                    window.onpopstate = function(event){
                    $("#contenedorInicio").load("index.php");
                  };
                    }
                });
            });
        });
    </script>

    <script>
      $(document).ready(function() {
        <?php
          if ($solicitudes->num_rows > 0) {
          $_SESSION['modal_mostrado'] = true; 
            ?>
          $("#modalSolicitud").css("display", "block");

        <?php } ?>
      });

      $(document).ready(function() {
          $(".close-modal").click(function() {
             $(".modal").css("display", "none");
          });
      });
    </script>

        
        <?php
          if ($solicitudesParticipantes && $solicitudesParticipantes->num_rows > 0) {
            $fila = $solicitudesParticipantes->fetch_assoc();
            $solicitudesPendientes = $fila["solicitudes_pendientes"];
            if ($solicitudesPendientes > 0) {
               $_SESSION['modal_mostrado'] = true; 
              echo '<script>
                      $(document).ready(function() {
                        $("#modalSolicitudParticipante").css("display", "block");
                      });

                      $(document).ready(function() {
                        $(".close-modal").click(function() {
                           $(".modal").css("display", "none");
                        });
                    });
                  </script>';
  }
}
?>

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

 <div id="modalSolicitud" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Solicitudes pendientes</h1>
    <p class="text-center">Tienes solicitudes de equipo pendientes de responder</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnVerAhora">Ver Ahora</button>
      </div>
  </div>
</div>

 <div id="modalSolicitudParticipante" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Solicitudes pendientes</h1>
    <p class="text-center">Tienes nuevas solicitudes para unirse a tu equipo</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnVer">Ver Ahora</button>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>