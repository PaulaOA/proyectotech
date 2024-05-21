<?php 
include "conexion.php";

if (isset($_POST['accion']) && isset($_POST['id']) && isset($_POST['idParticipante'])) {
   $accion = $_POST['accion'];
   $id_equipo = $_POST['id'];
   $id_participante = $_POST['idParticipante'];

   if ($accion == "aceptar") {
         $sql = "UPDATE solicitudes_equipo SET estado = 'aceptada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";
      } else if ($accion == "rechazar") {
         $sql = "UPDATE solicitudes_equipo SET estado = 'rechazada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";
      }

      $resultado = $conn->query($sql);

      if ($resultado === TRUE) {
         echo "correcto";
      } else {
         echo "error";
      }

   $conn->close();

} else {
   echo "errorVariables";
}