<?php
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Technovation Platform</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            padding: 20px; /* Para evitar el corte en pantallas pequeñas */
        }
        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            overflow-y: auto; /* Para agregar barra de desplazamiento si el contenido es demasiado grande */
        }
        .form-container h1 {
            text-align: center;
        }

        .form-container h2 {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .form-container label {
            display: block;
            margin-top: 10px;
        }
        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        /* Estilos personalizados para checkbox */
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        .checkbox-container input[type="checkbox"] {
            width: auto; /* Ajustar el tamaño según sea necesario */
            margin-right: 10px; /* Espacio entre el checkbox y el texto */
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        .form-container button:hover {
            background-color: #45a049;
        }

        .modal {
      display: none; /* Por defecto, ocultar el modal */
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3);
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
    </style>
  
  </head>
  <body>

  <div class="form-container">
        <div id="content" class="text-center mt-4">
        <p style="font-size: 18px;"><b>Concurso Technovation CV</b> 2023 - 2024</p>
        <p><b>Formulario de registro para mentores</b></p>
    </div>

    <!-- FORMULARIO MENTOR -->
        <form  id="formularioMentor">
            <h2>Información Personal</h2>
            <label for="nombre_completo">Nombre Completo:</label>
            <input type="text" id="nombre_completo" name="nombre_completo" required>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <h2>Información Profesional</h2>
            <label for="profesion">Profesión:</label>
            <input type="text" id="profesion" name="profesion" required>

            <label for="empresa">Empresa/Organización:</label>
            <input type="text" id="empresa" name="empresa" required>

            <label for="cargo">Cargo/Posición:</label>
            <input type="text" id="cargo" name="cargo" required>

            <label for="especializacion">Áreas de Especialización:</label>
            <input type="text" id="especializacion" name="especializacion" required>

            <h2>Experiencia como Mentor</h2>
            <label for="experiencia_mentor">¿Ha sido mentor anteriormente?</label>
            <select id="experiencia_mentor" name="experiencia_mentor" required>
                <option value="">Seleccione...</option>
                <option value="si">Sí</option>
                <option value="no">No</option>
            </select>

            <div id="descripcion_experiencia_container" style="display: none;">
                <label for="descripcion_experiencia">Descripción de la experiencia previa como mentor:</label>
                <textarea id="descripcion_experiencia" name="descripcion_experiencia"></textarea>
                <label for="num_equipos_mentoreados">Número de equipos mentoreados previamente:</label>
                <input type="number" id="num_equipos_mentoreados" name="num_equipos_mentoreados">
            </div>

            <h2>Motivación y Expectativas</h2>
            <label for="motivacion">¿Por qué desea ser mentor de este equipo?</label>
            <textarea id="motivacion" name="motivacion" required></textarea>

            <label for="disponibilidad">Disponibilidad semanal para mentoría:</label>
            <input type="text" id="disponibilidad" name="disponibilidad" required>

            <h2>Confirmación y Aceptación</h2>
            <div class="checkbox-container">
                <input type="checkbox" id="acepto_terminos" name="acepto_terminos" required>
                <label for="acepto_terminos">
                    Acepto los términos y condiciones del programa de mentoría
                </label>
            </div>

            <button type="submit" id="btnEnviar">Enviar</button>
        </form>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    // Mostrar campos relacionados con la experiencia como mentor si indica "Sí"
    $(document).ready(function() {
        $("#experiencia_mentor").change(function() {
            if ($(this).val() === "si") {
                $("#descripcion_experiencia_container").show();
            } else {
                $("#descripcion_experiencia_container").hide();
            }
        });

    // Solicitud para enviar los datos del formulario
        $("#btnEnviar").click(function(e) {
            e.preventDefault();
           // Si no se ha marcado el campo de Aceptar Términos, mostrar modal y detener el proceso
            if (!$("#acepto_terminos").is(":checked")) {
                $("#modalAceptarTerminos").css("display", "block");
                return;
            }

            var formularioValido = true;
           
           // Comprobar que los campos requeridos no están vacíos
            $("#formularioMentor input[required], #formularioMentor select[required], #formularioMentor textarea[required]").each(function() {
                if ($(this).val().trim() === '') {
                    formularioValido = false;
                    return false;
                }
            });

            if (formularioValido) {
                var email = "<?=$email?>";
                var token = "<?=$token?>";
                var formulario = $("#formularioMentor").serialize();

            $.ajax({
                type: "POST",
                data: {email: email, token: token, formulario: formulario},
                url: "registro-mentor.php",
                success: function(response) {
                    if (response === "perfilMentorYaRegistrado") {
                        $("#modalMentorRegistrado").css("display", "block");
                    } else if (response === "perfilRegistrado") {
                        $("#modalRegistrado").css("display", "block");
                    } else if (response === "errorPost") {
                        $("#modalErrorPost").css("display", "block");
                    } else {
                        $("#modalError").css("display", "block");
                    }
                    },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
             } else {
                // Mostrar modal para informar que existen campos vacíos
                $("#modalRellenaCampos").css("display", "block");
            }
        });
        $(".close-modal").click(function(){
        $(".modal").css("display", "none");
        });
    });
    
</script>

<!-- MODALES -->
 <div id="modalMentorRegistrado" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Perfil Registrado</h1>
    <p class="text-center">Ya has registrado anteriormente tu perfil como mentor</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

 <div id="modalRegistrado" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">¡Enhorabuena!</h1>
    <p class="text-center">Tu perfil como mentor ha sido registrado con éxito</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

 <div id="modalErrorPost" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Error</h1>
    <p class="text-center">Hubo un error con el envío de tus datos</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

 <div id="modalError" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Error</h1>
    <p class="text-center">Hubo un error en el proceso. Por favor, inténtelo más tarde.</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

 <div id="modalRellenaCampos" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Campos vacíos</h1>
    <p class="text-center">Por favor, complete todos los campos antes de enviar.</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

 <div id="modalAceptarTerminos" class="modal">
  <div class="modal-content d-flex flex-column align-items-center justify-content-center">
    <h1 class="h3 mb-3 fw-normal text-center">Aceptar términos</h1>
    <p class="text-center">Por favor, acepte los términos y condiciones para continuar.</p>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Aceptar</button>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>