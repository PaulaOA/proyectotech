<?php
require_once('conexion.php');
$contraseña=$_POST['new_pass'];

$sql=$conn->query("SELECT * FROM registro WHERE email='$email' AND contraseña='$contraseña'");


?>