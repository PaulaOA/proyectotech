<?php 
require_once("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = date("Y-m-d H:i:s"); // Formato de fecha estándar para SQL
    $nombreVideo = mysqli_real_escape_string($conn, $_POST['nombrevideo']);
    $urlVideo = mysqli_real_escape_string($conn, $_POST['urlvideo']);

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
    $queryInsert = "INSERT INTO videos (nombrevideo, urlvideo, fecha) VALUES ('$nombreVideo', '$url_final_video', '$fecha')";
    $result = mysqli_query($conn, $queryInsert);

    if ($result) {
        echo "Video insertado correctamente.";
        header("Location: ../miperfil.php");
    } else {
        echo "Error al insertar el video: " . mysqli_error($conn);
    }
}


/*require_once('conexion.php');

$fecha = date("d-m-Y g:i a");
$nombreVideo = $_POST['nombrevideo'];
$urlVideo = $_POST['urlvideo'];

//https://www.youtube.com/watch?v=MxhasqDtq1s
$cantidad_url_video 	= strlen($urlVideo);
if ($cantidad_url_video == '28') {
	$cortar_url 			= str_replace ('https://youtu.be/','',$urlVideo);
	$url_final_video 		= 'https://www.youtube.com/embed/' .$cortar_url; 

}elseif ($cantidad_url_video == '41') {
	$cortar_url = str_replace ('https://m.youtube.com/watch?v=','',$urlVideo);
	$url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 

}elseif ($cantidad_url_video == '43') {
	$cortar_url = str_replace ('https://www.youtube.com/watch?v=','',$urlVideo);
	$url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 

}elseif ($cantidad_url_video == '58') {
	$cortar_url = str_replace ('https://m.youtube.com/watch?v=','',$urlVideo);
	$url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 

}elseif ($cantidad_url_video == '60') {
	$cortar_url = str_replace ('https://www.youtube.com/watch?v=','',$urlVideo);
	$url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 
}else{
echo "URL INVALIDA";
}

//Creacion INSERT a BD
$queryInsert = ("INSERT INTO videos(nombrevideo, urlvideo, fecha)
	VALUES (
		'$nombreVideo',
		'$url_final_video',
		'$fecha'
	)"
	);
$result = mysqli_query($conn, $queryInsert);
if ($result){
	header("Location:../miperfil.php");
}else {
	echo "Error al insertar el video: ". mysqli_error($conn);
}*/

?>