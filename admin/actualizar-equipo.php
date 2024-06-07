<?php

if (!isset($_POST['id_equipo']) || 
    empty($_POST['nombre'])) {
    echo "rellenaCampos";
    } else {
        $id_equipo = $_POST['id_equipo'];
        $nombre_equipo = $_POST['nombre'];
        $division = $_POST['division'];
        $estado = $_POST['estado'];

 include "../archivos/conexion.php";

    $sql = "UPDATE equipos SET nombre_equipo='".$nombre_equipo."', division = '".$division."', estado = '".$estado."' WHERE id_equipo='".$id_equipo."'";

         if ($conn->query($sql) === TRUE) {
            echo "equipoEditado";
        } else {
            echo "Error al actualizar el usuario: " . $conn->error;
        }

        $conn->close();
}