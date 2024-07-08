<?php
require_once('conexion.php');

// Recibir parámetro necesario
if (isset ($_GET['id'])) {
 $id_video = $_GET['id'];

// Borrar registro
$sqlDelete= "DELETE FROM videos WHERE id='$id_video'";
$result	= mysqli_query($conn, $sqlDelete);
 
 if ($result == TRUE) {
 	header("Location:../miperfil.php");
 }

 $conn->close();

} else {
	echo "errorParámetro";
}
?>