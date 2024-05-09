<?php
//Actualizacion de contraseña
/*include('conexion.php');
$id_usuario = $_REQUEST['id_usuario'];
$tokenuser = $_REQUEST['tokenuser'];
$contraseña = $_REQUEST['contraseña'];

$updatecontraseña = ("UPDATE registro SET contraseña='$contraseña' WHERE id_usuario='".$id_usuario."' AND tokenuser='".$tokenuser."' ");
$sql = mysqli_query($conn,$updatecontraseña); */

?>

<!--<meta http-equiv="refresh" content="0;url=index.php?email=1"/>-->

<?php
// Actualizacion de contraseña
include('conexion.php');

// Validar y limpiar los datos recibidos del formulario
$id_usuario = mysqli_real_escape_string($conn, $_REQUEST['id_usuario']);
$tokenuser = mysqli_real_escape_string($conn, $_REQUEST['tokenuser']);
$contraseña = mysqli_real_escape_string($conn, $_REQUEST['contraseña']);

// Verificar si el token proporcionado es válido para el usuario
$verificar_token = ("SELECT * FROM registro WHERE id_usuario='$id_usuario' AND tokenuser='$tokenuser'");
$resultado = mysqli_query($conn, $verificar_token);

if (mysqli_num_rows($resultado) == 1) {
    // Hash de la contraseña
    $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $updatecontraseña = ("UPDATE registro SET contraseña='$contraseña_hash' WHERE id_usuario='$id_usuario'");
    $sql = mysqli_query($conn, $updatecontraseña);

    if ($sql) {
        echo "Contraseña actualizada exitosamente.";
    } else {
        echo "Error al actualizar la contraseña: " . mysqli_error($conn);
    }
} else {
    echo "Token de restablecimiento de contraseña inválido.";
}

?>