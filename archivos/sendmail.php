<?php
$to="pruebas.alexp@gmail.com";
$subject="Prueba sendmail";
$message="Probando a enviar correo";
$headers='From: alexperez@tech.com\r\n';

if(mail($to,$subject,$message,$headers)){
    echo "El correo enviado a $to se ha enviado correctamente";
}else{
    echo "El correo no se ha enviado";
}

?>