<?php

require_once("archivos/conexion.php");

if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];
}

$solicitudesParticipantes = null;

// Verificar que el usuario es Mentor y el modal no ha sido mostrado
if ($_SESSION["cargo"] == "Mentor" && !isset($_SESSION['modal_mostrado'])) {
  // Consultar si existen equipos en estado pendiente para este mentor
  $consultaEquipos = "SELECT equipos.*
        FROM equipos
        INNER JOIN mentores ON equipos.id_mentor = mentores.id_mentor
        INNER JOIN registro ON mentores.id_usuario = registro.id_usuario
        WHERE equipos.estado = 'pendiente' 
        AND mentores.id_usuario = " .$id_usuario;

$solicitudes = $conn->query($consultaEquipos);
$solicitudesParticipantes = null;

   // Si el usuario es participante
} else if (!isset($_SESSION['modal_mostrado']) && $_SESSION["cargo"] == "Participante") {
    // Consultar si existen solicitudes de unión de otros participantes para equipos creados por el usuario
    $consultaParticipantes = "SELECT COUNT(se.id_solicitud) AS solicitudes_pendientes
                              FROM equipos e
                              JOIN solicitudes_equipo se ON e.id_equipo = se.id_equipo
                              JOIN participantes p ON se.id_participante = p.id_participante
                              WHERE e.id_creador = $id_usuario
                                AND se.estado = 'pendiente'
                                AND p.id_usuario != e.id_creador";
    $solicitudesParticipantes = $conn->query($consultaParticipantes);
}

// Obtener vídeos compartidos para un equipo al que pertenece el usuario
 $sqlVideo   = "SELECT v.*, e.nombre_equipo, r.nombre AS nombre_usuario
                      FROM videos v
                      JOIN videos_compartidos vc ON vc.id_video = v.id
                      JOIN equipos e ON e.id_equipo = vc.id_equipo
                      JOIN solicitudes_equipo se ON se.id_equipo = e.id_equipo
                      JOIN participantes p ON p.id_participante = se.id_participante
                      JOIN registro r ON r.id_usuario = vc.id_usuario
                      WHERE p.id_usuario = $id_usuario AND se.estado = 'aceptada' ORDER BY v.fecha DESC";
  $queryVideo = mysqli_query($conn, $sqlVideo);

// Obtener documentos compartidos para un equipo al que pertenece el usuario
  $sqlDocumentos = "SELECT d.*, e.nombre_equipo, r.nombre AS nombre_usuario
                      FROM documentos d
                      JOIN documentos_compartidos dc ON dc.id_documento = d.id
                      JOIN equipos e ON e.id_equipo = dc.id_equipo
                      JOIN solicitudes_equipo se ON se.id_equipo = e.id_equipo
                      JOIN participantes p ON p.id_participante = se.id_participante
                      JOIN registro r ON r.id_usuario = dc.id_usuario
                      WHERE p.id_usuario = $id_usuario AND se.estado = 'aceptada'";
$queryDocumentos = $conn->query($sqlDocumentos);