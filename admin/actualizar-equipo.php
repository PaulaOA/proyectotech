<?php

if (empty($_POST['id_equipo']) || 
    empty($_POST['nombre']) || 
    empty($_POST['creador']) || 
    empty($_POST['mentor'])) {
    echo "rellenaCampos";
    } else {
        $id_equipo = $_POST['id_equipo'];
        $nombre_equipo = $_POST['nombre'];
        $creador_equipo = $_POST['creador'];
        $mentor_equipo = $_POST['mentor'];

 include "../archivos/conexion.php";

    $sql = "UPDATE equipos SET nombre_equipo='".$nombre_equipo."', creador_equipo='".$creador_equipo."', mentor_equipo='".$mentor_equipo."' WHERE id_equipo='".$id_equipo."'";

         if ($conn->query($sql) === TRUE) {
            echo "equipoEditado";
        } else {
            echo "Error al actualizar el usuario: " . $conn->error;
        }

        $conn->close();
}