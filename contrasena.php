<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Recuperar contraseña | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
</head>
<body>
<nav class="navbar navbar-dark bg-success navbar-expand-lg static-top"> 
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/assets/img/logo.png" alt="..." height="36">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>    
<section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="card bg-primary text-left text-white">
                        <h4>Restablece tu contraseña</h4>  
                    </div>
                    <form action="archivos/recovery.php" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>

                                   <div class="form-group">
                                    <label for="contraseña">Nueva contraseña</label>
                                    <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Introduce tu nueva contraseña" required>
                                   </div> 
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-outline-success btn-lg">Enviar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>