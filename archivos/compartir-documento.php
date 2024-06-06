<?php

if (!empty($_POST['id_equipo']) && !empty($_POST['id_documento']) && !empty($_POST['id_usuario'])) {

   $idEquipo = $_POST['id_equipo'];
   $idDocumento = $_POST['id_documento'];
   $idUsuario = $_POST['id_usuario'];

    include "conexion.php";

    $sql = "SELECT * FROM documentos_compartidos WHERE id_documento = $idDocumento AND id_equipo = $idEquipo";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows === 0) {
        $sql_insert = "INSERT INTO documentos_compartidos (id_documento, id_equipo, id_usuario) VALUES ($idDocumento, $idEquipo, $idUsuario)";
        $insert = $conn->query($sql_insert);

        if ($insert === TRUE){
            echo "compartidoConExito";
        } else {
            echo "errorCompartir";
        }

    } else {
        echo "documentoYaCompartido";
    }
        $conn->close();
        
    } else {
        echo "error";
    }