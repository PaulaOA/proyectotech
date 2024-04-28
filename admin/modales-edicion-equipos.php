<div class="modal fade" id="modalEditarEquipo" tabindex="-1" aria-labelledby="modalEditarEquipoLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarEquipoLabel">Editar Equipo</h5>
      </div>
      <div class="modal-body">
        
        <form id="formEditarEquipo" method="POST">
          <label for="id_equipo" style="margin-left: 10px;">ID Equipo</label>
          <input type="number" name="id_equipo" id="id_equipo" class="form-control" value="<?= $equipo['id_equipo']?>" readonly>
          <label for="nombre" class="texto-label">Nombre Equipo</label>
          <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $equipo['nombre_equipo']?>">
          <label for="creador" class="texto-label">Creador Equipo</label>
          <input type="text" name="creador" id="creador" class="form-control" value="<?= $equipo['creador_equipo']?>">
          <label for="mentor" class="texto-label">Mentor Equipo</label>
          <input type="text" name="mentor" id="mentor" class="form-control" value="<?= $equipo['mentor_equipo']?>">
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
        Se modificarán los datos del equipo
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
            $("#modalEditarEquipo").modal("hide");
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#btnConfirmar").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "actualizar-equipo.php",
                method: "POST",
                data: $("#formEditarEquipo").serialize(),
                success: function(response) {
                    if (response == "equipoEditado") {
                      $("#modalGuardarCambios").modal("hide");
                      $("#modalEditarEquipo").modal("hide");
                      $("#contenedorEquipos").load("equipos.php");
                    } else {
                      alert("No se pudieron guardar los cambios");
                    }
                }
               
            });
        });
    });
</script>