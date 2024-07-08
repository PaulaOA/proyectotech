<?php 
include "conexion.php";

// Comprobar parámetros necesarios
if (isset($_POST['accion']) && isset($_POST['id']) && isset($_POST['idParticipante'])) {
   $accion = $_POST['accion'];
   $id_equipo = $_POST['id'];
   $id_participante = $_POST['idParticipante'];

   // Crear consulta de actualización según la acción escogida
   if ($accion == "aceptar") {
         $sql = "UPDATE solicitudes_equipo SET estado = 'aceptada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";
      } else if ($accion == "rechazar") {
         $sql = "UPDATE solicitudes_equipo SET estado = 'rechazada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";
      }
      
      // Actualizar
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