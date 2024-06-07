<?php
if (empty($_POST['id_usuario']) || 
    empty($_POST['nombre']) || 
    empty($_POST['apellidos']) || 
    empty($_POST['fecha']) || 
    empty($_POST['email']) || 
    empty($_POST['contraseña']) || 
    empty($_POST['cargo'])) {
    echo "rellenaCampos";
} else {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha = $_POST['fecha'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $cargo = $_POST['cargo'];

    include "../archivos/conexion.php";

    $sql = "UPDATE registro SET nombre='$nombre', apellidos='$apellidos', fecha='$fecha', cargo='$cargo' WHERE id_usuario='$id_usuario'";

    $messages = ""; // Variable to accumulate messages

    if ($conn->query($sql) === TRUE) {
        $messages .= "usuarioEditado";

        if ($cargo === 'Participante') {
            $check_sql = "SELECT * FROM mentores WHERE id_usuario='$id_usuario'";
            $result = $conn->query($check_sql);

            if ($result->num_rows > 0) {
                $delete_sql = "DELETE FROM mentores WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }

            $check_sql_participante = "SELECT * FROM participantes WHERE id_usuario='$id_usuario'";
            $result_participante = $conn->query($check_sql_participante);

            if ($result_participante->num_rows == 0) {
                $insertarParticipante = "INSERT INTO participantes (id_usuario) VALUES ('$id_usuario')";
                $conn->query($insertarParticipante);
            }
        }

        if ($cargo === 'Mentor') {
            $check_sql = "SELECT * FROM mentores WHERE id_usuario='$id_usuario'";
            $result = $conn->query($check_sql);

            if ($result->num_rows == 0) {
                $insert_sql = "INSERT INTO mentores (id_usuario) VALUES ('$id_usuario')";
                $conn->query($insert_sql);
            }

            $check_sql_participante = "SELECT * FROM participantes WHERE id_usuario='$id_usuario'";
            $result_participante = $conn->query($check_sql_participante);

            if ($result_participante->num_rows > 0) {
                $delete_sql = "DELETE FROM participantes WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }
        }

        if ($cargo === 'Juez') {
            // Logic for 'Juez'
            $check_sql_juez = "SELECT * FROM jueces WHERE id_usuario='$id_usuario'";
            $result_juez = $conn->query($check_sql_juez);

            if ($result_juez->num_rows == 0) {
                $insert_sql = "INSERT INTO jueces (id_usuario) VALUES ('$id_usuario')";
                $conn->query($insert_sql);
            }

            // Remove from 'mentores' if exists
            $check_sql_mentor = "SELECT * FROM mentores WHERE id_usuario='$id_usuario'";
            $result_mentor = $conn->query($check_sql_mentor);

            if ($result_mentor->num_rows > 0) {
                $delete_sql = "DELETE FROM mentores WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }

            // Remove from 'participantes' if exists
            $check_sql_participante = "SELECT * FROM participantes WHERE id_usuario='$id_usuario'";
            $result_participante = $conn->query($check_sql_participante);

            if ($result_participante->num_rows > 0) {
                $delete_sql = "DELETE FROM participantes WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }
        }
    } else {
        $messages .= "Error al actualizar el usuario: " . $conn->error;
    }

    echo $messages;
    $conn->close();
}
?>
