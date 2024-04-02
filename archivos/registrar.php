<?php
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha = $_POST['fecha'];
    $email = $_POST['email'];

    include "conexion.php";

    $insertar = "INSERT INTO registro (nombre, apellidos, fecha, email) VALUES ('$nombre', '$apellidos', '$fecha', '$email')";

    if ($conn -> query($insertar) == true) {
        header('location: ../registro.php');
    }else{
        echo "La datos no se han registrado";/*header('location: ../index.php');*/
    }
    
    $conn -> close();

?>