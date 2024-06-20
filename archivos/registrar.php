<?php

require "../PHPMailer/PHPMailer.php";
require "../PHPMailer/SMTP.php";
require "../PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function verificarDominio($email) {
    $dominio = explode('@', $email)[1];
    return checkdnsrr($dominio, 'MX');
}

function generarToken() {
    return bin2hex(random_bytes(16));
}

function enviarEmailVerificacion($email, $token) {
    $mail = new PHPMailer(true);

    try {

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

        // Configuración del mensaje
        $mail->setFrom('proyectotech.pruebas@gmail.com', 'Technovation Platform');
        $mail->addAddress($email);
        $mail->Subject = 'Verifica tu correo';
        $mail->Body = "Haz clic en el siguiente enlace para verificar tu correo electrónico: ";
        $mail->Body .= "http://localhost/proyectotech/archivos/verificar-email.php?email=$email&token=$token";

        // Envío del correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
        return false;
    }
}

if (empty($_POST['nombre']) || 
    empty($_POST['apellidos']) || 
    empty($_POST['fecha']) || 
    empty($_POST['email']) || 
    empty($_POST['contraseña']) || 
    empty($_POST['repiteContraseña']) || 
    empty($_POST['cargo'])) {
    echo "rellenaCampos";
} else {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha = $_POST['fecha'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $repiteContraseña = $_POST['repiteContraseña'];
    $cargo = $_POST['cargo']; 

    if (!validarEmail($email)) {
        echo "emailInvalido";
    } else if (!verificarDominio($email)) {
        echo "dominioInvalido";
    } else if ($contraseña !== $repiteContraseña) {
        echo "errorContraseña";
    } else {
        include "conexion.php";

        $sql = "SELECT * FROM registro WHERE email='".$email."'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "emailYaRegistrado";
        } else {
            $token = generarToken();
            $insertar = "INSERT INTO registro (nombre, apellidos, fecha, email, contraseña, cargo, token) 
                         VALUES ('$nombre', '$apellidos', '$fecha', '$email', '$contraseña', '$cargo', '$token')";

            if ($conn->query($insertar) === true) {
                if (enviarEmailVerificacion($email, $token)) {
                    echo "verificaEmail";
                } else {
                    echo "errorEnvioEmail";
                }
            } else {
                echo "error";
            }
        }
        $conn->close();
    }
}

?>
