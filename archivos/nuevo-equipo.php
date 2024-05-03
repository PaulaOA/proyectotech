<?php
session_start();
if (empty($_POST['nombreEquipo']) || empty($_POST['id_mentor'])) {
    echo "rellenaCampos";
    } else {
        $nombre_equipo = $_POST['nombreEquipo'];
        $id_mentor = $_POST['id_mentor'];

        if(isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
                include "conexion.php";

         $sql = "INSERT INTO equipos (nombre_equipo, id_creador, id_mentor) VALUES ('".$nombre_equipo."', '$id_usuario', '".$id_mentor."')";

         if ($conn->query($sql) === TRUE) {
            echo "solicitudEnviada";
        } else {
            echo "Error al crear el usuario: " . $conn->error;
        }

        $conn->close();
        } else {
            echo "errorSesion";
        }   
}

