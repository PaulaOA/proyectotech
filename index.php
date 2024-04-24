<!DOCTYPE html>
<html lang="es">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href= "css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Inicio Sesion | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />

    <style>
      .contenedor {
        width: 100%;
        height: 100%;
      }
      
    </style>
  </head>
  <body>
    <div class="contenedor" id="contenedorIndex">
  <nav class="navbar navbar-dark bg-success navbar-expand-lg static-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/assets/img/logo.png" alt="..." height="36">
    </a>
  </div>
  </nav>  
 
  <div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
           
              <h3 class="login-heading mb-4">Iniciar sesión</h3>

             <!-- FORMULARIO inicio sesión -->

              <form method="POST" id="formInicioSesion">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                  <label for="floatingInput">Correo electrónico</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Password">
                  <label for="floatingPassword">Contraseña</label>
                </div>


                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" value="" id="REMEMBERMEFORFUTUREVISITS">
                  <label class="form-check-label" for="REMEMBERMEFORFUTUREVISITS">
                    Recuérdame
                  </label>
                </div>

                <div id="alertAccesoDenegado" class="alert alert-danger" style="display: none;">Acceso denegado: Usuario o contraseña incorrectos</div>

                <div id="alertRellenaCampos" class="alert alert-primary" style="display: none;">Rellena los campos</div>


                <div class="d-grid">
                  <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" id="btnIniciar">INICIAR</button>

                  <!--<button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit" name="iniciar">Inicia</button>-->

                  <div class="text-left">
                  ¿Aún no te has registrado?
                  <a class="small" href="#" id="btnRegistrarse">Registrarse</a>
                  </div>

                  <div class="text-left">
                  ¿Problemas para acceder?
                  <a class="small" href="#" id="btnRecuperar">Recuperar contraseña</a>
                  </div>
                </div>

                <?php
                if(isset($_GET['message'])){
               
                ?>
                <div class="alert alert-primary" role="alert">
                <?php
                switch ($_GET['message']) {
                  case 'ok';
                  echo "Por favor, revisa tu correo electrónico";
                  break;


                  default;
                  echo "Ha ocurrido un error, inténtalo de nuevo";
                  break;
                }
                ?>
                </div>
                <?php
                }
                ?>
               
              </form>

              <!-- incluyo jquery -->

              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

                <script>
                  $(document).ready(function(){
                    $("#btnIniciar").click(function(event){
                      event.preventDefault();
                      $.ajax({
                        type: "POST",
                        url: "archivos/controlador_index.php",
                        data: $("#formInicioSesion").serialize(),
                        success: function(response){
                          $("#alertAccesoDenegado").hide();
                          $("#alertRellenaCampos").hide();
                          if (response == "inicio"){
                            $("#contenedorIndex").load("inicio.php", function(){
                              history.pushState(null,null,"inicio.php");
                            });
                            window.onpopstate = function(event){
                              $("#contenedorIndex").load("index.php");
                               };
                          } else if (response == "accesoDenegado"){
                            $("#alertAccesoDenegado").show();
                          } else if (response == "rellenaCampos"){
                            $("#alertRellenaCampos").show();
                          }
                        }
                      });
                    });
                  });
                </script>

              <script>
                $(document).ready(function(){
                  $("#btnRegistrarse").click(function(e){
                    e.preventDefault();
                      $("#contenedorIndex").load("registro.php", function(){
                        history.pushState(null, null, "registro.php");
                      });
                  });
                  window.onpopstate = function(event) {
                      $("#contenedorIndex").load("index.php");
                    };
                });
              </script>

               <script>
                $(document).ready(function(){
                  $("#btnRecuperar").click(function(e){
                    e.preventDefault();
                      $("#contenedorIndex").load("recuperar.php", function(){
                        history.pushState(null, null, "recuperar.php");
                      });
                  });
                  window.onpopstate = function(event) {
                      $("#contenedorIndex").load("index.php");
                    };
                });
              </script>



            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<footer class="footer bg-dark text-white py-4">
  <div class="container">
    <div class="row">
      <div class="text-center">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="bi bi-facebook text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-twitter text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-instagram text-white"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="bi bi-linkedin text-white"></i></a></li>
        </ul>
      </div>
      <div class="text-center">
        <p class="text-sm text-center">© 2024 Technovation. Todos los derechos reservados.</p>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>