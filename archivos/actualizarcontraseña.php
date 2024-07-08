<?php

include('conexion.php');

// Comprobar variables necesarias
if(isset($_POST['email']) && isset($_POST['contraseña'])) {

    // Limpiar y validar los datos
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contraseña = mysqli_real_escape_string($conn, $_POST['contraseña']);

    // Actualizar contraseña en base de datos
    $update_contraseña_query = "UPDATE registro SET contraseña='$contraseña' WHERE email='$email'";
    $result = mysqli_query($conn, $update_contraseña_query);

    // Si la actualización es correcta, redirigir
    if($result) {
       header("Location:../index.php");
    } else {
        echo "Error al actualizar la contraseña: " . mysqli_error($conn);
    }
} else {
    echo "No se han recibido los parámetros necesarios para actualizar la contraseña.";
}
?>