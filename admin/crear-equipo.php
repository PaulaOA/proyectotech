<?php

if (empty($_POST['nombre']) ||  
    empty($_POST['id_mentor'])) {
    echo "rellenaCampos";
    } else {
        $nombre_equipo = $_POST['nombre'];
        $id_mentor = $_POST['id_mentor'];

 include "../archivos/conexion.php";

    $sql = "INSERT INTO equipos (nombre_equipo, id_creador, id_mentor, estado) VALUES ('".$nombre_equipo."', 1, $id_mentor, 'aceptada')";

         if ($conn->query($sql) === TRUE) {
            echo "equipoCreado";
        } else {
            echo "Error al crear el equipo: " . $conn->error;
        }

        $conn->close();
}