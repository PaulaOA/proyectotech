<?php

if (empty($_POST['nombre']) ||  
    empty($_POST['mentor'])) {
    echo "rellenaCampos";
    } else {
        $nombre_equipo = $_POST['nombre'];
        $mentor_equipo = $_POST['mentor'];

 include "../archivos/conexion.php";

    $sql = "INSERT INTO equipos (nombre_equipo, id_usuario, creador_equipo, mentor_equipo) VALUES ('".$nombre_equipo."', 1, 'Admin', '".$mentor_equipo."')";

         if ($conn->query($sql) === TRUE) {
            echo "equipoCreado";
        } else {
            echo "Error al crear el equipo: " . $conn->error;
        }

        $conn->close();
}