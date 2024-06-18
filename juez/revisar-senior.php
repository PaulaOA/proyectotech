<?php
include "../archivos/conexion.php";

if(isset($_GET['id_equipo']) && isset($_GET['id_juez'])) {
    $id_equipo = $_GET['id_equipo'];
    $id_juez = $_GET['id_juez'];

    $sql_nombre = "SELECT nombre_equipo FROM equipos WHERE id_equipo = $id_equipo";
    $resultado_nombre = $conn->query($sql_nombre);
     if ($resultado_nombre->num_rows > 0) {
    $equipo = $resultado_nombre->fetch_assoc();
    $nombre_equipo = $equipo['nombre_equipo'];
    }

    $sql_puntuaciones_totales = "SELECT * FROM puntuaciones_totales WHERE id_equipo = $id_equipo AND id_juez=$id_juez";
    $result_puntuaciones_totales = $conn->query($sql_puntuaciones_totales);
    $puntuaciones_totales = $result_puntuaciones_totales->fetch_assoc();

    $sql_puntuaciones_definitivas = "SELECT COUNT(*) as count FROM puntuaciones_definitivas_senior WHERE id_equipo = $id_equipo AND id_juez=$id_juez";
    $result_puntuaciones_definitivas = $conn->query($sql_puntuaciones_definitivas);
    $row_puntuaciones_definitivas = $result_puntuaciones_definitivas->fetch_assoc();
    $count_puntuaciones_definitivas = $row_puntuaciones_definitivas['count'];

    if ($count_puntuaciones_definitivas > 0) {
        $sql_equipo = "SELECT 
                        i.id_item,
                        i.descripcion,
                        p.puntuacion,
                        e.nombre_equipo
                    FROM 
                        items_senior AS i
                    LEFT JOIN 
                        puntuaciones_definitivas_senior AS p ON i.id_item = p.id_item
                    LEFT JOIN
                        equipos AS e ON p.id_equipo = e.id_equipo
                    WHERE 
                        p.id_equipo = $id_equipo AND id_juez = $id_juez
                    ORDER BY 
                        i.id_item ASC;";

    $puntuaciones_equipo = $conn->query($sql_equipo);

    $sql_categorias = "SELECT nombre FROM categorias_senior";
    $resultado_categorias = $conn->query($sql_categorias);

    if ($resultado_categorias->num_rows > 0) {
        $categorias_nombre = array();
        while ($fila_categoria = $resultado_categorias->fetch_assoc()) {
            $categorias_nombre[] = $fila_categoria['nombre'];
        }
    } else {
        echo "<p>No se encontraron categorías.</p>";
        exit();
    }
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
    <link rel="shortcut icon" type="image/png" href="https://www.technovation.org/wp-content/themes/technovation_1.0.6_HC/favicon.png?v=1.0"/>
    <title>Revisar Puntuaciones</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  
    <style>

    .texto-margen-izquierdo {
      margin-left: 40px;
    }

    .contenedor {
        width: 100%;
        height: 100%;
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

  </style>
  </head>
  <body>

<div class="contenedor" id="contenedorRevisarSenior">

<div id="tablaPuntuaciones">
    <div class='container container-fluid' style='max-width: 100%;'>
                <div class='row justify-content-center'>
                    <div class='col-md-10 pl-4'>
                        <div class='card mt-4 mb-2'>
                            <div class='card-header text-center'>Viendo las puntuaciones definitivas del equipo <b><?="$nombre_equipo"?></b></div>
                                <div class='card-body'>
                                    <div class='table-responsive'>
                                        <table class='table table-striped mb-2' id='tabla_puntuaciones'>
                                            <thead>
                                                <tr>
                                                    <th class='text-center' style='width: 10%;'>ID Item</th>
                                                    <th class='text-center' style='width: 80%;'>Item</th>
                                                    <th class='text-center' style='width: 10%;'>Puntuación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class='text-center' colspan='3' style='background-color: blue; color: white;'><?=$categorias_nombre[0]?></td>
                                                </tr>
                                                <?php 
                                                $i = 0;
                                                while ($puntuacion = $puntuaciones_equipo->fetch_assoc()):
                                                    $i++; ?>
                                                           <tr>
                                                            <td class='text-center'><?=$puntuacion['id_item']?></td>
                                                            <td><?=$puntuacion['descripcion']?></td>
                                                            <td class='text-center'><?=($puntuacion['puntuacion'] == 0 ? '' : $puntuacion['puntuacion'])?></td>
                                                        </tr>
                                                        <?php
                                                    if ($i == 1) { ?>
                                                               <tr>
                                                                <td class='text-center' colspan='3' style='background-color: deeppink; color: white;'><?=$categorias_nombre[1]?></td>
                                                            </tr>
                                                    <?php } if ($i == 6) { ?>
                                                              <tr>
                                                                <td class='text-center' colspan='3' style='background-color: forestgreen; color: white;'><?=$categorias_nombre[2]?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan='3' class='titulo' style='background-color: lightgreen; color: black; font-weight: normal;'><b>Opción 1:</b> Presentación de aplicaciones móviles Puntuación técnica de vídeos</td>
                                                            </tr>
                                                            <?php
                                                    }
                                                    if ($i == 10) { ?>
                                                              <tr>
                                                                <td colspan='3' class='descripcion' style='background-color: lightgreen; color: black;'><b>Opción 2:</b> Presentación del prototipo de IA. Puntuación del vídeo técnico</td>
                                                            </tr>
                                                            <?php
                                                    }
                                                    if ($i == 14) { ?>
                                                              <tr>
                                                                <td class='text-center' colspan='3' style='background-color: deeppink; color: white;'><?=$categorias_nombre[3]?></td>
                                                            </tr>
                                                            <?php
                                                    }
                                                    if ($i == 18) { ?>
                                                              <tr>
                                                                <td class='text-center' colspan='3' style='background-color: darkorange; color: white;'><?=$categorias_nombre[4]?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                endwhile; ?>
                                               </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class='container container-fluid' style='max-width: 100%;'>
                <div class='row justify-content-center'>
                    <div class='col-md-5 pl-4'>
                        <div class='card mt-4 mb-2'>
                            <div class='card-header text-center' style='background-color: darkblue; color: white;'>Puntuaciones totales</div>
                                <div class='card-body'>
                                    <div class='table-responsive'>
                                        <table class='table table-striped mb-2' id='tabla_puntuaciones_totales'>
                                            <tbody>
                                                <tr>
                                                  <td style='width: 90%;'>Puntuación total de la descripción del proyecto</td>
                                                  <td class='text-center' colspan='1' style='width: 10%;'><?=$puntuaciones_totales['total_categoria1']?></td>
                                                </tr>
                                                <tr>
                                                  <td style='width: 90%;'>Puntuación total del vídeo</td>
                                                  <td class='text-center' colspan='1' style='width: 10%;'><?=$puntuaciones_totales['total_categoria2']?></td>
                                                </tr>
                                                <tr>
                                                  <td style='width: 90%;'>Puntuación total del vídeo técnico</td>
                                                  <td class='text-center' colspan='1' style='width: 10%;'><?=$puntuaciones_totales['total_categoria3']?></td>
                                                </tr>
                                                <tr>
                                                  <td style='width: 90%;'>Puntuación total del Plan de adopción de usuarios</td>
                                                  <td class='text-center' colspan='1' style='width: 10%;'><?=$puntuaciones_totales['total_categoria4']?></td>
                                                </tr>
                                                <tr>
                                                  <td style='width: 90%;'>Puntuación total del itinerario de aprendizaje</td>
                                                  <td class='text-center' colspan='1' style='width: 10%;'><?=$puntuaciones_totales['total_categoria5']?></td>
                                                </tr>
                                                <tr>
                                                    <td style='text-align: right;' style='width: 90%;'><b>Puntuación total</b></td>
                                                    <td class='text-center' colspan='1' style='width: 10%;'><?=$puntuaciones_totales['total_general']?></td>
                                                </tr>
                                            
                                             </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

    window.onpopstate = function(event) {
        $("#contenedorRevisarSenior").load("evaluaciones.php");
                history.pushState(null, '', "evaluaciones.php");
        };
});

</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>