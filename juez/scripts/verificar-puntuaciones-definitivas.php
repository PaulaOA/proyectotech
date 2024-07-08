<?php

require_once("../../archivos/conexion.php");

// Comprobar parámetros necesarios
if (isset($_POST['id_equipo']) && isset($_POST['division']) && isset($_POST['id_juez'])) {
    $id_equipo = $_POST['id_equipo'];
    $division = $_POST['division'];
    $id_juez = $_POST['id_juez'];
    
    // Consultar puntuaciones definitivas si el equipo es Junior
    if($division == "Junior") {
    $sql = "SELECT * FROM puntuaciones_definitivas_junior WHERE id_equipo = $id_equipo AND id_juez = $id_juez";

      // Consultar puntuaciones definitivas si el equipo es Senior
    } else if ($division == "Senior") {
     $sql = "SELECT * FROM puntuaciones_definitivas_senior WHERE id_equipo = $id_equipo AND id_juez = $id_juez";
    }

    $result = $conn->query($sql);
    
    // Verificar si existe algún registro de puntuaciones definitivas
    if ($result && $result->num_rows > 0) {
        echo "conRegistros";
    } else {
        echo "sinRegistros";
    }
} else {
    echo "errorVariables";
}
?>
