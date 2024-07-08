<?php
include "conexion.php";
session_start();

     //Comprobar que email y contraseña no están vacíos

     if (!empty($_POST["email"]) && !empty($_POST["contraseña"])) { 
        $email = $_POST["email"];
        $contraseña = $_POST["contraseña"];

        /*Comprobar que existe un usuario registrado cuyo email y contraseña coinciden con los valores introducidos
          Ese usuario ha de haberse verificado*/

        $sql = "SELECT * FROM registro WHERE email='".$email."' AND contraseña='".$contraseña."' AND verificado=1";
        $resultado= $conn->query($sql);

        //Se asignan variables de sesión

         if ($resultado->num_rows > 0) {
             $datos = $resultado->fetch_object();
                $_SESSION["id_usuario"]=$datos->id_usuario;
                $_SESSION["nombre"]=$datos->nombre;
                $_SESSION["apellidos"]=$datos->apellidos;
                $_SESSION["fecha"]=$datos->fecha;
                $_SESSION["email"]=$datos->email;
                $_SESSION["contraseña"]=$datos->contraseña;
                $_SESSION["cargo"]=$datos->cargo;

            //Comprobar si el usuario es admin o juez para redirigir al panel correspondiente

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