<?php 
$sql = "SELECT * FROM equipos";
$equipos = $conn->query($sql);

// Arreglo para almacenar los equipos con sus respectivos creadores y mentores
$equipos_data = [];

while ($equipo = $equipos->fetch_assoc()) {
    // Consulta para obtener el nombre del mentor
    $consulta_mentor = "SELECT registro.nombre 
                        FROM registro 
                        INNER JOIN mentores 
                        ON registro.id_usuario = mentores.id_usuario 
                        WHERE mentores.id_mentor = " . $equipo['id_mentor'];
    $resultado_mentor = $conn->query($consulta_mentor);
    $nombre_mentor = $resultado_mentor->fetch_assoc()['nombre'];

    // Consulta para obtener el nombre del creador
    $consulta_creador = "SELECT registro.nombre 
                         FROM registro 
                         INNER JOIN equipos 
                         ON registro.id_usuario = equipos.id_creador 
                         WHERE equipos.id_creador = " . $equipo['id_creador'];
    $resultado_creador = $conn->query($consulta_creador);
    $nombre_creador = $resultado_creador->fetch_assoc()['nombre'];

    // Agregar la información al arreglo
    $equipos_data[] = [
        'id_equipo' => $equipo['id_equipo'],
        'nombre_equipo' => $equipo['nombre_equipo'],
        'id_creador' => $equipo['id_creador'],
        'nombre_creador' => $nombre_creador,
        'id_mentor' => $equipo['id_mentor'],
        'nombre_mentor' => $nombre_mentor,
        'division' => $equipo['division'],
        'estado' => $equipo['estado']
    ];
}