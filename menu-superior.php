 

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
        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage === 'crearequipo') echo 'active'; ?>" href="#" id="btnCrearEquipo">Crea tu equipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage === 'encontrarequipo') echo 'active'; ?>" href="#" id="btnEncontrarEquipo">Encuentra tu equipo</a>
        </li>
        <?php
        require_once("archivos/conexion.php");
        if (!isset($id_usuario)) {
          $id_usuario = $_SESSION['id_usuario'];
        }
        $sql_mentor = "SELECT * FROM mentores WHERE id_usuario = $id_usuario";
        $es_mentor = $conn->query($sql_mentor);
        if ($es_mentor->num_rows > 0) {
         ?>
         <li class="nav-item">
          <a class="nav-link <?php if ($currentPage === 'mensajes') echo 'active'; ?>" href="#" id="btnMensajes">Mensajes</a>
        </li>
        <?php
          }
      ?>
        <a class="nav-item nav-link text-justify ml-3 hover-primary" href="#" id="btnSalir">Salir</a>
      </ul>
    </div>
  </div>
</nav>