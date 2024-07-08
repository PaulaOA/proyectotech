<?php
session_start();
include "../archivos/conexion.php";
if (empty($_SESSION["admin"])) {
    header("location: ../index.php"); 
    exit;  
}

if(isset($_GET['id_usuario'])){
  $id_usuario = $_GET['id_usuario'];

  $sql = "SELECT * FROM registro WHERE id_usuario = $id_usuario";
  $result = $conn->query($sql);
  $usuario = $result->fetch_assoc();

} else {header("Location: ../usuarios.php");
}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href= "../css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Administración | Usuarios</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  
    <style>

    .texto-margen-izquierdo {
      margin-left: 40px;
    }

    .texto-label {
      margin-left: 10px;
      margin-top: 10px;
      margin-bottom: 5px;
    }

    .contenedor {
        width: 100%;
        height: 100%;
      }
  </style>
  
  </head>
  <body>

    <!-- FORMULARIO EDITAR USUARIO -->
    
    <form id="formEditarUsuario" method="POST">
      <label for="id_usuario" style="margin-left: 10px;">ID</label>
      <input type="number" name="id_usuario" id="id_usuario" class="form-control" value="<?= $usuario['id_usuario']?>" readonly>
      <label for="nombre" class="texto-label">Nombre</label>
      <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $usuario['nombre']?>">
      <label for="apellidos" class="texto-label">Apellidos</label>
      <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?= $usuario['apellidos']?>">
      <label for="fecha" class="texto-label">Fecha</label>
      <input type="date" name="fecha" id="fecha" class="form-control" value="<?= $usuario['fecha']?>">
      <label for="email" class="texto-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="<?= $usuario['email']?>" readonly>
      <label for="contraseña" class="texto-label">Contraseña</label>
      <input type="password" name="contraseña" id="contraseña" class="form-control" value="<?= $usuario['contraseña']?>" readonly>
      <label for="cargo" class="form-label texto-label">Cargo</label>
      <select name="cargo" id="cargo" class="form-select">
        <option <?php if ($usuario['cargo'] == 'Mentor') echo "selected" ?>>Mentor</option>
        <option <?php if ($usuario['cargo'] == 'Participante') echo "selected" ?>>Participante</option>
        <option <?php if ($usuario['cargo'] == 'Juez') echo "selected" ?>>Juez</option>
      </select>
    </form>
</body>
</html>