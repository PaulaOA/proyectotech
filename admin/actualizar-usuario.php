<?php
if (empty($_POST['id_usuario']) || 
    empty($_POST['nombre']) || 
    empty($_POST['apellidos']) || 
    empty($_POST['fecha']) || 
    empty($_POST['email']) || 
    empty($_POST['contraseña']) || 
    empty($_POST['cargo'])) {
    echo "rellenaCampos"; // COMPROBAR QUE ESTÁN COMPLETOS TODOS LOS CAMPOS
} else {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha = $_POST['fecha'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $cargo = $_POST['cargo'];

    include "../archivos/conexion.php";

    // ACTUALIZAR DATOS DE USUARIO

    $sql = "UPDATE registro SET nombre='$nombre', apellidos='$apellidos', fecha='$fecha', cargo='$cargo' WHERE id_usuario='$id_usuario'";

    $messages = ""; // VARIABLE PARA DEVOLVER COMO RESPUESTA DE ÉXITO O ERROR

    if ($conn->query($sql) === TRUE) {
        $messages .= "usuarioEditado"; // SE HAN ACTUALIZADO LOS DATOS DEL USUARIO EN LA TABLA REGISTRO

// SI EL NUEVO CARGO ES PARTICIPANTE, SE COMPRUEBA SI EXISTE EN TABLA MENTORES Y SE ELIMINA EL REGISTRO

        if ($cargo === 'Participante') { 
            $check_sql = "SELECT * FROM mentores WHERE id_usuario='$id_usuario'";
            $result = $conn->query($check_sql);

            if ($result->num_rows > 0) {
                $delete_sql = "DELETE FROM mentores WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }

            // MISMA COMPROBACIÓN PARA TABLA JUECES
            $check_sql_juez = "SELECT * FROM jueces WHERE id_usuario='$id_usuario'";
            $result_juez = $conn->query($check_sql);

            if ($result_juez->num_rows > 0) {
                $delete_sql = "DELETE FROM jueces WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }

            // SE COMPRUEBA QUE NO EXISTA EL REGISTRO EN TABLA PARTICIPANTES Y SE PROCEDE A REGISTRAR
            $check_sql_participante = "SELECT * FROM participantes WHERE id_usuario='$id_usuario'";
            $result_participante = $conn->query($check_sql_participante);

            if ($result_participante->num_rows == 0) {
                $insertarParticipante = "INSERT INTO participantes (id_usuario) VALUES ('$id_usuario')";
                $conn->query($insertarParticipante);
            }
        }

// SI EL NUEVO CARGO ES MENTOR, SE COMPRUEBA SI EXISTE EN TABLA PARTICIPANTES Y SE ELIMINA EL REGISTRO        

        if ($cargo === 'Mentor') {
            $check_sql_participante = "SELECT * FROM participantes WHERE id_usuario='$id_usuario'";
            $result_participante = $conn->query($check_sql_participante);

            if ($result_participante->num_rows > 0) {
                $delete_sql = "DELETE FROM participantes WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }

            // MISMA COMPROBACIÓN PARA TABLA JUECES
            $check_sql_juez = "SELECT * FROM jueces WHERE id_usuario='$id_usuario'";
            $result_juez = $conn->query($check_sql);

            if ($result_juez->num_rows > 0) {
                $delete_sql = "DELETE FROM jueces WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }

            // SE COMPRUEBA QUE NO EXISTA EL REGISTRO EN TABLA MENTORES Y SE PROCEDE A REGISTRAR
            $check_sql = "SELECT * FROM mentores WHERE id_usuario='$id_usuario'";
            $result = $conn->query($check_sql);

            if ($result->num_rows == 0) {
                $insert_sql = "INSERT INTO mentores (id_usuario) VALUES ('$id_usuario')";
                $conn->query($insert_sql);
            }
        }

// SI EL NUEVO CARGO ES JUEZ, SE INSERTA EL REGISTRO EN TABLA JUECES Y SE COMPRUEBA SI EXISTE EN TABLA PARTICIPANTES O TABLA MENTORES

        if ($cargo === 'Juez') {
            $check_sql_juez = "SELECT * FROM jueces WHERE id_usuario='$id_usuario'";
            $result_juez = $conn->query($check_sql_juez);

            if ($result_juez->num_rows == 0) {
                $insert_sql = "INSERT INTO jueces (id_usuario) VALUES ('$id_usuario')";
                $conn->query($insert_sql);
            }

            // BORRAR DE TABLA MENTORES SI EXISTE
            $check_sql_mentor = "SELECT * FROM mentores WHERE id_usuario='$id_usuario'";
            $result_mentor = $conn->query($check_sql_mentor);

            if ($result_mentor->num_rows > 0) {
                $delete_sql = "DELETE FROM mentores WHERE id_usuario='$id_usuario'";
                $conn->query($delete_sql);
            }

            // BORRAR DE TABLA PARTICIPANTES SI EXISTE
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
} ?>