<?php
include('conexion.php');
session_start();

if (isset($_SESSION['email']) != "") {
    header("Location: ../inicio.php");
}

$email = $_REQUEST['email'];
$contraseña = $_REQUEST['contraseña'];

$sqlVerificar = ("SELECT * FROM registro WHERE email='".$email."' AND contraseña='".$contraseña."' ");
$sql = mysqli_query($conn,$sqlVerificar);

if ($row = mysqli_fetch_assoc($sql)) {
	 $_SESSION['nombre'] = $row['nombre'];
	 $_SESSION['email'] = $row['email'];
	 $_SESSION['id_usuario'] = $row['id_usuario'];
	
	echo '<meta http-equiv="refresh" content="0;url=../inicio.php">';
}else{
	echo '<meta http-equiv="refresh" content="0;url=../index.php?emaiIncorrecto=1">';
}
?>