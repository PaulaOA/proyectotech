<?php
require_once("archivos/conexion.php");
if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];
}
$solicitudesParticipantes = null;
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

 $sqlVideo   = "SELECT v.*, e.nombre_equipo, r.nombre AS nombre_usuario
                      FROM videos v
                      JOIN videos_compartidos vc ON vc.id_video = v.id
                      JOIN equipos e ON e.id_equipo = vc.id_equipo
                      JOIN solicitudes_equipo se ON se.id_equipo = e.id_equipo
                      JOIN participantes p ON p.id_participante = se.id_participante
                      JOIN registro r ON r.id_usuario = vc.id_usuario
                      WHERE p.id_usuario = $id_usuario AND se.estado = 'aceptada' ORDER BY v.fecha DESC";
  $queryVideo = mysqli_query($conn, $sqlVideo);

  $sqlDocumentos = "SELECT d.*, e.nombre_equipo, r.nombre AS nombre_usuario
                      FROM documentos d
                      JOIN documentos_compartidos dc ON dc.id_documento = d.id
                      JOIN equipos e ON e.id_equipo = dc.id_equipo
                      JOIN solicitudes_equipo se ON se.id_equipo = e.id_equipo
                      JOIN participantes p ON p.id_participante = se.id_participante
                      JOIN registro r ON r.id_usuario = dc.id_usuario
                      WHERE p.id_usuario = $id_usuario AND se.estado = 'aceptada'";
$queryDocumentos = $conn->query($sqlDocumentos);