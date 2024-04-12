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
$query="SELECT * FROM registro WHERE email='$email' AND STATUS = 1";
$result=$conn->query($query);
//$row = $result->fetch_assoc();

if($result->num_rows >0){
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;             
        $mail->Username   = 'pruebas.alexp@gmail.com';
        $mail->Password   = '*********';          
        $mail->Port       = 587;               
    
        $mail->setFrom('alex.senda@gmail.com', 'Alex');
        $mail->addAddress('auro.iphone23@gmail.com', 'Auro');
    
        $mail->isHTML(true); 
        $mail->Subject = 'Recuperacion de contraseña';
        $mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, 
        visita la página <a href="localhost/technovation/proyectotech/contrasena.php?id=' .$row['id'].'">Recuperación de contraseña</a>';
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