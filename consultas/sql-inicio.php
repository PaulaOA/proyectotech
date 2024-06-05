<?php
require_once("archivos/conexion.php");
if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];
}
if (!isset($_SESSION['modal_mostrado']) && $_SESSION["cargo"] == "Mentor") {
  $consultaEquipos = "SELECT equipos.*
        FROM equipos
        INNER JOIN mentores ON equipos.id_mentor = mentores.id_mentor
        INNER JOIN registro ON mentores.id_usuario = registro.id_usuario
        WHERE equipos.estado = 'pendiente' 
        AND mentores.id_usuario = " .$id_usuario;
$solicitudes = $conn->query($consultaEquipos);
$solicitudesParticipantes = null;

} else if (!isset($_SESSION['modal_mostrado']) && $_SESSION["cargo"] == "Participante") {
$consultaParticipantes = "SELECT COUNT(se.id_solicitud) AS solicitudes_pendientes
                          FROM equipos e
                          JOIN solicitudes_equipo se ON e.id_equipo = se.id_equipo
                          JOIN participantes p ON se.id_participante = p.id_participante
                          WHERE e.id_creador = $id_usuario
                            AND se.estado = 'pendiente'
                            AND p.id_usuario != e.id_creador";
$solicitudesParticipantes = $conn->query($consultaParticipantes);
}

 $sqlVideo   = "SELECT nombrevideo, urlvideo, fecha FROM videos WHERE id_usuario = $id_usuario ORDER BY fecha DESC LIMIT 1";
  $queryVideo = mysqli_query($conn, $sqlVideo);
  $totalVideo = mysqli_num_rows($queryVideo);
  $dataVideo  = mysqli_fetch_array($queryVideo);