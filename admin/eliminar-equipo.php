<?php

if (!empty($_POST['id_equipo'])) {

        $id_equipo = $_POST['id_equipo'];

    include "../archivos/conexion.php";

    $sql = "DELETE FROM equipos WHERE id_equipo=" . $id_equipo;

         if ($conn->query($sql) === TRUE) {
            echo "equipoEliminado";
        } else {
            echo "Error al eliminar el equipo: " . $conn->error;
        }

        $conn->close();
        
    } else {
        echo "error";
    }