<?php

if (isset($_POST['id_equipo']) && isset($_POST['division']) && isset($_POST['puntuaciones'])) {

    $id_equipo = $_POST['id_equipo'];
    $division = $_POST['division'];
    $puntuaciones = $_POST['puntuaciones'];

    include "../../archivos/conexion.php";

    if($division == "Junior") {
        $sql_check_existence = "SELECT * FROM puntuaciones_definitivas_junior WHERE id_equipo = '$id_equipo'";
        $result_check_existence = $conn->query($sql_check_existence);

        if ($result_check_existence->num_rows == 0) {

            foreach ($puntuaciones as $idItem => $puntuacion) {
                $sql_insert = "INSERT INTO puntuaciones_definitivas_junior (id_item, puntuacion, id_equipo) VALUES ('$idItem', '$puntuacion', '$id_equipo')";
                if ($conn->query($sql_insert) !== TRUE) {
                    echo "Error al guardar la puntuación para el ítem $idItem: " . $conn->error;
                    exit;
                }
            }

            // Insertar totales
            $totalGeneral = $_POST['totalGeneral'];
            $totalCategoria1 = $_POST['totalCategoria1'];
            $totalCategoria2 = $_POST['totalCategoria2'];
            $totalCategoria3 = $_POST['totalCategoria3'];
            $totalCategoria4 = $_POST['totalCategoria4'];
            $totalCategoria5 = $_POST['totalCategoria5'];

            $sql_insertTotales = "INSERT INTO puntuaciones_totales (id_equipo, total_general, total_categoria1, total_categoria2, total_categoria3, total_categoria4, total_categoria5) VALUES ('$id_equipo', '$totalGeneral', '$totalCategoria1', '$totalCategoria2', '$totalCategoria3', '$totalCategoria4', '$totalCategoria5')";

            if ($conn->query($sql_insertTotales) !== TRUE) {
                echo "Error al guardar los totales de puntuación: " . $conn->error;
                exit;
            }

            echo "puntuacionGuardada";
        } else {
            // Ya existen registros, devolver un mensaje indicando que las puntuaciones ya están guardadas
            echo "puntuacionesDefinitivas";
        }
    } else if ($division == "Senior") {
        $sql_check_existence = "SELECT * FROM puntuaciones_definitivas_senior WHERE id_equipo = '$id_equipo'";
        $result_check_existence = $conn->query($sql_check_existence);

        if ($result_check_existence->num_rows == 0) {

            foreach ($puntuaciones as $idItem => $puntuacion) {
                $sql_insert = "INSERT INTO puntuaciones_definitivas_senior (id_item, puntuacion, id_equipo) VALUES ('$idItem', '$puntuacion', '$id_equipo')";
                if ($conn->query($sql_insert) !== TRUE) {
                    echo "Error al guardar la puntuación para el ítem $idItem: " . $conn->error;
                    exit;
                }
            }

            // Insertar totales
            $totalGeneral = $_POST['totalGeneral'];
            $totalCategoria1 = $_POST['totalCategoria1'];
            $totalCategoria2 = $_POST['totalCategoria2'];
            $totalCategoria3 = $_POST['totalCategoria3'];
            $totalCategoria4 = $_POST['totalCategoria4'];
            $totalCategoria5 = $_POST['totalCategoria5'];

            $sql_insertTotales = "INSERT INTO puntuaciones_totales (id_equipo, total_general, total_categoria1, total_categoria2, total_categoria3, total_categoria4, total_categoria5) VALUES ('$id_equipo', '$totalGeneral', '$totalCategoria1', '$totalCategoria2', '$totalCategoria3', '$totalCategoria4', '$totalCategoria5')";

            if ($conn->query($sql_insertTotales) !== TRUE) {
                echo "Error al guardar los totales de puntuación: " . $conn->error;
                exit;
            }

            echo "puntuacionGuardada";
        } else {
            // Ya existen registros, devolver un mensaje indicando que las puntuaciones ya están guardadas
            echo "puntuacionesDefinitivas";
        }
    }

    $conn->close();
} else {
    echo "Error variables";
}
?>
