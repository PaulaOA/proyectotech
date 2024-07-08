<?php

// Comprobar variables necesarias
if (!empty($_POST['id_equipo']) && !empty($_POST['id_juez'])) {

    $id_equipo = $_POST['id_equipo'];
    $id_juez = $_POST['id_juez'];

     include "../archivos/conexion.php";

        // Comprobar que el juez no haya sido asignado antes a ese equipo
        $sql_consulta = "SELECT * FROM jueces_equipos WHERE id_equipo = $id_equipo AND id_juez = $id_juez";
        $resultado_consulta = $conn->query($sql_consulta);

         if ($resultado_consulta && $resultado_consulta->num_rows > 0) {
            echo "yaAsignado";
        } else {
             // Registrar juez de equipo
             $sql_insert = "INSERT INTO jueces_equipos (id_equipo, id_juez) VALUES ($id_equipo, $id_juez)";

             if ($conn->query($sql_insert) == TRUE) {
                echo "asignado";
             } else {
                echo "errorAlAsignar";
             }
        }

        $conn->close();

    } else {
        echo "elige";
  }