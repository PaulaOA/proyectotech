
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
      <fieldset class="row-auto">
          <legend class="col-form-label col-sm-2 pt-0 texto-label">División</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="division" id="junior" value="Junior" <?php if ($equipo['division'] == 'Junior') echo "checked"?>>
              <label class="form-check-label" for="junior">
                Junior
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="division" id="senior" value="Senior" <?php if ($equipo['division'] == 'Senior') echo "checked"?>>
              <label class="form-check-label" for="senior">
                Senior
              </label>
            </div>
          </div>
        </fieldset>
        <label for="estado" class="texto-label">Estado</label>
        <select name="estado" id="estado" class="form-select texto-label">
        <option <?php if ($equipo['estado'] == 'pendiente') echo "selected" ?>>Pendiente</option>
        <option <?php if ($equipo['estado'] == 'aceptada') echo "selected" ?>>Aceptada</option>
        <option <?php if ($equipo['estado'] == 'rechazada') echo "selected" ?>>Rechazada</option>
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
        Se modificarán los datos del equipo
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

<div class="modal fade" id="modalEliminarEquipo" tabindex="-1" aria-labelledby="modalEliminarEquipoLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarEquipoLabel">¿Eliminar Equipo?</h5>
      </div>
      <div class="modal-body">
        "<span id="nombreEquipoEliminar"></span>" con ID <span id="idEquipoEliminar"></span> será eliminado
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarEquipo">Eliminar Equipo</button>
      </div>
    </div>
  </div>
</div>

<?php
include "../archivos/conexion.php";
$sql = "SELECT registro.nombre AS nombre_mentor, mentores.id_mentor FROM registro INNER JOIN mentores WHERE mentores.id_usuario = registro.id_usuario";
$resultado = $conn->query($sql);

 ?>

<div class="modal fade" id="modalNuevoEquipo" tabindex="-1" aria-labelledby="modalNuevoEquipo" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNuevoEquipo">Nuevo Equipo</h5>
      </div>
      <div class="modal-body">
        
        <form id="formNuevoEquipo" method="POST">
          <label for="nombre" class="texto-label">Nombre Equipo</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
          <label for="id_mentor" class="texto-label">Mentor Equipo</label>
          <select name="id_mentor" id="id_mentor" class="form-control">
            <option value="">Selecciona un mentor</option>
            <?php 
            if ($resultado->num_rows > 0) {
              while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='".$fila["id_mentor"]."'>".$fila['nombre_mentor']. "</option>";
              }
            } else {
              echo "<option value=''>No existen mentores</option>";
            }
            ?>
          </select>
          <fieldset class="row-auto">
          <legend class="col-form-label col-sm-2 pt-0 texto-label">División</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="division" id="junior" value="Junior" checked>
              <label class="form-check-label" for="junior">
                Junior
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="division" id="senior" value="Senior">
              <label class="form-check-label" for="senior">
                Senior
              </label>
            </div>
          </div>
        </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="btnCancelarEquipo">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnCrearEquipo">Crear Equipo</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnCancelarEquipo").click(function() {
            $("#modalCancelarEquipo").modal("show");
        });
    });
</script>
<script>

    $(document).ready(function() {
        $("#btnCrearEquipo").click(function() {
            $("#modalCrearEquipo").modal("show");
        });
    });
</script>

<div class="modal fade" id="modalCrearEquipo" tabindex="-1" aria-labelledby="modalCrearEquipoLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCrearEquipoLabel">¿Crear Equipo?</h5>
      </div>
      <div class="modal-body">
        Se creará un nuevo equipo con los datos introducidos
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnConfirmarEquipo">Crear equipo</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCancelarEquipo" tabindex="-1" aria-labelledby="modalCancelarEquipoLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCancelarEquipoLabel">¿Desea cancelar?</h5>
      </div>
      <div class="modal-body">
       Los cambios no se guardarán
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Seguir editando</button>
        <button type="button" class="btn btn-primary" id="btnCancelarNuevoEquipo">Sí, quiero cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnCancelarNuevoEquipo").click(function() {
            $("#modalCancelarEquipo").modal("hide");
            $("#modalNuevoEquipo").modal("hide");
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#btnConfirmarEquipo").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "crear-equipo.php",
                method: "POST",
                data: $("#formNuevoEquipo").serialize(),
                success: function(response) {
                    if (response == "equipoCreado") {
                      $("#modalCrearEquipo").modal("hide");
                      $("#modalNuevoEquipo").modal("hide");
                      $("#contenedorEquipos").load("equipos.php");
                    } else {
                      alert("No se pudieron guardar los cambios");
                    }
                }
               
            });
        });
    });
</script>