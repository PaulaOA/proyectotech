<?php
include "conexion.php";

$rutaDestino = "../files/";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file_name = ($_FILES['file']['name']);
    $file_tmp = $_FILES['file']['tmp_name'];
    $desc = ($_POST['desc']);
    $id_usuario = $_POST['id_usuario'];

    $rutaSubida = $rutaDestino . $file_name;

    if (!is_dir($rutaDestino)) {
        if (!mkdir($rutaDestino, 0755, true)) {
            die("Error: no se pudo crear el directorio de destino.");
        }
    }

    $allowed_types = [
        'application/msword', // .doc
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
        'application/pdf' // .pdf
    ];

    $file_type = mime_content_type($file_tmp);

if (in_array($file_type, $allowed_types)) {
        if (move_uploaded_file($file_tmp, $rutaSubida)) {

            $ruta = "http://localhost/proyectotech/files/" . $file_name;

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
        echo "archivoNoPermitido.";
 }
}

$conn -> close();

?>