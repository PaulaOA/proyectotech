<?php
session_start();
include "../archivos/conexion.php";
include "scripts/informacion-categorias-junior.php";

$equipo = null;
$id_juez = null;

if (empty($_SESSION["nombre"]) || empty($_SESSION["id_usuario"])) {
    header("location: index.php");   
} else {
  $nombre = $_SESSION['nombre'];
  $id_usuario = $_SESSION['id_usuario'];

  $sql_juez = "SELECT id_juez FROM jueces WHERE id_usuario = $id_usuario";
  $resultado_juez = $conn->query($sql_juez);
  if($resultado_juez->num_rows > 0) {
    $juez = $resultado_juez->fetch_assoc();
    $id_juez = $juez['id_juez'];
  }
}
if (isset($_GET['id_equipo'])) {
    $id_equipo = $_GET['id_equipo'];

    $sql_nombre = "SELECT nombre_equipo FROM equipos WHERE id_equipo = $id_equipo";
    $resultado_nombre = $conn->query($sql_nombre);
    if ($resultado_nombre->num_rows > 0) {
    $equipo = $resultado_nombre->fetch_assoc();
    }
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
    <title>Perfil juez | Evaluaciones</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  
    <style>

    .texto-margen-izquierdo {
      margin-left: 40px;
    }

    .contenedor {
        width: 100%;
        height: 100%;
      }

      .container {
        margin: 0 auto; /* Centra el contenedor horizontalmente */
        max-width: 1000px; /* Ancho máximo del contenedor */
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* color semitransparente */
    }

       html {
    position: relative;
    min-height: 100%;
    }

    body {
    margin-bottom: 140px; /* Ajusta este valor según la altura de tu footer */
    }

    footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 120px; /* Ajusta la altura de tu footer según lo necesites */
    background-color: #343a40; /* Color de fondo del footer */
    color: white; /* Color del texto del footer */
    }

     .navbar-nav .nav-link {
    font-size: 18px; 
    }
        table {
        border-collapse: collapse;
        border-right: 2px solid  #87CEFA; /* Añade un borde a la derecha de la tabla */
        width: 100%;
    }

    th, td {
        border-right: 2px solid #87CEFA; /* Bordes a la derecha de todas las celdas */
        border-bottom: 2px solid #87CEFA;
        padding: 8px;
    }

    th.titulo {
        color: white; /* Texto blanco */
        font-weight: bold; /* Texto en negrita */
    }

    td.descripcion {
        width: 90%; /* Ancho de la columna de descripción */
    }

    td.puntuacion {
        width: 10%; /* Ancho de la columna de puntuación */
    }

    th.titulo:first-child, td.descripcion:first-child {
        border-left: none; /* Quitar el borde izquierdo de la primera celda en el encabezado y en el cuerpo de la tabla */
    }
    th, td:last-child {
        border-right: none; /* Quitar el borde derecho de la última celda en todas las filas */
    }

    input.centrado {
        border: none; /* Quitar el borde del input */
        background: none; /* Quitar el fondo del input */
        text-align: center; /* Centrar el texto dentro del input */
        width: 100%; /* Ajustar el ancho del input al 100% de la celda */
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
      <div class="contenedor" id="contenedorFormularioJunior">

    <div id="content" class="text-center mt-4">
        <p style="font-size: 18px;"><b>Evaluación División Junior</b> temporada 2023 - 2024</p>
        <p><b>Guía de puntuación para la asignación de puntos por ítem:</b></p>
        <p><b>1</b> - Insuficiente <span style="margin-left: 30px;"><b>2</b> - Mejorable </span> <span style="margin-left: 30px;"><b>3</b> - Bueno</span><span style="margin-left: 30px;"><b>4</b> - Excelente</span><span style="margin-left: 30px;"><b>5</b> - Asombroso</span></p>
        <p class="mt-2" style="font-size: 22px;">Equipo: <strong><?=$equipo['nombre_equipo']?></strong></p>
    </div>
  <div>
    <form id="formPuntuaciones">

    <div class="container mt-2">
        <table>
            <thead>
                <tr>
                    <th colspan="3" class="titulo" style="background-color: blue;"><?=$categorias_nombre[0]; ?></th>
                </tr>
            </thead>
            <tbody>
              <?php
                 while ($descripcion_item1 = $items_categoria1->fetch_assoc()):
                 ?>
                <tr>
                    <td class="descripcion" style="text-align: right;"><?= $descripcion_item1['descripcion']; ?></td>
                    <td class="puntuacion">
                        <input type="text" class="centrado item-puntuacion" data-categoria="categoria1" id="<?= $descripcion_item1['id_item']; ?>">
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>

        <div class="container mt-5">
        <table>
            <thead>
                <tr>

                    <th colspan="3" class="titulo" style="background-color: deeppink;"><?=$categorias_nombre[1]; ?></th>
                </tr>
            </thead>
            <tbody>
                 <?php
                 while ($descripcion_item2 = $items_categoria2->fetch_assoc()):
                 ?>
                <tr>
                    <td class="descripcion" colspan="2"><?= $descripcion_item2['descripcion']; ?></td>
                    <td class="puntuacion">
                        <input type="text" class="centrado item-puntuacion" data-categoria="categoria2"  id="<?= $descripcion_item2['id_item']; ?>">
                    </td>
                </tr>
                <?php endwhile ?>
                <tr>
                    <td class="descripcion" colspan="2" style="text-align: right;"><b>Puntuación total del vídeo de lanzamiento</b></td>
                    <td class="puntuacion"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria2" readonly></td>
                </tr>
            </tbody>
        </table>
    </div>

<div class="container mt-5">
    <p style="margin-bottom: 0px;"><b>Puntuación para 1 de las siguientes categorías de vídeo técnico: Aplicación móvil o Prototipo de IA</b></p>
    <table>
        <thead>
            <tr>
                <th colspan="3" class="titulo" style="background-color: forestgreen;"><?=$categorias_nombre[2]; ?></th>
            </tr>
            <tr>
                <th colspan="3" class="titulo" style="background-color: lightgreen; color: black; font-weight: normal;"><b>Opción 1:</b> Presentación de aplicaciones móviles Puntuación técnica de vídeos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($descripcion_item3 = $items_categoria3->fetch_assoc()):
                $i++;
                ?>
                <tr>
                    <td class="descripcion" colspan="2"><?= $descripcion_item3['descripcion']; ?></td>
                    <td class="puntuacion">
                        <input type="text" class="centrado especial item-puntuacion" data-categoria="categoria3" id="<?= $descripcion_item3['id_item']; ?>" data-especial="true">
                    </td>
                </tr>
                <?php if ($i == 3): ?>
                <tr>
                    <td colspan="3" class="descripcion" style="background-color: lightgreen; color: black;"><b>Opción 2:</b> Presentación del prototipo de IA. Puntuación del vídeo técnico</td>
                </tr>
                <?php endif; ?>
            <?php endwhile ?>
            <tr>
                <td class="descripcion" colspan="2" style="text-align: right;"><b>Puntuación técnica total del vídeo</b></td>
                <td class="puntuacion"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria3" readonly></td>
            </tr>
        </tbody>
    </table>
</div>

            <div class="container mt-5">
        <table>
            <thead>
                <tr>

                    <th colspan="3" class="titulo" style="background-color: deeppink;"><?=$categorias_nombre[3]; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                 while ($descripcion_item4 = $items_categoria4->fetch_assoc()):
                 ?>
                <tr>
                    <td class="descripcion" colspan="2"><?= $descripcion_item4['descripcion']; ?></td>
                    <td class="puntuacion"><input type="text" class="centrado item-puntuacion" data-categoria="categoria4" id="<?= $descripcion_item4['id_item']; ?>"></td>
                </tr>
                 <?php endwhile ?>
                <tr>
                    <td class="descripcion" colspan="2" style="text-align: right;"><b>Puntuación total de adopción de usuarios</b></td>
                    <td class="puntuacion"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria4" readonly></td>
                </tr>
            </tbody>
        </table>
    </div>

      <div class="container mt-5">
        <table>
            <thead>
                <tr>

                    <th colspan="3" class="titulo" style="background-color: darkorange;"><?=$categorias_nombre[4]; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                 while ($descripcion_item5 = $items_categoria5->fetch_assoc()):
                 ?>
                <tr>
                    <td class="descripcion" colspan="2"><?= $descripcion_item5['descripcion']; ?></td>
                    <td class="puntuacion"><input type="text" class="centrado item-puntuacion" data-categoria="categoria5" id="<?= $descripcion_item5['id_item']; ?>"></td>
                </tr>
                 <?php endwhile ?>
                <tr>
                    <td class="descripcion" colspan="2" style="text-align: right;"><b>Puntuación total del itinerario de aprendizaje</b></td>
                    <td class="puntuacion"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria5" readonly></td>
                </tr>
            </tbody>
        </table>
    </div>

          <div class="container mt-5" style="max-width: 700px;">
        <table>
            <thead>
                <tr>

                    <th colspan="2" class="titulo" style="background-color: darkblue;">Puntuación total</th>
                    <th colspan="1" class="titulo" style="background-color: darkblue;">Puntuación</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="descripcion" colspan="2" style="width: 70%">Puntuación total de la Descripción del Proyecto</td>
                    <td class="puntuacion" style="width: 30%"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria1" id="totalCategoria1" readonly></td>
                </tr>
                <tr>
                    <td class="descripcion" colspan="2" style="width: 70%">Puntuación total del vídeo</td>
                    <td class="puntuacion" style="width: 30%"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria2" id="totalCategoria2" readonly></td>
                </tr>
                <tr>
                    <td class="descripcion" colspan="2" style="width: 70%">Puntuación total del vídeo técnico</td>
                    <td class="puntuacion" style="width: 30%"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria3" id="totalCategoria3" readonly></td>
                </tr>
                <tr>
                    <td class="descripcion" colspan="2" style="width: 70%">Puntuación total del Plan de adopción de usuarios</td>
                    <td class="puntuacion" style="width: 30%"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria4" id="totalCategoria4" readonly></td>
                </tr>
                <tr>
                    <td class="descripcion" colspan="2" style="width: 70%">Puntuación total del itinerario de aprendizaje</td>
                    <td class="puntuacion" style="width: 30%"><input type="text" class="centrado puntuacion-automatica" data-categoria="categoria5" id="totalCategoria5" readonly></td>
                </tr>
                <tr>
                    <td class="descripcion" colspan="2" style="text-align: right;"><b>Puntuación total</b></td>
                    <td class="puntuacion"><input type="text" class="centrado puntuacion-automatica general" id="totalGeneral" readonly></td>
                </tr>
                 <input type="hidden" id="id_equipo" value="<?=$id_equipo?>">
                 <input type="hidden" id="division" value="Junior">
            </tbody>
        </table>

          <div class="text-center mt-5">
            <button class="btn btn-secondary py-3 px-3" id="btnGuardar" data-equipo="<?=$id_equipo?>" data-division="Junior">Guardar</button>
            <button class="btn btn-primary py-3 px-3" id="btnEnviar" style="margin-left: 50px;" data-equipo="<?=$id_equipo?>" data-division="Junior">Enviar</button>
          </div>
    </div>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

<script src="funciones.js"></script>

<script>
        const itemPuntuacionInputs = document.querySelectorAll('.item-puntuacion');

        itemPuntuacionInputs.forEach(input => {
        input.addEventListener('input', () => {
            const allPuntuacionInputs = document.querySelectorAll('.item-puntuacion');
            
            let totalPuntuacion = 0;

            allPuntuacionInputs.forEach(itemInput => {
                const valor = parseFloat(itemInput.value) || 0;
                totalPuntuacion += valor;
            });

            const puntuacionTotalInputs = document.querySelectorAll('.puntuacion-automatica.general');
            puntuacionTotalInputs.forEach(puntuacionTotalInput => {
                puntuacionTotalInput.value = totalPuntuacion || '';
            });

            const categorias = new Set();
            itemPuntuacionInputs.forEach(input => categorias.add(input.getAttribute('data-categoria')));

            categorias.forEach(categoria => {
                const categoriaInputs = document.querySelectorAll(`.item-puntuacion[data-categoria="${categoria}"]`);
                let totalPuntuacionCategoria = null;

                categoriaInputs.forEach(itemInput => {
                    const valor = parseFloat(itemInput.value) || 0;
                    totalPuntuacionCategoria = (totalPuntuacionCategoria === null) ? valor : totalPuntuacionCategoria + valor;
                });

                const puntuacionTotalInputsCategoria = document.querySelectorAll(`.puntuacion-automatica[data-categoria="${categoria}"]`);
                puntuacionTotalInputsCategoria.forEach(puntuacionTotalInput => {
                    puntuacionTotalInput.value = (totalPuntuacionCategoria !== null && totalPuntuacionCategoria !== 0) ? totalPuntuacionCategoria : '';
                });
            });
        });
    });
    
</script>

<script>
$(document).ready(function() {
    <?php
    if (isset($_GET['puntuaciones'])) {
    ?>
    $.ajax({
        type: "GET",
        url: "scripts/obtener-puntuaciones-guardadas.php",
        data: { id_equipo: <?=$id_equipo?>, division: "Junior", id_juez: <?=$id_juez?>},
        success: function(response) {
            cargarPuntuaciones(response);
        }
    });
    <?php
    }
    ?>

    function cargarPuntuaciones(response) {
        var puntuaciones = response.split(';'); 
                
                 puntuaciones.forEach(function(puntuacion) {
                    var partes = puntuacion.split(':');
                    var clave = partes[0];
                    var valor = partes[1];
                    $('input').filter(function() {
                        return this.id === clave;
                    }).val(function() {
                        return valor === '0' ? '' : valor;
                    });
                });
               calcularTotales();
            }
        function calcularTotales() {
            const itemPuntuacionInputs = document.querySelectorAll('.item-puntuacion');
            const allPuntuacionInputs = document.querySelectorAll('.item-puntuacion');

            let totalPuntuacion = 0;

            allPuntuacionInputs.forEach(itemInput => {
                const valor = parseFloat(itemInput.value) || 0;
                totalPuntuacion += valor;
            });

            const puntuacionTotalInputs = document.querySelectorAll('.puntuacion-automatica.general');
            puntuacionTotalInputs.forEach(puntuacionTotalInput => {
                puntuacionTotalInput.value = totalPuntuacion || '';
            });

            const categorias = new Set();
            itemPuntuacionInputs.forEach(input => categorias.add(input.getAttribute('data-categoria')));

            categorias.forEach(categoria => {
                const categoriaInputs = document.querySelectorAll(`.item-puntuacion[data-categoria="${categoria}"]`);
                let totalPuntuacionCategoria = null;

                categoriaInputs.forEach(itemInput => {
                    const valor = parseFloat(itemInput.value) || 0;
                    totalPuntuacionCategoria = (totalPuntuacionCategoria === null) ? valor : totalPuntuacionCategoria + valor;
                });

                const puntuacionTotalInputsCategoria = document.querySelectorAll(`.puntuacion-automatica[data-categoria="${categoria}"]`);
                puntuacionTotalInputsCategoria.forEach(puntuacionTotalInput => {
                    puntuacionTotalInput.value = (totalPuntuacionCategoria !== null && totalPuntuacionCategoria !== 0) ? totalPuntuacionCategoria : '';
                });
            });
        }
    });
</script>

<script>
$(document).ready(function(){
    window.onpopstate = function(event){
          $("#contenedorFormularioJunior").load("evaluaciones.php");
         };
    });
</script>

<?php include "botones.php"; ?>

<?php include "modales.php";?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>