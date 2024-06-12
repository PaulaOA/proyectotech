<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyectotech";
    //Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);
    $conn->set_charset("utf8");
    //Verificar conexión
    if ($conn->connect_error){
        die("Conexión fallida" . $conn->connect_error);
    } 

    $nameDatabase = "formulariojunior";
    $connFormulario = new mysqli($servername, $username, $password, $nameDatabase);
    $connFormulario->set_charset("utf8");
    if ($connFormulario->connect_error){
        die("Conexión fallida" . $connFormulario->connect_error);
    }
?>