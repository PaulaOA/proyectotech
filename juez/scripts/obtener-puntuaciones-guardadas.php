<?php
include "../../archivos/conexion.php";

// Comprobar parámetros necesarios
if (isset($_GET['id_equipo']) && isset($_GET['id_juez']) && isset($_GET['division'])) {

    $id_equipo = $_GET['id_equipo'];
    $id_juez = $_GET['id_juez'];
    $division = $_GET['division'];
    
    // Recuperar puntuaciones si la división del equipo es Junior
    if($division == "Junior") {
         $sql_puntuaciones_guardadas = "SELECT id_item, puntuacion FROM puntuaciones_temporales_junior WHERE id_equipo = $id_equipo AND id_juez = $id_juez";

      // Recuperar puntuaciones si la división del equipo es Junior 
    } else if ($division == "Senior") {
         $sql_puntuaciones_guardadas = "SELECT id_item, puntuacion FROM puntuaciones_temporales_senior WHERE id_equipo = $id_equipo AND id_juez = $id_juez";
    }
        $puntuaciones_equipo = $conn->query($sql_puntuaciones_guardadas);

        if ($puntuaciones_equipo->num_rows > 0) {

            while ($row = $puntuaciones_equipo->fetch_assoc()) {
                echo $row['id_item'] . ':' . $row['puntuacion'] . ';'; 
            }
        } else {
            // No existen registros con esos parámetros
            echo "noEncontradas";
        }
    
} else {
    echo "errorVariables";
}

$conn->close();



