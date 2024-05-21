<?php
session_start();

if (empty($_POST['nombreEquipo']) || empty($_POST['id_mentor'])) {
    echo "rellenaCampos";
} else {
    $nombre_equipo = $_POST['nombreEquipo'];
    $id_mentor = $_POST['id_mentor'];

    if(isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
        require_once "conexion.php";

        $nombre_equipo = mysqli_real_escape_string($conn, $nombre_equipo);
        $id_usuario = mysqli_real_escape_string($conn, $id_usuario);
        $id_mentor = mysqli_real_escape_string($conn, $id_mentor);

        $sql_participante = "SELECT id_participante FROM participantes WHERE id_usuario = $id_usuario";
        $resultado_participante = $conn->query($sql_participante);

        if ($resultado_participante && $resultado_participante->num_rows > 0) {
            $id_participante = $resultado_participante->fetch_assoc()['id_participante'];

            $sql = "INSERT INTO equipos (nombre_equipo, id_creador, id_mentor) VALUES ('$nombre_equipo', '$id_usuario', '$id_mentor')";

            if ($conn->query($sql) === TRUE) {
                $id_equipo = $conn->insert_id;
                
                $sql_insertParticipante = "INSERT INTO solicitudes_equipo (id_participante, id_equipo) VALUES ($id_participante, $id_equipo)";
                
                if ($conn->query($sql_insertParticipante) === TRUE) {
                    echo "solicitudEnviada";
                } else {
                    echo "Error al enviar la solicitud: " . $conn->error;
                }
            } else {
                echo "Error al crear el equipo: " . $conn->error;
            }
        } else {
            echo "No se pudo obtener el id_participante";
        }

        $conn->close();
    } else {
        echo "errorSesion";
    }   
}


