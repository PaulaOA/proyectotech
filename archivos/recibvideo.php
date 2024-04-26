<?php 
require("conexion.php");

$fecha              = date("d-m-Y g:i a");
$nombreVideo   		= $_POST['nombrevideo'];
$urlVideo   		= $_POST['urlvideo'];

//https://www.youtube.com/watch?v=MxhasqDtq1s
$cantidad_url_video 	= strlen($urlvideo);
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

//Creando mi INSERT a BD
$queryInsert = ("INSERT INTO 
videos(
	nombrevideo,
	urlvideo,
	fecha
)
VALUES (
	'" .$nombreVideo. "',
	'" .$url_final_video. "',
	'" .$fecha. "'
)");
$result = mysqli_query($conn, $queryInsert);

header("Location:../miperfil.php");

?>