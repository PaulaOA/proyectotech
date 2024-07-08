<?php 
// Comprobar parámetros necesarios
if(isset($_GET['id_equipo']) && isset($_GET['id_juez'])) {
    $id_equipo = $_GET['id_equipo'];
    $id_juez = $_GET['id_juez'];

// Recuperar nombre de equipo
    $sql_nombre = "SELECT nombre_equipo FROM equipos WHERE id_equipo = $id_equipo";
    $resultado_nombre = $conn->query($sql_nombre);
     if ($resultado_nombre->num_rows > 0) {
    $equipo = $resultado_nombre->fetch_assoc();
    $nombre_equipo = $equipo['nombre_equipo'];
    }

// Comprobar que existen puntuaciones definitivas para ese equipo y juez
    $sql_puntuaciones_definitivas = "SELECT COUNT(*) as count FROM puntuaciones_definitivas_senior WHERE id_equipo = $id_equipo AND id_juez=$id_juez";
    $result_puntuaciones_definitivas = $conn->query($sql_puntuaciones_definitivas);
    $row_puntuaciones_definitivas = $result_puntuaciones_definitivas->fetch_assoc();
    $count_puntuaciones_definitivas = $row_puntuaciones_definitivas['count'];

// Recuperar id, descripción y puntuación del item
    if ($count_puntuaciones_definitivas > 0) {
        $sql_equipo = "SELECT 
                        i.id_item,
                        i.descripcion,
                        p.puntuacion
                    FROM 
                        items_senior AS i
                    LEFT JOIN 
                        puntuaciones_definitivas_senior AS p ON i.id_item = p.id_item
                    WHERE 
                        p.id_equipo = $id_equipo AND id_juez = $id_juez
                    ORDER BY 
                        i.id_item ASC;";

    $puntuaciones_equipo = $conn->query($sql_equipo);
   
   // Recuperar puntuaciones totales
    $sql_puntuaciones_totales = "SELECT * FROM puntuaciones_totales WHERE id_equipo = $id_equipo AND id_juez=$id_juez";
    $result_puntuaciones_totales = $conn->query($sql_puntuaciones_totales);
    $puntuaciones_totales = $result_puntuaciones_totales->fetch_assoc();
    
  // Recuperar nombre de las categorías
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