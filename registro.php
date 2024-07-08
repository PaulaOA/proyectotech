<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Registro | Technovation Girl</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />

    <style>
      .contenedor {
        width: 100%;
        height: 100%;
      }

      .modal {
          display: none;
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0,0,0,0.7);
          align-items: center;
        }

      .modal-content {
          background-color: #fefefe;
          margin: 20% auto;
          padding: 20px;
          border: 1px solid #888;
          width: 40%;
          max-width: 350px;
          height: 220px;
          z-index: 1100;
        }

     .btnModal {
          display: block; 
          background-color: #007bff;
          color: #fff;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          width: 35%;
          margin: 20px auto 0;
          padding: 10px;
        }
    html {
    position: relative;
    min-height: 100%;
    }

    .navbar-nav .nav-link {
    font-size: 18px; 
    }

    footer {
    position: relative;
    margin-top: auto;
    bottom: 0;
    width: 100%;
    height: 120px;
    background-color: #343a40;
    color: white;
    }
      
      
    </style>
</head>
<body>
    <div class="contenedor" id="contenedorRegistro">
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
                <div class="col-md-8">
                    <div class="card bg-primary text-center text-white">
                        <h3>Formulario de registro</h3>  
                    </div>

                    <!-- FORMULARIO de registro de nuevo usuario -->

                    <form id="formRegistro">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>
                                   <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Inserta tu nombre" required>
                                   </div> 

                                   <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Inserta tus apellidos" >
                                   </div> 

                                   <div class="form-group">
                                    <label for="fecha">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Inserta tu fecha de nacimiento" >
                                   </div> 

                                   <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Inserta tu email" required>
                                   </div> 

                                   <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Inserta tu contraseña" required>
                                   </div>

                                   <div class="form-group">
                                    <label for="password">Confirmar contraseña</label>
                                    <input type="password" class="form-control" name="repiteContraseña" id="repiteContraseña" placeholder="Repite tu contraseña" required>
                                   </div>

                                   <div class="form-group">
                                   <label for="cargo" class="form-label">¿Quién eres?</label>
                                   <select id="cargo" class="form-select" name="cargo">
                                        <option selected>Elige una opción</option>
                                        <option>Mentor</option>
                                        <option>Participante</option>
                                        <option>Juez</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="alertError" class="alert alert-danger" style="display: none;">No se pudo crear la cuenta</div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary btn-lg" id="btnRegistrar">
                              <span id="registroBtnText">Registrar</span>
                              <span id="registroBtnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>

    <!-- Incluir jquery -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>

      function validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
      }
          // Manejar solicitud de registro

          $(document).ready(function(){
            $("#btnRegistrar").click(function(event){
              event.preventDefault();

            // Obtener valores de los campos

            const nombre = $("#nombre").val().trim();
            const apellidos = $("#apellidos").val().trim();
            const fecha = $("#fecha").val().trim();
            const email = $("#email").val().trim();
            const contraseña = $("#contraseña").val().trim();
            const repiteContraseña = $("#repiteContraseña").val().trim();
            const cargo = $("#cargo").val().trim();

            // Validar campos requeridos

            if (nombre === '' || apellidos === '' || fecha === '' || email === '' || contraseña === '' || repiteContraseña === '' || cargo === 'Elige una opción') {
                $(".modal").css("display", "none");
                $("#modalRellenaCampos").css("display", "block");
                return false;
            }

            // Botón de registrar muestra símbolo de proceso

            $("#registroBtnText").addClass("visually-hidden"); 
            $("#registroBtnLoader").removeClass("d-none");

            // Validar formato de email antes de procesar solicitud

            if (!validarEmail(email)) {
                $(".modal").css("display", "none");
                $("#modalEmailInvalido").css("display", "block");

                $("#registroBtnText").removeClass("visually-hidden");
                $("#registroBtnLoader").addClass("d-none");
                return false; // Detener la ejecución del formulario
            }

              $.ajax({
                type: "POST",
                url: "archivos/registrar.php",
                data: $("#formRegistro").serialize(),
                success: function(response){
                  switch(response) {

                    case "emailYaRegistrado":
                      $("#modalEmailYaRegistrado").css("display", "block");
                      break;
                    case "rellenaCampos":
                      $("#modalRellenaCampos").css("display", "block");
                      break;
                    case "errorContraseña":
                      $("#modalErrorContraseña").css("display", "block");
                      break;
                    case "emailInvalido":
                      $("#modalEmailInvalido").css("display", "block");
                      break;
                    case "dominioInvalido":
                      $("#modalDominioInvalido").css("display", "block");
                      break;
                    case "verificaEmail":
                      $("#modalVerificaEmail").css("display", "block");
                      break;
                    case "error":
                      $("#alertError").show();
                      break;
                    default:
                      console.log("Respuesta no esperada: " + response);
                  }

                $("#registroBtnText").removeClass("visually-hidden");
                $("#registroBtnLoader").addClass("d-none");
                }
              });
              return false;
            });
            $(".close, .close-modal").click(function(){
            $(".modal").css("display", "none");
            });
          });
        </script>

         <script>
          // Redirigir a index si el proceso de registro ha sido correcto al cerrar el modal mostrado

          $(document).ready(function(){
            $("#btnAceptar").click(function(e){
              e.preventDefault();
                $("#contenedorRegistro").load("index.php", function(){
                    history.pushState(null, null, "index.php");
                });
                window.onpopstate = function(event){
                    $("#contenedorRegistro").load("registro.php");
                };
                });
            });
        </script>

        <!-- Modales -->

        <div id="modalEmailYaRegistrado" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Email Registrado</h1>
            <p class="text-center">Ya existe una cuenta con este email</p>
            <button class="btnModal mx-auto close-modal">Aceptar</button>
          </div>
        </div>

        <div id="modalRellenaCampos" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Campos vacíos</h1>
            <p class="text-center">Por favor, completa todos los campos</p>
            <button class="btnModal mx-auto close-modal">Aceptar</button>
          </div>
        </div>

        <div id="modalErrorContraseña" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Contraseñas distintas</h1>
            <p class="text-center">Las constraseñas no coinciden</p>
            <button class="btnModal mx-auto close-modal">Volver</button>
          </div>
        </div>

        <div id="modalEmailInvalido" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Email inválido</h1>
            <p class="text-center">Por favor, introduce una dirección de email válida</p>
            <button class="btnModal mx-auto close-modal">Aceptar</button>
          </div>
        </div>

        <div id="modalDominioInvalido" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Dominio inválido</h1>
            <p class="text-center">Por favor, introduce un dominio válido</p>
            <button class="btnModal mx-auto close-modal">Aceptar</button>
          </div>
        </div>

        <div id="modalVerificaEmail" class="modal">
          <div class="modal-content d-flex flex-column align-items-center justify-content-center">
            <h1 class="h3 mb-3 fw-normal text-center">Verifica tu email</h1>
            <p class="text-center">Se ha enviado un email de verificación. Revisa tu correo</p>
            <button class="btnModal mx-auto close-modal" id="btnAceptar">Aceptar</button>
          </div>
        </div>
    
    <footer class="footer bg-dark text-white py-4">
  <div class="container">
    <div class="row">
      <div class="text-center">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="bi bi-facebook text-white"></i></a></li>
          <li class="list-inline-item"><a href="https://www.twitter.com/TalentGrowthM"><i class="bi bi-twitter text-white"></i></a></li>
          <li class="list-inline-item"><a href="https://www.instagram.com/talentgrowthmbp/"><i class="bi bi-instagram text-white"></i></a></li>
          <li class="list-inline-item"><a href="https://www.linkedin.com/company/tgmbp/"><i class="bi bi-linkedin text-white"></i></a></li>
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
