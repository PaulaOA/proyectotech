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

<div class="modal fade" id="modalGuardarCambios" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
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

<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
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
                    if (response == "usuarioEditado") {
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