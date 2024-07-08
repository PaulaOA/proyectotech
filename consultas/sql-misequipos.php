<?php
// Obtener detalles en relación a los equipos creados por el usuario
$sql_equiposCreados = "SELECT e.*, 
                              r_mentor.nombre AS nombre_mentor,
                              r_creador.nombre AS nombre_creador,
                              GROUP_CONCAT(r_participante.nombre SEPARATOR ', ') AS nombre_participantes
                            FROM 
                              equipos e
                            JOIN 
                              mentores m ON e.id_mentor = m.id_mentor
                            JOIN 
                              registro r_mentor ON m.id_usuario = r_mentor.id_usuario
                            JOIN 
                              registro r_creador ON e.id_creador = r_creador.id_usuario
                            LEFT JOIN 
                              solicitudes_equipo se ON e.id_equipo = se.id_equipo AND se.estado = 'aceptada'
                            LEFT JOIN 
                              participantes p ON se.id_participante = p.id_participante
                            LEFT JOIN 
                              registro r_participante ON p.id_usuario = r_participante.id_usuario
                            WHERE 
                              e.id_creador = $id_usuario 
                              AND e.estado = 'aceptada'
                            GROUP BY 
                              e.id_equipo, r_mentor.nombre, r_creador.nombre";
$consulta_equiposCreados = $conn->query($sql_equiposCreados);

// Obtener detalles de las solicitudes pendientes para equipos creados por el usuario
$sql_participantes = "SELECT
                          e.id_equipo,
                          e.nombre_equipo,
                          se.id_participante,
                          r.nombre AS nombre_participante
                      FROM 
                          solicitudes_equipo se
                      JOIN 
                          equipos e ON se.id_equipo = e.id_equipo
                      JOIN 
                          participantes p ON se.id_participante = p.id_participante
                      JOIN 
                          registro r ON p.id_usuario = r.id_usuario
                      WHERE 
                          se.estado = 'pendiente' 
                          AND e.id_creador = $id_usuario
                          AND p.id_usuario <> e.id_creador";
                          
$consulta_participantes = $conn->query($sql_participantes);

// Obtener detalles en relación a los equipos donde el usuario es participante pero no creador del equipo
$sql_equiposParticipante= "SELECT 
                              e.nombre_equipo, 
                              e.id_equipo,
                              e.division,
                              r_creador.nombre AS nombre_creador,
                              r_mentor.nombre AS nombre_mentor,
                              GROUP_CONCAT(DISTINCT r_participante.nombre SEPARATOR ', ') AS nombre_participantes
                          FROM 
                              equipos e
                          INNER JOIN 
                              registro r_creador ON e.id_creador = r_creador.id_usuario
                          LEFT JOIN 
                              mentores m ON e.id_mentor = m.id_mentor
                          LEFT JOIN 
                              registro r_mentor ON m.id_usuario = r_mentor.id_usuario
                          LEFT JOIN 
                              solicitudes_equipo se ON e.id_equipo = se.id_equipo 
                          LEFT JOIN 
                              participantes p ON se.id_participante = p.id_participante
                          LEFT JOIN 
                              registro r_participante ON p.id_usuario = r_participante.id_usuario
                          WHERE 
                              e.id_creador <> $id_usuario
                              AND se.estado = 'aceptada'
                              AND EXISTS (
                                  SELECT 1 
                                  FROM participantes p_sub
                                  LEFT JOIN solicitudes_equipo se_sub ON p_sub.id_participante = se_sub.id_participante
                                  WHERE se_sub.id_equipo = e.id_equipo
                                    AND p_sub.id_usuario = $id_usuario
                                    AND se_sub.estado = 'aceptada'
                              )
                          GROUP BY 
                              e.id_equipo, e.nombre_equipo, r_creador.nombre, r_mentor.nombre";
$resultado_equiposParticipante = $conn->query($sql_equiposParticipante);

// Obtener las solicitudes pendientes para unirse a un equipo realizadas por el usuario
$solicitudes_unirse = "SELECT e.nombre_equipo, e.id_equipo, se.id_participante, se.id_solicitud, p.id_usuario
                              FROM equipos e
                              JOIN solicitudes_equipo se ON e.id_equipo = se.id_equipo
                              JOIN participantes p ON se.id_participante = p.id_participante
                              WHERE se.estado = 'pendiente' AND p.id_usuario = $id_usuario AND e.id_creador <> $id_usuario";
$resultado_unirse = $conn->query($solicitudes_unirse);