// FUNCIÓN PARA COMPROBAR SI EL EQUIPO YA HA SIDO EVALUADO DE FORMA DEFINITIVA     
   function verificarPuntuacionesDefinitivas(id_equipo, division, id_juez) {
        $.ajax({
            type: "POST",
            url: "scripts/verificar-puntuaciones-definitivas.php",
            data: { id_equipo: id_equipo,
                    division: division,
                    id_juez: id_juez
                  },
            success: function(response) {
                // Si no ha sido puntuado, continuar con el proceso de guardar
                if (response === "sinRegistros") {
                    continuarProcesoGuardar(id_equipo, division, id_juez);
                } else {
                    $("#modalPuntuacionDefinitiva").css("display", "block");
                }
            }
        });
    }

// FUNCIÓN PARA CONTINUAR CON EL PROCESO DE GUARDADO TRAS VERIFICAR QUE NO EXISTEN PUNTUACIONES DEFINITIVAS
      function continuarProcesoGuardar(id_equipo, division, id_juez) {
        var itemsEspeciales;
        var valorIncorrecto = false;

    // Recorrer todas las puntuaciones excepto las automáticas
        $('input[type="text"].centrado').each(function() {
            if ($(this).hasClass('puntuacion-automatica')) {
                return true;
            }

            var puntuacion = $(this).val();

         // Verificar si la puntuación introducida es válida
            if (!(puntuacion == 1 || puntuacion == 2 || puntuacion == 3 || puntuacion == 4 || puntuacion == 5 || puntuacion == '')) {
                puntuacionesValidas = false;
                valorIncorrecto = true;
                $("#modalValorIncorrecto").css("display", "block");
                return false; // Terminar el proceso si hay un valor incorrecto
            }
          });

      // Si hay un valor incorrecto, salir de la función
          if (valorIncorrecto) {
             return; 
             location.reload();
           }

         // Distinguir items especiales según división
           if (division == "Junior") {
            itemsEspeciales = guardarItemsEspecialesJunior();
           } else if (division == "Senior") {
            itemsEspeciales = guardarItemsEspecialesSenior();
           }
         
         // Si los items especiales están correctos, verificar valor de puntuaciones
           if (itemsEspeciales) {
            $('input[type="text"].centrado').each(function() {
            // Omitir inputs de puntuación automática
            if ($(this).hasClass('puntuacion-automatica')) {
                return true;
            }

            var puntuacion = $(this).val();

            // Si hay puntuaciones vacías y no se ha confirmado su guardado, mostrar modal para confirmar o cancelar guardado
            if (puntuacion === '' && !guardarPuntuacionesVacias) {
                puntuacionesValidas = false;
                $("#modalGuardarVacias").css("display", "block");
                return false;
                }
            });
         } else if (!itemsEspeciales) {
            puntuacionesValidas = false;
            $("#modalItemsEspeciales").css("display", "block");
            return; // Mostrar modal porque los items especiales no están correctos, y detener el proceso de guardado
        }

    // Si las puntuaciones no son válidas y no se ha confirmado guardar puntuaciones vacías, salir de la función
        if(!puntuacionesValidas && !guardarPuntuacionesVacias) {
            return;
        }

    // Si las puntuaciones son válidas o se ha confirmado guardar puntuaciones vacías, enviar las puntuaciones
        if (puntuacionesValidas || guardarPuntuacionesVacias) {
            enviarPuntuaciones(id_equipo, division, id_juez);
        }
    }


    function guardarItemsEspecialesJunior() {
 // Comprobar si se ha puntuado alguno de los 3 primeros items especiales
    var primerosTresLlenos = $('input[data-especial="true"]').slice(0, 3).filter(function() {
        return $(this).val() !== '';
    }).length > 0;

// Comprobar si se ha puntuado alguno de los 3 últimos items especiales
    var ultimosTresLlenos = $('input[data-especial="true"]').slice(3).filter(function() {
        return $(this).val() !== '';
    }).length > 0;

    /* Devolver verdadero si se cumplen alguna de las siguientes condiciones:
        1. Alguno de los 3 primeros items está puntuado y ninguno de los 3 últimos está puntuado.
        2. Ninguno de los 3 primeros items está puntuado y alguno de los 3 últimos está puntuado.
        3. Ninguno de los 3 primeros items y ninguno de los 3 últimos está puntuado. */

    return (primerosTresLlenos && !ultimosTresLlenos) || (!primerosTresLlenos && ultimosTresLlenos) || (!primerosTresLlenos && !ultimosTresLlenos);
}

   function guardarItemsEspecialesSenior() {
    // Comprobar si se ha puntuado alguno de los 4 primeros items especiales
    var primerosCuatroLlenos = $('input[data-especial="true"]').slice(0, 4).filter(function() {
        return $(this).val() !== '';
    }).length > 0;

    // Comprobar si se ha puntuado alguno de los 4 últimos items especiales
    var ultimosCuatroLlenos = $('input[data-especial="true"]').slice(4).filter(function() {
        return $(this).val() !== '';
    }).length > 0;

    /* Devolver verdadero si se cumplen alguna de las siguientes condiciones:
        1. Alguno de los 4 primeros items está puntuado y ninguno de los 4 últimos está puntuado.
        2. Ninguno de los 4 primeros items está puntuado y alguno de los 4 últimos está puntuado.
        3. Ninguno de los 4 primeros items y ninguno de los 4 últimos está puntuado. */

    return (primerosCuatroLlenos && !ultimosCuatroLlenos) || (!primerosCuatroLlenos && ultimosCuatroLlenos) || (!primerosCuatroLlenos && !ultimosCuatroLlenos);
}

    function enviarPuntuaciones(id_equipo, division, id_juez) {
    // Si las puntuaciones no son válidas o no se ha confirmado guardar puntuaciones vacías, salir
    if (!puntuacionesValidas && !guardarPuntuacionesVacias) {
        return;
    }

// Recorrer puntuaciones excepto automáticas
    $('input[type="text"].centrado').each(function() {
        if ($(this).hasClass('puntuacion-automatica')) {
            return true;
        }

        var idItem = $(this).attr('id');
        var puntuacion = $(this).val();
        
   // Solicitud para enviar puntuaciones
        $.ajax({
            type: "POST",
            url: "scripts/guardar-puntuacion.php",
            data: {
                idItem: idItem,
                puntuacion: puntuacion,
                id_equipo: id_equipo,
                division: division,
                id_juez: id_juez
            },
            success: function(response) {
                console.log(response);
            }
        });
    });
    $("#modalPuntuacionGuardada").css("display", "block");
    guardarPuntuacionesVacias = false;
    puntuacionesValidas = false;
}