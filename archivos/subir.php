<?php
include "conexion.php";

// Definir ruta donde se guardarán los archivos
$rutaDestino = "../files/";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file_name = ($_FILES['file']['name']);
    $file_tmp = $_FILES['file']['tmp_name'];
    $desc = ($_POST['desc']);
    $id_usuario = $_POST['id_usuario'];
    
    // Completar ruta
    $rutaSubida = $rutaDestino . $file_name;
    
    // Crear directorio de destino si no existe
    if (!is_dir($rutaDestino)) {
        if (!mkdir($rutaDestino, 0755, true)) {
            die("Error: no se pudo crear el directorio de destino.");
        }
    }
    
    // Tipos de archivos permitidos
    $allowed_types = [
        'application/msword', // .doc
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
        'application/pdf' // .pdf
    ];
    
    // Obtener el MIME del archivo
    $file_type = mime_content_type($file_tmp);

if (in_array($file_type, $allowed_types)) { // Comprobar que el tipo de archivo es permitido
        if (move_uploaded_file($file_tmp, $rutaSubida)) {

            $ruta = "http://localhost/proyectotech/files/" . $file_name; // Ruta para almacenar en base de datos
            
            // Registrar archivo en bbdd
            $sql = "INSERT INTO documentos (nombre, descripcion, id_usuario, ruta) VALUES ('$file_name', '$desc', $id_usuario, '$ruta')";

            $sql_query = mysqli_query($conn,$sql);

            if ($sql_query == true) {
                echo "insercionCorrecta";
            } else {
                echo "errorInserción". mysqli_error($conn) . "<br>";
            }

        } else {
            echo "errorSubidaArchivo";
        }
    } else {
        echo "archivoNoPermitido";
 }
}

$conn -> close();

?>