<?php
// Incluir el archivo de conexión a la base de datos
require_once("../../archivos/conexion.php");

if (isset($_POST['id_equipo']) && isset($_POST['division']) && isset($_POST['id_juez'])) {
    $id_equipo = $_POST['id_equipo'];
    $division = $_POST['division'];
    $id_juez = $_POST['id_juez'];

    if($division == "Junior") {
    $sql = "SELECT * FROM puntuaciones_definitivas_junior WHERE id_equipo = $id_equipo AND id_juez = $id_juez";
    } else if($division == "Senior") {
     $sql = "SELECT * FROM puntuaciones_definitivas_senior WHERE id_equipo = $id_equipo AND id_juez = $id_juez";
    }

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "conRegistros";
    } else {
        echo "sinRegistros";
    }
} else {
    echo "errorVariables";
}
?>
