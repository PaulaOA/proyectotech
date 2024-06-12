<?php 
$sql_equipos = "SELECT 
                    eq.nombre_equipo,
                    eq.division,
                    eq.id_equipo,
                    mr.nombre AS mentor,
                    GROUP_CONCAT(r_participante.nombre SEPARATOR ', ') AS nombre_participantes,
                    je.estado_evaluacion,
                    r_juez.id_usuario AS id_usuario_juez
                FROM 
                    jueces_equipos je
                    JOIN equipos eq ON je.id_equipo = eq.id_equipo
                    JOIN mentores me ON eq.id_mentor = me.id_mentor
                    JOIN registro mr ON me.id_usuario = mr.id_usuario
                    JOIN solicitudes_equipo se ON eq.id_equipo = se.id_equipo
                    JOIN participantes pa ON se.id_participante = pa.id_participante
                    JOIN registro r_participante ON pa.id_usuario = r_participante.id_usuario
                    JOIN jueces ju ON je.id_juez = ju.id_juez
                    JOIN registro r_juez ON ju.id_usuario = r_juez.id_usuario
                WHERE 
                    r_juez.id_usuario = $id_usuario
                GROUP BY 
                    eq.nombre_equipo, eq.division, mentor, je.estado_evaluacion, id_usuario_juez
                    ORDER BY eq.nombre_equipo ASC";
$consulta_equipos = $conn->query($sql_equipos);