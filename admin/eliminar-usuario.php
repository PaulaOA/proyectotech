<?php

if (!empty($_POST['id_usuario'])) {

        $id_usuario = $_POST['id_usuario'];

    include "../archivos/conexion.php";

    $sql = "DELETE FROM registro WHERE id_usuario=" . $id_usuario;

         if ($conn->query($sql) === TRUE) {
            echo "usuarioEliminado";
        } else {
            echo "Error al eliminar el usuario: " . $conn->error;
        }

        $conn->close();
        
    } else {
        echo "error";
    }
