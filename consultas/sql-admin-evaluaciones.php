<?php 

// Listado de jueces registrados
$sql_jueces = "SELECT j.id_juez, r.nombre
                  FROM jueces j
                  INNER JOIN registro r ON r.id_usuario = j.id_usuario";
$resultado_jueces = $conn->query($sql_jueces);

// Listado de equipos registrados
$sql_equipos = "SELECT id_equipo, nombre_equipo FROM equipos";
$resultado_equipos = $conn->query($sql_equipos);

//Listado de jueces por equipo
$sql_jueces_equipo = "SELECT je.id_juez, je.id_equipo, e.nombre_equipo, GROUP_CONCAT(r.nombre SEPARATOR ', ') AS nombre_jueces
                        FROM jueces_equipos je
                        JOIN jueces j ON je.id_juez = j.id_juez
                        JOIN registro r ON r.id_usuario = j.id_usuario
                        JOIN equipos e ON e.id_equipo = je.id_equipo
                        GROUP BY je.id_equipo";
$resultado_jueces_equipo = $conn->query($sql_jueces_equipo);