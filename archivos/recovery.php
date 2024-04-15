<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

require_once('conexion.php');
//require_once('controlador_index.php');
$email=$_POST['email'];
$sql=$conn->query("SELECT * FROM registro WHERE email='$email' AND STATUS = 1");
$result=$conn->query($sql);
//$row = $result->fetch_assoc();

if($result->num_rows >0){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;             
        $mail->Username   = 'pruebas.alexp@gmail.com';
        $mail->Password   = 'gqbvytcecqkycgye';          
        $mail->Port       = 465;               
    
        $mail->setFrom('pruebas.alexp@gmail.com', 'Alex');
        $mail->addAddress('alex.senda@gmail.com');
    
        $mail->isHTML(true); 
        $mail->Subject = 'Recuperacion de contraseña';
        $mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, 
        visita la página <a href="localhost/technovation/proyectotech/contrasena.php?id='.$row['id'].'">Recuperación de contraseña</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        header ("Location: ../index.php?message=ok");
    } catch (Exception $e) {
        header ("Location: ../index.php?message=error");
    }
}else {
    header ("Location: ../index.php?message=not_found");
}


?>