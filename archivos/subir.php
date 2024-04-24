<?php
include "conexion.php";

$file_name = $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];
$desc = $_POST['desc'];
$ruta = "../files".$file_name;

move_uploaded_file($file_tmp, $ruta);

$sql = "INSERT INTO documentos (nombre, descripcion) VALUES ('$file_name', '$desc')";

$sql_query = mysqli_query($conn,$sql);

if ($conn -> query($sql) == true) {
    header('location: ../miperfil.php');
}else{
    header('location: ../inicio.php');
}

$conn -> close();

?>