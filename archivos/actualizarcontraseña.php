<?php
// Actualizacion de contraseña
include('conexion.php');

// Validar y limpiar los datos recibidos del formulario
$email = $_REQUEST ['email'];
$contraseña = $_REQUEST['contraseña'];

// Verificar si el token proporcionado es válido para el usuario
$verificar_email = ("SELECT * FROM registro WHERE email='$email' ");
$resultado = mysqli_query($conn, $verificar_email);

if($resultado){
    if (mysqli_num_rows($resultado) == 1) {

    // Actualizar la contraseña en la base de datos
    $updatecontraseña = ("UPDATE registro SET contraseña='$contraseña' WHERE email='$email' ");
    $sql = mysqli_query($conn, $updatecontraseña);

    if ($sql) {
        echo "Contraseña actualizada exitosamente.";
    } else {
        echo "Error al actualizar la contraseña: " . mysqli_error($conn);
    }
} else {
    echo "No se encontró ninguna cuenta asociada a este correo electrónico.";
}
}else {
    echo "Error en la consulta SQL: " . mysqli_error($conn);
}

?>