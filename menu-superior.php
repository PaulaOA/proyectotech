  <nav class="navbar navbar-dark bg-success navbar-expand-lg static-top" style="height: 90px;"> 
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/assets/img/logo.png" alt="..." height="36">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage === 'inicio') echo 'active'; ?>" href="#" id="btnInicio">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage === 'miperfil') echo 'active'; ?>" href="#" id="btnMiPerfil">Mi perfil</a>
        </li>

        <!-- MOSTRAR OPCIÓN DE MENSAJES SI ES MENTOR Y OPCIÓN EQUIPOS SI ES PARTICIPANTE -->

        <?php
        require_once("archivos/conexion.php");
        if (!isset($id_usuario)) {
          $id_usuario = $_SESSION['id_usuario'];
        }
        $sql_mentor = "SELECT * FROM mentores WHERE id_usuario = $id_usuario";
        $es_mentor = $conn->query($sql_mentor);

        $sql_participante = "SELECT * FROM participantes WHERE id_usuario = $id_usuario";
        $es_participante = $conn->query($sql_participante);

        if ($es_mentor->num_rows > 0) {
         ?>
         <li class="nav-item">
          <a class="nav-link <?php if ($currentPage === 'mensajes') echo 'active'; ?>" href="#" id="btnMensajes">Mensajes</a>
        </li>
        <?php } else if ($es_participante->num_rows > 0) { ?>

         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php if ($currentPage === 'encontrarequipo' || $currentPage === 'crearequipo' || $currentPage === 'misequipos') echo 'active'; ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Equipos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#" id="btnCrearEquipo">Crear Equipo</a></li>
              <li><a class="dropdown-item" href="#" id="btnEncontrarEquipo">Encuentra tu equipo</a></li>
              <li><a class="dropdown-item" href="#" id="btnMisEquipos">Mis equipos</a></li>
            </ul>
          </li>
          <?php } ?>
        <a class="nav-item nav-link text-justify ml-3 hover-primary" href="#" id="btnSalir">Salir</a>
      </ul>
    </div>
  </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  // Desplegar u ocultar menú de equipos

$(document).ready(function(){
    $('.dropdown-toggle').on('mousedown', function(e){
        e.preventDefault(); // Prevenir la acción predeterminada para evitar que se cierre el menú en el primer clic
        var $menu = $(this).next('.dropdown-menu');
        if ($menu.is(':visible')) {
            $menu.hide(); // Si el menú está visible, ocultarlo
        } else {
            $menu.show(); // Si el menú no está visible, mostrarlo
        }
    });
});
</script>