<?php
include('conexion.php');

// Generar una contraseña temporal aleatoria

$logitudcontraseña = 4;
$micontraseña = substr( md5(microtime()), 1, $logitudcontraseña);
$contraseña = $micontraseña;

$email = trim($_REQUEST['email']); //Quitamos espacios en blanco

// Consultar si el usuario con el correo electrónico proporcionado existe en la BBDD

$consulta = ("SELECT * FROM registro WHERE email ='".$email."'");
$queryconsulta = mysqli_query($conn, $consulta);
$cantidadconsulta = mysqli_num_rows($queryconsulta);
$dataconsulta = mysqli_fetch_array($queryconsulta);

if($cantidadconsulta ==0){ 
    // Redirigir si el usuario no está registrado
    header("Location:index.php");
    exit();
} else {
     // Actualizar contraseña en base de datos con la contraseña temporal generada

        $actualizacontraseña = "UPDATE registro SET contraseña='$contraseña' WHERE email='$email'";
        $queryresult = mysqli_query($conn,$actualizacontraseña);

if ($queryresult) {
    // Enviar correo electrónico con la nueva contraseña temporal al usuario

    $destinatario = $email; 
    $asunto = "Recuperando clave - ProyectoTech";
    $cuerpo = '
            <html>
            <body>
            <p>Hola, '.$dataconsulta['nombre'].'</p>
            <p>Hemos creado una nueva clave temporal para que puedas iniciar sesión:</p>
            <p><strong>'.$micontraseña.'</strong></p>
            <p>Por favor, inicia sesión con esta contraseña temporal y cambia tu contraseña inmediatamente.</p>
            </body>
            </html>
    ';
    $headers  = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: ProyectoTech\r\n";
    $headers .= "Reply-To: "; 
    $headers .= "Return-path:"; 
    $headers .= "Cc:"; 
    $headers .= "Bcc:"; 

if(mail($destinatario,$asunto,$cuerpo,$headers)){
    // Redirigir después de enviar el correo electrónico
    header("Location:../index.php");
    exit();
    } else {
        echo "Error al enviar el correo electrónico.";
    }
}else {
    echo "Error al actualizar la contraseña: " . mysqli_error($conn);
    }
}

//recuperar clave con link
/*include('conexion.php');

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
$asunto = "Recuperando clave - ProyectoTech";
$cuerpo = '
Hola, '.$dataconsulta['nombre'].'
Aquí tienes el enlace para recuperar tu contraseña. '.$linkrecuperar.'
';
$headers = "From: ProyectoTech";

if(mail($destinatario,$asunto,$cuerpo,$headers)){
    header("Location:../index.php");
    exit();
    }
}*/

?>