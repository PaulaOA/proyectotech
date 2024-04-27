<?php

if (empty($_POST['id_usuario']) || 
    empty($_POST['nombre']) || 
    empty($_POST['apellidos']) || 
    empty($_POST['fecha']) || 
    empty($_POST['email']) || 
    empty($_POST['contraseña']) || 
    empty($_POST['cargo'])) {
    echo "rellenaCampos";
    } else {
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $fecha = $_POST['fecha'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $cargo = $_POST['cargo'];

 include "../archivos/conexion.php";

    $sql = "UPDATE registro SET nombre='".$nombre."', apellidos='".$apellidos."', fecha='".$fecha."', cargo='".$cargo."' WHERE id_usuario='".$id_usuario."'";

         if ($conn->query($sql) === TRUE) {
            echo "usuarioEditado";
        } else {
            echo "Error al actualizar el usuario: " . $conn->error;
        }

        $conn->close();
}