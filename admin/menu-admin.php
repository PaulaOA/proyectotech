 <nav class="navbar navbar-dark bg-success navbar-expand-lg static-top"> 
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
          <a class="nav-link <?php if ($currentPage === 'usuarios') echo 'active'; ?>" href="#" id="btnUsuarios">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage === 'equipos') echo 'active'; ?>" href="#" id="btnEquipos">Equipos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage === 'proyectos') echo 'active'; ?>" href="#" id="btnProyectos">Proyectos</a>
        </li>
        <a class="nav-item nav-link text-justify ml-3 hover-primary" href="#" id="btnSalir">Salir</a>
      </ul>
    </div>
  </div>
</nav>