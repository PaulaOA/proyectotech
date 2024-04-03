<?php
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha = $_POST['fecha'];
    $email = $_POST['email'];
    $cargo = $_POST['cargo'];

    include "conexion.php";

    $insertar = "INSERT INTO registro (nombre, apellidos, fecha, email, cargo) VALUES ('$nombre', '$apellidos', '$fecha', '$email', '$cargo')";

    if ($conn -> query($insertar) == true) {
        header('location: ../registro.php');
    }else{
        header('location: ../index.php');
    }
    
    $conn -> close();

?>