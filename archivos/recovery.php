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
$sql="SELECT * FROM registro WHERE email='$email' AND STATUS = 1";
//$result=$conn->query($sql);
//$row = $result->fetch_assoc();

//if($result->num_rows >0){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp-mail.outlook.com';
        $mail->SMTPAuth   = true;             
        $mail->Username   = 'Alejandro.Perez015@universae360.com';
        $mail->Password   = 'XXXXX';   
        $mail->SMTPSecure =  'ssl';  
        $mail->Port = 587;               
    
        $mail->setFrom('Alejandro.Perez015@universae360.com', 'Alex');
        $mail->addAddress('alex.senda@gmail.com');
    
        $mail->isHTML(true); 
        $mail->Subject = 'Recuperacion de contraseña';
        $mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña,';
    
        $mail->send();
        echo 'el mensaje se ha enviado correctamente';
        //header ("Location: ../index.php?message=ok");
        //exit();
    } catch (Exception $e) {
        echo 'Ha ocurrido un error',  $mail->ErrorInfo;
        //header ("Location: ../index.php?message=error");
        //exit();
    }
/*}else {
    header ("Location: ../index.php?message=not_found");
    exit();
}*/


?>