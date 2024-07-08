<?php

include "archivos/conexion.php";

/* RECUPERAR EQUIPOS CREADOS POR EL USUARIO */

$consultaEquipos = "SELECT equipos.*, registro.nombre AS nombre_mentor
                      FROM equipos
                      INNER JOIN mentores ON equipos.id_mentor = mentores.id_mentor
                      INNER JOIN registro ON mentores.id_usuario = registro.id_usuario
                      WHERE equipos.id_creador = $id_usuario";

  $solicitudes = $conn->query($consultaEquipos);

/* RECUPERAR LISTADO DE MENTORES REGISTRADOS */

$sql = "SELECT registro.nombre, mentores.id_mentor FROM registro JOIN mentores ON registro.id_usuario = mentores.id_usuario";
$resultado = $conn->query($sql);