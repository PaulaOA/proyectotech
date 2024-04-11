<?php
session_start();
if (empty($_SESSION["nombre"])) {
    header("location: ../inicio.php");   
}
require_once('conexion.php');
$email = $_POST('email');
$query = "SELECT * FROM registro WHERE email='$email' AND STATUS = 1";
$result = $conn->query($query);

if($result->num_rows >0){

}else {
    header ("Location: ../index.php");
}


?>