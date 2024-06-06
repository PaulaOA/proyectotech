<?php
require "archivos/conexion.php";

if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $id_usuario = $_SESSION["id_usuario"];
}

$sqlVideo = "SELECT * FROM videos WHERE id_usuario = $id_usuario ORDER BY fecha DESC";
    $queryVideo = mysqli_query($conn, $sqlVideo);

    if (!$queryVideo) {
      die("Error al obtener los videos: " . mysqli_error($conn));
    }
$sqlDocumentos = "SELECT * FROM documentos WHERE id_usuario = $id_usuario";
$queryDocumentos = mysqli_query($conn, $sqlDocumentos);

$sql_equiposParticipante = "SELECT e.nombre_equipo, e.id_equipo
                              FROM equipos e 
                              JOIN solicitudes_equipo se ON se.id_equipo = e.id_equipo
                              JOIN participantes p ON p.id_participante = se.id_participante
                              JOIN registro r ON r.id_usuario = p.id_usuario
                              WHERE se.estado = 'aceptada' AND p.id_usuario = $id_usuario";
$equiposParticipante = mysqli_query($conn, $sql_equiposParticipante);
$equiposArray = [];
if ($equiposParticipante->num_rows > 0) {
    while ($equipo = $equiposParticipante->fetch_assoc()) {
        $equiposArray[] = $equipo;
    }
} 