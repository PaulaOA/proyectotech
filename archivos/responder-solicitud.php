<?php 
include "conexion.php";

if (isset($_POST['accion']) && isset($_POST['id'])){
   $accion = $_POST['accion'];
   $id_equipo = $_POST['id'];

   if($accion == "aceptar") {
   	  $sql = "UPDATE equipos SET estado = 'aceptada' WHERE id_equipo = $id_equipo";

   } else if ($accion == "rechazar") {
   	  $sql = "UPDATE equipos SET estado = 'rechazada' WHERE id_equipo = $id_equipo";
   }

    $resultado = $conn->query($sql);
   	  if ($resultado == "true") {
   	  	echo "correcto";
   	  } else {
   	  	echo "error";
   	  }

   $conn->close();

} else {
	echo "errorPost";
}