<?php

// Comprobar parámetro necesario
if (isset($_POST['id_solicitud'])) {

   $id_solicitud = $_POST['id_solicitud'];

    include "conexion.php";
    
    // Borrar la solicitud de unión a equipo
    $sql = "DELETE FROM solicitudes_equipo WHERE id_solicitud=$id_solicitud";

         if ($conn->query($sql) === TRUE) {
            echo "solicitudEliminada";
        } else {
            echo "Error al eliminar la solicitud: " . $conn->error;
        }

        $conn->close();
        
    } else {
        echo "error";
    }