<?php

// Incluir PHPMailer

require "../PHPMailer/PHPMailer.php";
require "../PHPMailer/SMTP.php";
require "../PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function enviarEmailVerificacion($email, $token) {
    $mail = new PHPMailer(true);

    try {
        // Recuperar datos de variables de entorno
        $smtp_user = getenv('SMTP_USER');
        $smtp_password = getenv('SMTP_PASSWORD');

        if (!$smtp_user || !$smtp_password) {
            throw new Exception('Variables de entorno no definidas.');
        }
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_user;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('proyectotech.pruebas@gmail.com', 'Technovation Platform');
        $mail->addAddress($email);
        $mail->Subject = 'Formulario Mentor';
        $mail->Body = "Haz clic en el siguiente enlace para completar tu información como mentor: ";
        $mail->Body .= "http://localhost/proyectotech/mentor/formulario-mentor.php?email=$email&token=$token";

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
        return false;
    }
}

// Script para aceptar o rechazar ser mentor de equipo y registrar perfil de mentor si no existe

include "conexion.php";

// Comprobar parámetros
if (isset($_POST['accion'], $_POST['id'])) {
    $accion = $_POST['accion'];
    $id_equipo = $_POST['id'];
    
    // Obtener el id como participante del creador del equipo
    $sql_obtenerParticipante = "SELECT p.id_participante
                                FROM participantes AS p
                                INNER JOIN equipos AS e ON p.id_usuario = e.id_creador
                                WHERE e.id_equipo = $id_equipo";

    $resultado_participante = $conn->query($sql_obtenerParticipante);

    if ($resultado_participante && $resultado_participante->num_rows > 0) {
        $fila_participante = $resultado_participante->fetch_assoc();
        $id_participante = $fila_participante['id_participante'];

        // Se acepta la solicitud para ser mentor del equipo
        if ($accion == "aceptar" && isset($_POST['id_mentor'], $_POST['email'])) {
            $id_mentor = $_POST['id_mentor'];
            $email = $_POST['email'];

            // Verificar si el mentor ya está registrado
            $sql_verificar_registro = "SELECT mentor_registrado FROM mentores WHERE id_mentor = $id_mentor";
            $resultado_verificacion = $conn->query($sql_verificar_registro);

            if ($resultado_verificacion && $resultado_verificacion->num_rows > 0) {
                $fila_registro = $resultado_verificacion->fetch_assoc();
                $registrado = $fila_registro['mentor_registrado'];
                
                // Perfil de mentor no registrado, se envía email para el registro
                if (!$registrado) {
                    // Generar token y enviar email
                    $token = bin2hex(random_bytes(16));
                    $insertar_token = "UPDATE mentores SET token_registro = '$token' WHERE id_mentor = $id_mentor";

                    if ($conn->query($insertar_token) === true) {
                        if (enviarEmailVerificacion($email, $token)) {
                            // Actualizar estado del equipo y solicitud
                            $sql = "UPDATE equipos SET estado = 'aceptada' WHERE id_equipo = $id_equipo";
                            $sql_participante = "UPDATE solicitudes_equipo SET estado = 'aceptada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";

                            $resultado = $conn->query($sql);
                            $resultado_participante = $conn->query($sql_participante);

                            if ($resultado === TRUE && $resultado_participante === TRUE) {
                                echo "registrate";
                            } else {
                                echo "error";
                            }
                        } else {
                            echo "errorEnvioEmail";
                        }
                    }
                } else { // Perfil de mentor ya registrado
                    // Actualizar estado del equipo y solicitud
                    $sql = "UPDATE equipos SET estado = 'aceptada' WHERE id_equipo = $id_equipo";
                    $sql_participante = "UPDATE solicitudes_equipo SET estado = 'aceptada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";

                    $resultado = $conn->query($sql);
                    $resultado_participante = $conn->query($sql_participante);

                    if ($resultado === TRUE && $resultado_participante === TRUE) {
                        echo "perfilRegistrado";
                    } else {
                        echo "error";
                    }
                }
            } else {
                echo "errorConsultaRegistro";
            }
        } else if ($accion == "rechazar") {
            // Actualizar estado del equipo y solicitud
            $sql = "UPDATE equipos SET estado = 'rechazada' WHERE id_equipo = $id_equipo";
            $sql_participante = "UPDATE solicitudes_equipo SET estado = 'rechazada' WHERE id_participante = $id_participante AND id_equipo = $id_equipo";

            $resultado = $conn->query($sql);
            $resultado_participante = $conn->query($sql_participante);

            if ($resultado === TRUE && $resultado_participante === TRUE) {
                echo "correcto";
            } else {
                echo "error";
            }
        }
    } else {
        echo "No se pudo encontrar el participante asociado al equipo.";
    }

    $conn->close();
} else {
    echo "errorPost";
}
?>
