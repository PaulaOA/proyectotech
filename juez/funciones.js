     
   function verificarPuntuacionesDefinitivas(id_equipo, division, id_juez) {
        $.ajax({
            type: "POST",
            url: "scripts/verificar-puntuaciones-definitivas.php",
            data: { id_equipo: id_equipo,
                    division: division,
                    id_juez: id_juez
                  },
            success: function(response) {
                if (response === "sinRegistros") {
                    continuarProcesoGuardar(id_equipo, division, id_juez);
                } else {
                    $("#modalPuntuacionDefinitiva").css("display", "block");
                }
            }
        });
    }

      function continuarProcesoGuardar(id_equipo, division, id_juez) {
        var itemsEspeciales;
        var valorIncorrecto = false;

        $('input[type="text"].centrado').each(function() {
            if ($(this).hasClass('puntuacion-automatica')) {
                return true;
            }

            var puntuacion = $(this).val();

            if (!(puntuacion == 1 || puntuacion == 2 || puntuacion == 3 || puntuacion == 4 || puntuacion == 5 || puntuacion == '')) {
                puntuacionesValidas = false;
                valorIncorrecto = true;
                $("#modalValorIncorrecto").css("display", "block");
                return false;
            }
          });

          if (valorIncorrecto) {
             return; 
             location.reload();
           }

           if(division == "Junior") {
            itemsEspeciales = guardarItemsEspecialesJunior();
           } else if (division == "Senior") {
            itemsEspeciales = guardarItemsEspecialesSenior();
           }

           if (itemsEspeciales) {
            $('input[type="text"].centrado').each(function() {
            if ($(this).hasClass('puntuacion-automatica')) {
                return true;
            }

            var puntuacion = $(this).val();

            if (puntuacion === '' && !guardarPuntuacionesVacias) {
            puntuacionesValidas = false;
            $("#modalGuardarVacias").css("display", "block");
            return false;

            }

        });
         } else if (!itemsEspeciales) {
            puntuacionesValidas = false;
            $("#modalItemsEspeciales").css("display", "block");
            return;
        }

        if(!puntuacionesValidas && !guardarPuntuacionesVacias) {
            return;
        }

        if (puntuacionesValidas || guardarPuntuacionesVacias) {
            enviarPuntuaciones(id_equipo, division, id_juez);
        }
    }


    function guardarItemsEspecialesJunior() {
    var primerosTresLlenos = $('input[data-especial="true"]').slice(0, 3).filter(function() {
        return $(this).val() !== '';
    }).length > 0;

    var ultimosTresLlenos = $('input[data-especial="true"]').slice(3).filter(function() {
        return $(this).val() !== '';
    }).length > 0;

    var primerosTresVacios = $('input[data-especial="true"]').slice(0, 3).filter(function() {
        return $(this).val() === '';
    }).length === 3;

    var ultimosTresVacios = $('input[data-especial="true"]').slice(3).filter(function() {
        return $(this).val() === '';
    }).length === 3;

    return (primerosTresLlenos && !ultimosTresLlenos) || (!primerosTresLlenos && ultimosTresLlenos) || (primerosTresVacios && ultimosTresVacios);
}

   function guardarItemsEspecialesSenior() {
    var primerosCuatroLlenos = $('input[data-especial="true"]').slice(0, 4).filter(function() {
        return $(this).val() !== '';
    }).length > 0;

    var ultimosCuatroLlenos = $('input[data-especial="true"]').slice(4).filter(function() {
        return $(this).val() !== '';
    }).length > 0;

    var primerosCuatroVacios = $('input[data-especial="true"]').slice(0, 4).filter(function() {
        return $(this).val() === '';
    }).length === 4;

    var ultimosCuatroVacios = $('input[data-especial="true"]').slice(4).filter(function() {
        return $(this).val() === '';
    }).length === 4;

    return (primerosCuatroLlenos && !ultimosCuatroLlenos) || (!primerosCuatroLlenos && ultimosCuatroLlenos) || (primerosCuatroVacios && ultimosCuatroVacios);
}

        function enviarPuntuaciones(id_equipo, division, id_juez) {
        if (!puntuacionesValidas && !guardarPuntuacionesVacias) {
            return;
        }

        $('input[type="text"].centrado').each(function() {
            if ($(this).hasClass('puntuacion-automatica')) {
                return true;
            }

            var idItem = $(this).attr('id');
            var puntuacion = $(this).val();

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