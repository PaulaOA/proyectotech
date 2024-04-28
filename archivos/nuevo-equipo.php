<?php
session_start();
if (empty($_POST['nombreEquipo'])) {
    echo "rellenaCampos";
    } else {
        $nombre_equipo = $_POST['nombreEquipo'];

        if(isset($_SESSION['id_usuario']) && isset($_SESSION['nombre'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $nombre = $_SESSION['nombre'];
                include "conexion.php";

         $sql = "INSERT INTO equipos (nombre_equipo, id_usuario, creador_equipo, mentor_equipo) VALUES ('".$nombre_equipo."', '$id_usuario', '".$nombre."', '".$nombre."')";

         if ($conn->query($sql) === TRUE) {
            echo "equipoCreado";
        } else {
            echo "Error al crear el usuario: " . $conn->error;
        }

        $conn->close();
        } else {
            echo "errorSesion";
        }   
}

