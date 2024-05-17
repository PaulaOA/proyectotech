<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Verificar si se han recibido los parámetros necesarios
if(isset($_POST['email']) && isset($_POST['contraseña'])) {

    // Limpiar y validar los datos recibidos del formulario
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contraseña = mysqli_real_escape_string($conn, $_POST['contraseña']);

    // Actualizar la contraseña en la base de datos
    $update_contraseña_query = "UPDATE registro SET contraseña='$contraseña' WHERE email='$email'";
    $result = mysqli_query($conn, $update_contraseña_query);

    // Verificar si la consulta se ejecutó correctamente
    if($result) {
       header("Location:../index.php");
    } else {
        echo "Error al actualizar la contraseña: " . mysqli_error($conn);
    }
} else {
    // Mostrar un mensaje de error si no se reciben los parámetros necesarios
    echo "No se han recibido los parámetros necesarios para actualizar la contraseña.";
}
?>