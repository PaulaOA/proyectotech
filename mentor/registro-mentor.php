<?php
if (isset($_POST['email']) && isset($_POST['token']) && isset($_POST['formulario'])) {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $formulario = $_POST['formulario'];

    parse_str($formulario, $datosFormulario);

    // Recuperar datos del formulario
    $nombre_completo = $datosFormulario['nombre_completo'];
    $telefono = $datosFormulario['telefono'];
    $direccion = $datosFormulario['direccion'];
    $profesion = $datosFormulario['profesion'];
    $empresa = $datosFormulario['empresa'];
    $cargo = $datosFormulario['cargo'];
    $especializacion = $datosFormulario['especializacion'];
    $experiencia_mentor = $datosFormulario['experiencia_mentor'];
    $descripcion_experiencia = $datosFormulario['descripcion_experiencia'];
    $num_equipos_mentoreados = $datosFormulario['num_equipos_mentoreados'];
    $motivacion = $datosFormulario['motivacion'];
    $disponibilidad = $datosFormulario['disponibilidad'];
    $acepto_terminos = isset($datosFormulario['acepto_terminos']) ? 1 : 0;

    include "../archivos/conexion.php";

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consultar el ID de usuario y el ID de mentor asociado al correo electrónico
    $sql_usuario = "SELECT r.id_usuario, m.id_mentor
                    FROM registro r
                    INNER JOIN mentores m ON r.id_usuario = m.id_usuario
                    WHERE r.email ='$email'";

    $resultado_usuario = $conn->query($sql_usuario);

    if ($resultado_usuario && $resultado_usuario->num_rows > 0) {
        $usuario = $resultado_usuario->fetch_assoc();
        $id_usuario = $usuario['id_usuario'];
        $id_mentor = $usuario['id_mentor'];

        // Verificar si ya existe un perfil para este mentor
        $sql_verificar_perfil = "SELECT id_perfil FROM perfil_mentores WHERE id_mentor = '$id_mentor'";
        $resultado_verificacion = $conn->query($sql_verificar_perfil);

        if ($resultado_verificacion && $resultado_verificacion->num_rows > 0) {
            echo "perfilMentorYaRegistrado";
        } else {
            // Iniciar transacción para insertar el perfil del mentor
            $conn->begin_transaction();

            try {
                // Insertar el perfil del mentor en la tabla perfil_mentores
                $sql_insert_perfil = "INSERT INTO perfil_mentores (
                    id_mentor, nombre_completo, telefono, direccion, profesion, empresa, cargo, especializacion,
                    experiencia_mentor, descripcion_experiencia, num_equipos_mentoreados, motivacion, disponibilidad, acepto_terminos
                ) VALUES (
                    '$id_mentor', '$nombre_completo', '$telefono', '$direccion', '$profesion', '$empresa', '$cargo', '$especializacion',
                    '$experiencia_mentor', '$descripcion_experiencia', '$num_equipos_mentoreados', '$motivacion', '$disponibilidad', '$acepto_terminos'
                )";

                if ($conn->query($sql_insert_perfil) === TRUE) {
                    // Actualizar el estado del mentor a registrado en la tabla mentores
                    $sql_update_mentor = "UPDATE mentores SET mentor_registrado = TRUE WHERE id_usuario = $id_usuario";

                    if ($conn->query($sql_update_mentor) === TRUE) {
                        // Confirmar transacción si todas las operaciones fueron exitosas
                        $conn->commit();
                        echo "perfilRegistrado";
                    } else {
                        throw new Exception("Error al actualizar el estado del mentor: " . $conn->error);
                    }
                } else {
                    throw new Exception("Error al insertar en perfil_mentores: " . $conn->error);
                }
            } catch (Exception $e) {
                // Revertir la transacción en caso de error
                $conn->rollback();
                echo "error: " . $e->getMessage();
            }
        }
    } else {
        echo "Error: No se encontró el usuario o mentor asociado.";
    }

    $conn->close();
} else {
    echo "errorPost";
}
?>
