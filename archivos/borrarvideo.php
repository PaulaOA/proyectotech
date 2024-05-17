<?php
require_once('conexion.php');
$fecha    	 = $_REQUEST['fecha']; 

$sqlDeleteProd    = ("DELETE FROM videos WHERE  fecha='$fecha'");
$resultProd 	  = mysqli_query($conn, $sqlDeleteProd);


header("Location:../miperfil.php");
exit();

?>