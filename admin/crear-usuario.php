<?php

if (empty($_POST['nombre']) || 
    empty($_POST['apellidos']) || 
    empty($_POST['fecha']) || 
    empty($_POST['email']) || 
    empty($_POST['contraseña']) || 
    empty($_POST['cargo'])) {
    echo "rellenaCampos";
    } else {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $fecha = $_POST['fecha'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $cargo = $_POST['cargo'];

 include "../archivos/conexion.php";

    $sql = "INSERT INTO registro (nombre, apellidos, fecha, email, contraseña, cargo, admin) VALUES ('".$nombre."', '".$apellidos."', '".$fecha."', '".$email."', '".$contraseña."', '".$cargo."', 0)";

         if ($conn->query($sql) === TRUE) {
            echo "usuarioCreado";
        } else {
            echo "Error al crear el usuario: " . $conn->error;
        }

        $conn->close();
}