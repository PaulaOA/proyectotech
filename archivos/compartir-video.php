<?php

if (!empty($_POST['id_equipo']) && !empty($_POST['id_video']) && !empty($_POST['id_usuario'])) {

   $idEquipo = $_POST['id_equipo'];
   $idVideo = $_POST['id_video'];
   $idUsuario = $_POST['id_usuario'];

    include "conexion.php";

    $sql = "SELECT * FROM videos_compartidos WHERE id_video = $idVideo AND id_equipo = $idEquipo";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows === 0) {
        $sql_insert = "INSERT INTO videos_compartidos (id_video, id_equipo, id_usuario) VALUES ($idVideo, $idEquipo, $idUsuario)";
        $insert = $conn->query($sql_insert);

        if ($insert === TRUE){
            echo "compartidoConExito";
        } else {
            echo "errorCompartirVideo";
        }

    } else {
        echo "videoYaCompartido";
    }
        $conn->close();
        
    } else {
        echo "error";
    }