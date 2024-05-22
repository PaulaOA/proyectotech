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

    if ($conn->query($sql) === TRUE) {
        echo "usuarioEditado";

        if ($cargo === 'Participante') {
            $check_sql = "SELECT * FROM mentores WHERE id_usuario='$id_usuario'";
            $result = $conn->query($check_sql);

            if ($result->num_rows > 0) {
                $delete_sql = "DELETE FROM mentores WHERE id_usuario='$id_usuario'";
                if ($conn->query($delete_sql) === TRUE) {
                    echo "mentorEliminado";
                } else {
                    echo "no se pudo eliminar el registro de mentor: " . $conn->error;
                }
            }

            $check_sql_participante = "SELECT * FROM participantes WHERE id_usuario='$id_usuario'";
            $result_participante = $conn->query($check_sql_participante);

            if ($result_participante->num_rows > 0) {
                echo "yaExiste";
            } else {
                $insertarParticipante = "INSERT INTO participantes (id_usuario) VALUES ('$id_usuario')";
                if ($conn->query($insertarParticipante) === TRUE) {
                    echo "participanteAgregado";
                } else {
                    echo "no se pudo agregar el registro de participante: " . $conn->error;
                }
            }
        }

        if ($cargo === 'Mentor') {
            $check_sql = "SELECT * FROM mentores WHERE id_usuario='$id_usuario'";
            $result = $conn->query($check_sql);

            if ($result->num_rows == 0) {
                $insert_sql = "INSERT INTO mentores (id_usuario) VALUES ('$id_usuario')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "mentorAgregado";
                } else {
                    echo "no se pudo agregar el registro de mentor: " . $conn->error;
                }
            } else {
                echo "yaExiste";
            }

            $check_sql_participante = "SELECT * FROM participantes WHERE id_usuario='$id_usuario'";
            $result_participante = $conn->query($check_sql_participante);

            if ($result_participante->num_rows > 0) {
                $delete_sql = "DELETE FROM participantes WHERE id_usuario='$id_usuario'";
                if ($conn->query($delete_sql) === TRUE) {
                    echo "participanteEliminado";
                } else {
                    echo "no se pudo eliminar el registro de participante: " . $conn->error;
                }
            }
        }
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }

    $conn->close();
}
?>
