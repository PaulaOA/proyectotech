<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
      </div>
      <div class="modal-body">
        
        <form id="formEditarUsuario" method="POST">
          <label for="id_usuario" style="margin-left: 10px;">ID</label>
          <input type="number" name="id_usuario" id="id_usuario" class="form-control" value="<?= $usuario['id_usuario']?>" readonly>
          <label for="nombre" class="texto-label">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $usuario['nombre']?>">
          <label for="apellidos" class="texto-label">Apellidos</label>
          <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?= $usuario['apellidos']?>">
          <label for="fecha" class="texto-label">Fecha</label>
          <input type="date" name="fecha" id="fecha" class="form-control" value="<?= $usuario['fecha']?>">
          <label for="email" class="texto-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="<?= $usuario['email']?>" readonly>
          <label for="contraseña" class="texto-label">Contraseña</label>
          <input type="password" name="contraseña" id="contraseña" class="form-control" value="<?= $usuario['contraseña']?>" readonly>
          <label for="cargo" class="form-label texto-label">Cargo</label>
          <select name="cargo" id="cargo" class="form-select">
            <option <?php if ($usuario['cargo'] == 'Mentor') echo "selected" ?>>Mentor</option>
            <option <?php if ($usuario['cargo'] == 'Participante') echo "selected" ?>>Participante</option>
          </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="btnCancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarCambios">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnCancelar").click(function() {
            $("#modalCancelar").modal("show");
        });
    });
</script>
<script>

    $(document).ready(function() {
        $("#btnGuardarCambios").click(function() {
            $("#modalGuardarCambios").modal("show");
        });
    });
</script>

<div class="modal fade" id="modalGuardarCambios" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalConfirmacionLabel">¿Guardar cambios?</h5>
      </div>
      <div class="modal-body">
        Se modificarán los datos del usuario
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Seguir editando</button>
        <button type="button" class="btn btn-primary" id="btnConfirmar">Confirmar cambios</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalConfirmacionLabel">¿Desea cancelar?</h5>
      </div>
      <div class="modal-body">
        Los cambios no se guardarán
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Seguir editando</button>
        <button type="button" class="btn btn-primary" id="btnQuieroCancelar">Sí, quiero cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnQuieroCancelar").click(function() {
            $("#modalCancelar").modal("hide");
            $("#modalEditarUsuario").modal("hide");
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("#btnConfirmar").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "actualizar-usuario.php",
                method: "POST",
                data: $("#formEditarUsuario").serialize(),
                success: function(response) {
                   const validResponses = [
                      "usuarioEditado",
                      "usuarioEditadomentorEliminado",
                      "usuarioEditadosinRegistro",
                      "usuarioEditadoyaExiste",
                      "usuarioEditadomentorAgregado"
                  ];
                    if (validResponses.includes(response)) {
                      $("#modalGuardarCambios").modal("hide");
                      $("#modalEditarUsuario").modal("hide");
                      $("#contenedorUsuarios").load("usuarios.php");
                    } else {
                      alert("No se pudieron guardar los cambios");
                    }
                }
               
            });
        });
    });
</script>

<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalNuevoUsuario" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNuevoUsuario">Nuevo Usuario</h5>
      </div>
      <div class="modal-body">
        
        <form id="formNuevoUsuario" method="POST">
          <label for="nombre" class="texto-label">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
          <label for="apellidos" class="texto-label">Apellidos</label>
          <input type="text" name="apellidos" id="apellidos" class="form-control">
          <label for="fecha" class="texto-label">Fecha</label>
          <input type="date" name="fecha" id="fecha" class="form-control">
          <label for="email" class="texto-label">Email</label>
          <input type="email" name="email" id="email" class="form-control">
          <label for="contraseña" class="texto-label">Contraseña</label>
          <input type="text" name="contraseña" id="contraseña" class="form-control">
          <label for="cargo" class="form-label texto-label">Cargo</label>
          <select name="cargo" id="cargo" class="form-select">
            <option selected>Elige una opción</option>
            <option>Mentor</option>
            <option>Participante</option>
          </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="btnCancelarUsuario">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnCrearUsuario">Crear Usuario</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnCancelarUsuario").click(function() {
            $("#modalCancelarUsuario").modal("show");
        });
    });
</script>
<script>

    $(document).ready(function() {
        $("#btnCrearUsuario").click(function() {
            $("#modalCrearUsuario").modal("show");
        });
    });
</script>

<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-labelledby="modalCrearUsuarioLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCrearUsuarioLabel">¿Crear Usuario?</h5>
      </div>
      <div class="modal-body">
        Se creará un nuevo usuario con los datos introducidos
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnConfirmarUsuario">Crear usuario</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCancelarUsuario" tabindex="-1" aria-labelledby="modalCancelarUsuarioLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCancelarUsuarioLabel">¿Desea cancelar?</h5>
      </div>
      <div class="modal-body">
       Los cambios no se guardarán
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Seguir editando</button>
        <button type="button" class="btn btn-primary" id="btnCancelarNuevoUsuario">Sí, quiero cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnCancelarNuevoUsuario").click(function() {
            $("#modalCancelarUsuario").modal("hide");
            $("#modalNuevoUsuario").modal("hide");
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#btnConfirmarUsuario").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "crear-usuario.php",
                method: "POST",
                data: $("#formNuevoUsuario").serialize(),
                success: function(response) {
                    if (response == "usuarioCreado") {
                      $("#modalCrearUsuario").modal("hide");
                      $("#modalNuevoUsuario").modal("hide");
                      $("#contenedorUsuarios").load("usuarios.php");
                    } else {
                      alert("No se pudieron guardar los cambios");
                    }
                }
               
            });
        });
    });
</script>

<div class="modal fade" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="modalEliminarUsuarioLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarUsuarioLabel">¿Eliminar Usuario?</h5>
      </div>
      <div class="modal-body">
        El usuario <span id="nombreUsuarioEliminar"></span> con ID <span id="idUsuarioEliminar"></span> será eliminado
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarUsuario">Eliminar Usuario</button>
      </div>
    </div>
  </div>
</div>
