<?php

include "../../archivos/conexion.php";

if (isset($_POST['id_equipo']) && isset($_POST['division']) && isset($_POST['idItem']) && isset($_POST['puntuacion']) && isset($_POST['id_juez'])) {
    $id_equipo = $_POST['id_equipo'];
    $division = $_POST['division'];
    $id_item = $_POST['idItem'];
    $puntuacion = $_POST['puntuacion'];
    $id_juez = $_POST['id_juez'];

    if ($division == "Junior") {
        $sql_check_existence = "SELECT * FROM puntuaciones_temporales_junior WHERE id_equipo = '$id_equipo' AND id_item = '$id_item' AND id_juez = '$id_juez'";
        $result_check_existence = $conn->query($sql_check_existence);

        if ($result_check_existence->num_rows > 0) {
            $sql_update = "UPDATE puntuaciones_temporales_junior SET puntuacion = '$puntuacion' WHERE id_equipo = '$id_equipo' AND id_item = '$id_item' AND id_juez = '$id_juez'";
            if ($conn->query($sql_update) === TRUE) {
                echo "puntuacionActualizada";
            } else {
                echo "errorActualizar: " . $conn->error;
            }
        } else {
            $sql_insert = "INSERT INTO puntuaciones_temporales_junior (id_item, puntuacion, id_equipo, id_juez) VALUES ('$id_item', '$puntuacion', '$id_equipo', '$id_juez')";
            if ($conn->query($sql_insert) === TRUE) {
                echo "puntuacionGuardada";
                $sql_estado = "UPDATE jueces_equipos SET estado_evaluacion = 'guardada' WHERE id_equipo = $id_equipo AND id_juez = $id_juez";
                $conn->query($sql_estado);
            } else {
                echo "errorGuardar: " . $conn->error;
            }
        }
    } else if ($division == "Senior") {
        $sql_check_existence = "SELECT * FROM puntuaciones_temporales_senior WHERE id_equipo = '$id_equipo' AND id_item = '$id_item' AND id_juez = '$id_juez'";
        $result_check_existence = $conn->query($sql_check_existence);

        if ($result_check_existence->num_rows > 0) {
            $sql_update = "UPDATE puntuaciones_temporales_senior SET puntuacion = '$puntuacion' WHERE id_equipo = '$id_equipo' AND id_item = '$id_item' AND id_juez = '$id_juez'";
            if ($conn->query($sql_update) === TRUE) {
                echo "puntuacionActualizada";
            } else {
                echo "errorActualizar: " . $conn->error;
            }
        } else {
            $sql_insert = "INSERT INTO puntuaciones_temporales_senior (id_item, puntuacion, id_equipo, id_juez) VALUES ('$id_item', '$puntuacion', '$id_equipo', '$id_juez')";
            if ($conn->query($sql_insert) === TRUE) {
                echo "puntuacionGuardada";
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
