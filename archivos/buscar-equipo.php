<?php
require_once("conexion.php");

if (isset($_POST['busquedaNombre']) || isset($_POST['division'])) {
    $nombreEquipo = isset($_POST['busquedaNombre']) ? mysqli_real_escape_string($conn, $_POST['busquedaNombre']) : '';
    $division = isset($_POST['division']) ? mysqli_real_escape_string($conn, $_POST['division']) : '';

    $sql_equipos = "SELECT *, registro.nombre AS nombre_creador
                    FROM equipos
                    INNER JOIN registro ON equipos.id_creador = registro.id_usuario
                    WHERE estado = 'aceptada'";

    if (!empty($nombreEquipo)) {
        $sql_equipos .= " AND LOWER(nombre_equipo) LIKE LOWER('%$nombreEquipo%')";
    }

    if (!empty($division)) {
        $sql_equipos .= " AND division = '$division'";
    }

    $equiposEncontrados = $conn->query($sql_equipos);

    if ($equiposEncontrados && $equiposEncontrados->num_rows > 0) {
        echo "<h3>Resultados de la búsqueda:</h3>";

        if (isset($_POST['idParticipante'])) {
            $id_participante = $_POST['idParticipante'];

            while ($equipo = $equiposEncontrados->fetch_assoc()) {
                echo "<div class='col-md-4'>
                       <div class='card my-3'>
                        <div class='card-body'>
                         <h5 class='card-title text-center mb-4'>{$equipo['nombre_equipo']}</h5>
                          <p>Creador del equipo: {$equipo['nombre_creador']}</p>
                          <p>División: {$equipo['division']}</p>
                         </div>
                         <div class='card-footer text-center'>
                         <a href='#' class='btn btn-primary' id='btnQuieroUnirme' data-id-equipo='{$equipo['id_equipo']}' data-id-participante='$id_participante'>¡Quiero unirme!</a>
                         </div>
                        </div>
                      </div>";
            }
        } else {
            echo "<p>Error al obtener tu identificador como participante.</p>";
        }
    } else {
        echo "<p>No se encontraron equipos con los parámetros de búsqueda.</p>";
    }
} else {
    echo "<p>Por favor, ingresa un nombre de equipo o selecciona una división para realizar la búsqueda.</p>";
}
?>
