<?php

include "../../archivos/conexion.php";

// Comprobar parámetros necesarios
if (isset($_POST['id_equipo']) && isset($_POST['division']) && isset($_POST['idItem']) && isset($_POST['puntuacion']) && isset($_POST['id_juez'])) {
    $id_equipo = $_POST['id_equipo'];
    $division = $_POST['division'];
    $id_item = $_POST['idItem'];
    $puntuacion = $_POST['puntuacion'];
    $id_juez = $_POST['id_juez'];
    
    // Procesar las puntuaciones para la división Junior
    if ($division == "Junior") {
        // Comprobar si ya existen puntuaciones temporales para equipo y juez especificados
        $sql_check_existence = "SELECT * FROM puntuaciones_temporales_junior WHERE id_equipo = '$id_equipo' AND id_item = '$id_item' AND id_juez = '$id_juez'";
        $result_check_existence = $conn->query($sql_check_existence);

        if ($result_check_existence->num_rows > 0) {
            // Actualizar la puntuación existente
            $sql_update = "UPDATE puntuaciones_temporales_junior SET puntuacion = '$puntuacion' WHERE id_equipo = '$id_equipo' AND id_item = '$id_item' AND id_juez = '$id_juez'";
            if ($conn->query($sql_update) === TRUE) {
                // Informar que se ha actualizado la puntuación
                echo "puntuacionActualizada";
            } else {
                echo "errorActualizar: " . $conn->error;
            }
        } else {
            // Insertar las puntuaciones por primera vez
            $sql_insert = "INSERT INTO puntuaciones_temporales_junior (id_item, puntuacion, id_equipo, id_juez) VALUES ('$id_item', '$puntuacion', '$id_equipo', '$id_juez')";
            if ($conn->query($sql_insert) === TRUE) {
                // Informar que se ha guardado la puntuación correctamente
                echo "puntuacionGuardada";
                // Actualizar el estado de evaluación del juez para este equipo a 'guardada'               
                $sql_estado = "UPDATE jueces_equipos SET estado_evaluacion = 'guardada' WHERE id_equipo = $id_equipo AND id_juez = $id_juez";
                $conn->query($sql_estado);
            } else {
                echo "errorGuardar: " . $conn->error;
            }
        }
    // Procesar las puntuaciones para la división Senior
    } else if ($division == "Senior") {
        // Comprobar si ya existen puntuaciones temporales para equipo y juez especificados
        $sql_check_existence = "SELECT * FROM puntuaciones_temporales_senior WHERE id_equipo = '$id_equipo' AND id_item = '$id_item' AND id_juez = '$id_juez'";
        $result_check_existence = $conn->query($sql_check_existence);

        if ($result_check_existence->num_rows > 0) {
            // Actualizar la puntuación existente
            $sql_update = "UPDATE puntuaciones_temporales_senior SET puntuacion = '$puntuacion' WHERE id_equipo = '$id_equipo' AND id_item = '$id_item' AND id_juez = '$id_juez'";
            if ($conn->query($sql_update) === TRUE) {
                // Informar que se ha actualizado la puntuación
                echo "puntuacionActualizada";
            } else {
                echo "errorActualizar: " . $conn->error;
            }
        } else {
            // Insertar puntuaciones por primera vez
            $sql_insert = "INSERT INTO puntuaciones_temporales_senior (id_item, puntuacion, id_equipo, id_juez) VALUES ('$id_item', '$puntuacion', '$id_equipo', '$id_juez')";
            if ($conn->query($sql_insert) === TRUE) {
                // Informar que se han guardado correctamente las puntuaciones
                echo "puntuacionGuardada";
                // Actualizar el estado de evaluación del juez para este equipo a 'guardada'                
                $sql_estado = "UPDATE jueces_equipos SET estado_evaluacion = 'guardada' WHERE id_equipo = $id_equipo AND id_juez = $id_juez";
                $conn->query($sql_estado);
            } else {
                echo "errorGuardar: " . $conn->error;
            }
        }
    } 
} else {
    echo "errorVariables";
}
$conn->close();
?>
