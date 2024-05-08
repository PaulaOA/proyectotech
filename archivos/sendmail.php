<?php
//envio de correos
$to="pruebas.alexp@gmail.com";
$subject="Pruebas de correo";
$message="Hola, este es un correo de solicitud para recuperar tu contraseña. 
Accede a este enlace para recuperarla <a href='http:/localhost/technovation/proyectotech/contrasena.php'></a>";
$headers='From: alexperez@tech.com\r\n';

if(mail($to,$subject,$message,$headers)){
    echo "El correo se ha enviado correctamente";
}else{
    echo "El correo no se ha enviado";
}

?>