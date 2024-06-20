<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    include "conexion.php";

    $token = $conn->real_escape_string($token);

    $sql = "SELECT * FROM registro WHERE token='$token' AND verificado=0";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        $id_usuario = $usuario['id_usuario'];
        $cargo = $usuario['cargo'];

        $actualizar = "UPDATE registro SET verificado=1 WHERE id_usuario='$id_usuario'";
        if ($conn->query($actualizar) === TRUE) {
            switch ($cargo) {
                case "Mentor":
                    $insertarMentor = "INSERT INTO mentores (id_usuario) VALUES ('$id_usuario')";
                    $conn->query($insertarMentor);
                    break;
                case "Participante":
                    $insertarParticipante = "INSERT INTO participantes (id_usuario) VALUES ('$id_usuario')";
                    $conn->query($insertarParticipante);
                    break;
                case "Juez":
                    $insertarJuez = "INSERT INTO jueces (id_usuario) VALUES ('$id_usuario')";
                    $conn->query($insertarJuez);
                    break;
                default:
                    break;
            }
            header("Location: verificacion-exitosa.html");
        } else {
            echo "errorActualizacion";
        }
    } else {
        echo "tokenInvalido";
    }
    $conn->close();
} else {
    echo "tokenFaltante";
}
?>
