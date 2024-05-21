<?php
require_once("conexion.php");

if (isset($_POST['busquedaNombre']) && !empty($_POST['busquedaNombre'])) {
    $nombreEquipo = mysqli_real_escape_string($conn, $_POST['busquedaNombre']);

    $sql_equipos = "SELECT *, registro.nombre AS nombre_creador
                    FROM equipos
                    INNER JOIN registro ON equipos.id_creador = registro.id_usuario
                    WHERE estado = 'aceptada' AND LOWER(nombre_equipo) LIKE LOWER('%$nombreEquipo%')";

    $equiposEncontrados = $conn->query($sql_equipos);

    if ($equiposEncontrados && $equiposEncontrados->num_rows > 0) {
        echo "<h3>Resultados de la búsqueda '$nombreEquipo'</h3>";

        if (isset($_POST['idParticipante'])) {
            $id_participante = $_POST['idParticipante'];

            while ($equipo = $equiposEncontrados->fetch_assoc()) {
                echo "<div class='col-md-4'>
                       <div class='card my-3'>
                        <div class='card-body'>
                         <h5 class='card-title text-center mb-4'>{$equipo['nombre_equipo']}</h5>
                          <p>Creador del equipo: {$equipo['nombre_creador']}</p>
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
    echo "<p>Por favor, ingresa un nombre de equipo para realizar la búsqueda.</p>";
}
?>