<?php 
require_once("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = date("Y-m-d H:i:s"); // Formato de fecha estándar para SQL
    $nombreVideo = mysqli_real_escape_string($conn, $_POST['nombrevideo']);
    $urlVideo = mysqli_real_escape_string($conn, $_POST['urlvideo']);
    $id_usuario = $_POST['id_usuario'];

    // Validar y transformar la URL del video
    if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $urlVideo, $id)) {
        $videoId = $id[1];
    } elseif (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $urlVideo, $id)) {
        $videoId = $id[1];
    } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $urlVideo, $id)) {
        $videoId = $id[1];
    } elseif (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $urlVideo, $id)) {
        $videoId = $id[1];
    } else {
        echo "URL INVALIDA";
        exit();
    }


    $url_final_video = 'https://www.youtube.com/embed/' . $videoId;

    // Creación INSERT a BD
    $queryInsert = "INSERT INTO videos (nombrevideo, urlvideo, fecha, id_usuario) VALUES ('$nombreVideo', '$url_final_video', '$fecha', $id_usuario)";
    $result = mysqli_query($conn, $queryInsert);

    if ($result) {
        echo "Video insertado correctamente.";
        header("Location: ../miperfil.php");
    } else {
        echo "Error al insertar el video: " . mysqli_error($conn);
    }
}
?>