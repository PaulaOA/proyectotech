<?php
if(isset($_POST['submit'])){
    $destinatario = "pruebas.alexp@gmail.com";
    $asunto = "Envío de autorización paterna";
    $mensaje = "Adjunto encontrarás el archivo PDF de la autorización paterna.";

    // Nombre del archivo cargado y ruta temporal
    $archivo_temporal = $_FILES['file']['tmp_name'];
    $nombre_archivo = $_FILES['file']['name'];

    // Leer el archivo y codificar el contenido
    $content = file_get_contents($archivo_temporal);
    $encoded_content = chunk_split(base64_encode($content));
    
    // Límite del contenido
    $boundary = md5("pera");

    // Cabeceras del correo electrónico
    $cabeceras = "MIME-Version: 1.0\r\n";
    $cabeceras .= "From: ".$destinatario."\r\n";
    $cabeceras .= "Reply-To: alex.senda@gmail.com\r\n";
    $cabeceras .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n\r\n";

    // Cuerpo del mensaje
    $cuerpo = "--$boundary\r\n";
    $cuerpo .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $cuerpo .= "Content-Transfer-Encoding: 8bit\r\n\r\n"; 
    $cuerpo .= $mensaje . "\r\n\r\n";

    // Adjuntar el archivo PDF
    $cuerpo .= "--$boundary\r\n";
    $cuerpo .= "Content-Type: application/pdf; name=\"$nombre_archivo\"\r\n";
    $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
    $cuerpo .= "Content-Disposition: attachment; filename=\"$nombre_archivo\"\r\n\r\n";
    $cuerpo .= $encoded_content . "\r\n";

    // Marcar el final del cuerpo del mensaje
    $cuerpo .= "--$boundary--";

    // Envío del correo electrónico
    if(mail($destinatario, $asunto, $cuerpo, $cabeceras)) {
        echo "El correo se ha enviado correctamente.";
        header("Location: ../miperfil.php");
    } else {
        echo "Error al enviar el correo.";
    }
}


?>