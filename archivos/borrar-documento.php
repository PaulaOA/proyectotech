<?php

if (!empty($_POST['idDocumentoAEliminar'])) {

   $idDocumentoAEliminar = $_POST['idDocumentoAEliminar'];

    include "conexion.php";

    $sql = "DELETE FROM documentos WHERE id=$idDocumentoAEliminar";

         if ($conn->query($sql) === TRUE) {
            echo "documentoEliminado";
        } else {
            echo "Error al eliminar el documento: " . $conn->error;
        }

        $conn->close();
        
    } else {
        echo "error";
    }