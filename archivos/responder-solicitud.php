<?php 
include "conexion.php";

if (isset($_POST['accion']) && isset($_POST['id'])) {
   $accion = $_POST['accion'];
   $id_equipo = $_POST['id'];

   $sql_obtenerParticipante = "SELECT p.id_participante
                               FROM participantes AS p
                               INNER JOIN equipos AS e ON p.id_usuario = e.id_creador
                               WHERE e.id_equipo = $id_equipo";

   $resultado_participante = $conn->query($sql_obtenerParticipante);

   if ($resultado_participante && $resultado_participante->num_rows > 0) {
      $fila_participante = $resultado_participante->fetch_assoc();
      $id_participante = $fila_participante['id_participante'];

      if ($accion == "aceptar") {
         $sql = "UPDATE equipos SET estado = 'aceptada' WHERE id_equipo = $id_equipo";
         $sql_participante = "UPDATE solicitudes_equipo SET estado = 'aceptada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";
      } else if ($accion == "rechazar") {
         $sql = "UPDATE equipos SET estado = 'rechazada' WHERE id_equipo = $id_equipo";
         $sql_participante = "UPDATE solicitudes_equipo SET estado = 'rechazada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";
      }
      
      $resultado = $conn->query($sql);
      $resultado_participante = $conn->query($sql_participante);

      if ($resultado === TRUE && $resultado_participante === TRUE) {
         echo "correcto";
      } else {
         echo "error";
      }
   } else {
      echo "No se pudo encontrar el participante asociado al equipo.";
   }

   $conn->close();
} else {
   echo "errorPost";
}
