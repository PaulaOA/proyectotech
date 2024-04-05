<?php
session_start();
if (!empty($_POST["iniciar"])) {
    if (!empty($_POST["email"]) and !empty($_POST["contraseña"])) {
        $email=$_POST["email"];
        $contraseña=$_POST["contraseña"];
        $sql=$conn->query("SELECT * FROM registro WHERE email='$email' and contraseña='$contraseña'");
        if ($datos=$sql->fetch_object()) {
            $_SESSION["id"]=$datos->id;
            $_SESSION["nombre"]=$datos->nombre;
            $_SESSION["apellidos"]=$datos->apellidos;
            header("location: ./inicio.php");
        }else{
            echo "<div class='alert alert-danger'>Acceso denegado</div>";
        }

    } else {
        echo "<div class='alert alert-primary'>Rellena los campos</div>";
    }
    
}


?>