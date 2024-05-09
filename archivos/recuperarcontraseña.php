<?php
include('conexion.php');

$email             = trim($_REQUEST['email']); //Quitamos algun espacion en blanco
$consulta           = ("SELECT * FROM registro WHERE email ='".$email."'");
$queryconsulta      = mysqli_query($conn, $consulta);
$cantidadconsulta   = mysqli_num_rows($queryconsulta);
$dataconsulta       = mysqli_fetch_array($queryconsulta);

if($cantidadconsulta ==0){
    header("Location:../index.php");
}else{
    function generartokenclave($length = 20) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklymopkz', ceil($length/strlen($x)) )),1,$length);
}

$mitokenclave = generartokenclave();

//Agregar token en la tabla registro
$actualizacontraseña = ("UPDATE registro SET tokenuser='$mitokenclave' WHERE email='".$email."'");
$queryresult = mysqli_query($conn,$actualizacontraseña);

$linkrecuperar = "http://localhost/technovation/proyectotech/contrasena.php?id=".$dataconsulta['id_usuario']."&tokenuser=".$mitokenclave;

$destinatario = $email; 
$asunto       = "Recuperando clave - ProyectoTech";
$cuerpo = '
Hola, '.$dataconsulta['nombre'].'
Aquí tienes el enlace para recuperar tu contraseña. '.$linkrecuperar.'
';
$headers = "From: ProyectoTech";

if(mail($destinatario,$asunto,$cuerpo,$headers)){
    header("Location:../index.php");
    }
}

?>