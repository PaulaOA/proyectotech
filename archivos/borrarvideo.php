<?php
require_once('conexion.php');
$idVideo    	 = $_REQUEST['idVideo']; 

$sqlDeleteProd    = ("DELETE FROM videos WHERE  id='" .$idVideo. "'");
$resultProd 	  = mysqli_query($conn, $sqlDeleteProd);


header("Location:../miperfil.php");
exit();

?>