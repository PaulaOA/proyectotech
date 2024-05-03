<?php

if (!empty($_POST['id_equipo'])) {

   $id_equipo = $_POST['id_equipo'];

    include "conexion.php";

    $sql = "DELETE FROM equipos WHERE id_equipo=$id_equipo";

         if ($conn->query($sql) === TRUE) {
            echo "solicitudEliminada";
        } else {
            echo "Error al eliminar la solicitud: " . $conn->error;
        }

        $conn->close();
        
    } else {
        echo "error";
    }