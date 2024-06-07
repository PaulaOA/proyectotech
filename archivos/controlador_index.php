<?php
include "conexion.php";
session_start();

     if (!empty($_POST["email"]) && !empty($_POST["contraseña"])) { 
        $email = $_POST["email"];
        $contraseña = $_POST["contraseña"];

        $sql = "SELECT * FROM registro WHERE email='".$email."' AND contraseña='".$contraseña."'";
        $resultado= $conn->query($sql);

         if ($resultado->num_rows > 0) {
             $datos = $resultado->fetch_object();
                $_SESSION["id_usuario"]=$datos->id_usuario;
                $_SESSION["nombre"]=$datos->nombre;
                $_SESSION["apellidos"]=$datos->apellidos;
                $_SESSION["fecha"]=$datos->fecha;
                $_SESSION["email"]=$datos->email;
                $_SESSION["contraseña"]=$datos->contraseña;
                $_SESSION["cargo"]=$datos->cargo;

                if ($datos->admin == 1) {
                    $_SESSION["admin"]=$datos->admin;
                    echo "admin";
                 } else if ($_SESSION["cargo"] == "Juez") {
                    echo "juez";
                 } else {
                    echo "inicio";
                   }
          } else {
               echo "accesoDenegado";
            }
            
      }  else {
        echo "rellenaCampos";
    }

?>