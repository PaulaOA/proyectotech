<script> 

 var guardarPuntuacionesVacias = false;

$(document).ready(function() {

    var puntuacionesValidas = true;

  // BOTÓN PARA GUARDAR PUNTUACIONES PROVISIONALES

    $('#btnGuardar').click(function(e) {
        e.preventDefault();

        var id_equipo = $(this).data('equipo');
        var division = $(this).data('division');
        var id_juez = <?=$id_juez;?>;
           
           // Antes de guardar, verificar que el equipo no cuente ya con puntuaciones definitivas
           verificarPuntuacionesDefinitivas(id_equipo, division, id_juez);
    });

   // Confirmar que se desean guardar las puntuaciones a pesar de haber items sin puntuar 
    $("#btnConfirmarGuardar").click(function() {
        $("#modalGuardarVacias").css("display", "none");
        guardarPuntuacionesVacias = true;
        $('#btnGuardar').trigger('click');
    });
        $(".close-modal").click(function(){
    $(".modal").css("display", "none");
});
});

</script>

<script>

    // BOTÓN PARA ENVIAR PUNTUACIONES DEFINITIVAS

$(document).ready(function() {

    $('#btnEnviar').click(function(e) {
        e.preventDefault();

      var id_equipo = $(this).data('equipo');
      var division = $(this).data('division');
      var id_juez = <?=$id_juez;?>;
      var itemsEspecialesCompletos;

        var puntuacionesValidas = true;
       
       // Comprobar las puntuaciones a excepción de las de categoría 'especial' o 'puntuación automática'
        $('input[type="text"].centrado').each(function() {
            if ($(this).hasClass('especial') || $(this).hasClass('puntuacion-automatica')) {
                return true;
            }

            var puntuacion = $(this).val();
            
            // Si existen puntuaciones vacías, mostrar modal y detener el proceso
            if (puntuacion === '') {
                puntuacionesValidas = false;
                $("#modalPuntuacionesVacias").css("display", "block");
                return false;
            }
        });

      // Diferenciar items especiales en función de división Junior o Senior
        if(puntuacionesValidas) {
            if (division == "Junior") {
                itemsEspecialesCompletos = validarItemsEspecialesJunior();
            } else if (division == "Senior") {
             itemsEspecialesCompletos = validarItemsEspecialesSenior();
            }
            if (!itemsEspecialesCompletos) {
                puntuacionesValidas = false;
                $("#modalItemsEspecialesIncompletos").css("display", "block");
                return;
            }
        }

       // Si no existen puntuaciones vacías y los items especiales están correctos, comprobar valor introducido
        if (puntuacionesValidas) {
            $('input[data-especial="true"]').each(function() {

                var puntuacion = $(this).val();

                if (!(puntuacion == '' || puntuacion == 1 || puntuacion == 2 || puntuacion == 3 || puntuacion == 4 || puntuacion == 5)) {
                    puntuacionesValidas = false;
                    $("#modalValorIncorrecto").css("display", "block");
                    return false;
                }
            });
        } 

        if (puntuacionesValidas) {
            $('input[type="text"].centrado').each(function() {
                if ($(this).hasClass('especial') || $(this).hasClass('puntuacion-automatica')) {
                    return true;
                }

                var puntuacion = $(this).val();

                if (!(puntuacion == 1 || puntuacion == 2 || puntuacion == 3 || puntuacion == 4 || puntuacion == 5)) {
                    puntuacionesValidas = false;
                    $("#modalValorIncorrecto").css("display", "block");
                    return false;
                }
            });
        }

        // Si se comprueba que las puntuaciones introducidas son válidas en su totalidad, mostrar modal de confirmación
        if (puntuacionesValidas) {
            $("#modalConfirmarEnviar").css("display", "block");
        }

        function validarItemsEspecialesJunior() {
            // Comprobar si los 3 primeros items especiales están puntuados
            var llenosPrimerosTres = $('input[data-especial="true"]').slice(0, 3).filter(function() {
                return $(this).val() !== '';
            }).length;
            
            // Comprobar si los 3 últimos items especiales están puntuados
            var llenosUltimosTres = $('input[data-especial="true"]').slice(3).filter(function() {
                return $(this).val() !== '';
            }).length;

            // Devolver true solo si se cumple que los 3 primeros items están puntuados en su totalidad y los 3 últimos vacíos o viceversa
            return (llenosPrimerosTres === 3 && llenosUltimosTres === 0) || (llenosPrimerosTres === 0 && llenosUltimosTres === 3);
        }

        function validarItemsEspecialesSenior() {
            // Comprobar si los 4 primeros items especiales están puntuados
            var llenosPrimerosCuatro = $('input[data-especial="true"]').slice(0, 4).filter(function() {
                return $(this).val() !== '';
            }).length;

            // Comprobar si los 4 últimos items especiales están puntuados
            var llenosUltimosCuatro = $('input[data-especial="true"]').slice(4).filter(function() {
                return $(this).val() !== '';
            }).length;

            // Devolver true solo si se cumple que los 4 primeros items están puntuados en su totalidad y los 4 últimos vacíos o viceversa
            return (llenosPrimerosCuatro === 4 && llenosUltimosCuatro === 0) || (llenosPrimerosCuatro === 0 && llenosUltimosCuatro === 4);
        }
    });

    // BOTÓN PARA CONFIRMAR EL ENVÍO DE PUNTUACIONES DEFINITIVAS
    $('#btnConfirmarEnviar').click(function(e) {
    e.preventDefault();

    var id_equipo = $('#id_equipo').val();
    var division = $('#division').val();
    var id_juez = <?=$id_juez;?>;
    var puntuaciones = {};

    // Puntuaciones totales por categoría y total general
    var totalGeneral = $('#totalGeneral').val();
    var totalCategoria1 = $('#totalCategoria1').val();
    var totalCategoria2 = $('#totalCategoria2').val();
    var totalCategoria3 = $('#totalCategoria3').val();
    var totalCategoria4 = $('#totalCategoria4').val();
    var totalCategoria5 = $('#totalCategoria5').val();

        $('input[type="text"].centrado').each(function() {
        if (!$(this).hasClass('puntuacion-automatica')) {
            var id = $(this).attr('id');
            var value = $(this).val();
            puntuaciones[id] = value;
        }
    });

        $.ajax({
            type: "POST",
            url: "scripts/enviar-puntuacion.php",
            data: {
                puntuaciones: puntuaciones,
                id_equipo : id_equipo,
                division : division,
                id_juez: id_juez,
                totalGeneral: totalGeneral,
                totalCategoria1: totalCategoria1,
                totalCategoria2: totalCategoria2,
                totalCategoria3: totalCategoria3,
                totalCategoria4: totalCategoria4,
                totalCategoria5: totalCategoria5
            },
            success: function(response) {
                console.log(response);

                if (response === "puntuacionGuardada") {
                    $("#modalEnviadas").css("display", "block"); // Envío correcto de puntuaciones
                } else if ("puntuacionesDefinitivas") {
                    $("#modalPuntuacionDefinitiva").css("display", "block"); // Ya existen puntuaciones definitivas para ese equipo y juez
                } else {
                    alert ("Error");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
   });
    $(".close-modal").click(function(){
    $(".modal").css("display", "none");
 });
});

</script>