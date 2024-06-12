<script> 

    /*BOTÓN PARA GUARDAR PUNTUACIONES*/
    
 var guardarPuntuacionesVacias = false;

$(document).ready(function() {

    var puntuacionesValidas = true;

    $('#btnGuardar').click(function(e) {
        e.preventDefault();

        var id_equipo = $(this).data('equipo');
        var division = $(this).data('division');
        var id_juez = <?=$id_juez;?>;

           verificarPuntuacionesDefinitivas(id_equipo, division, id_juez);
    });

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

    /* BOTÓN PARA ENVIAR PUNTUACIONES DEFINITIVAS */

$(document).ready(function() {

    $('#btnEnviar').click(function(e) {
        e.preventDefault();
      var id_equipo = $(this).data('equipo');
      var division = $(this).data('division');
      var itemsEspecialesCompletos;


     function validarItemsEspecialesJunior() {
            var llenosPrimerosTres = $('input[data-especial="true"]').slice(0, 3).filter(function() {
                return $(this).val() !== '';
            }).length;

            var llenosUltimosTres = $('input[data-especial="true"]').slice(3).filter(function() {
                return $(this).val() !== '';
            }).length;

            return (llenosPrimerosTres === 3 && llenosUltimosTres === 0) || (llenosPrimerosTres === 0 && llenosUltimosTres === 3);
        }

     function validarItemsEspecialesSenior() {
            var llenosPrimerosCuatro = $('input[data-especial="true"]').slice(0, 4).filter(function() {
                return $(this).val() !== '';
            }).length;

            var llenosUltimosCuatro = $('input[data-especial="true"]').slice(4).filter(function() {
                return $(this).val() !== '';
            }).length;

            return (llenosPrimerosCuatro === 4 && llenosUltimosCuatro === 0) || (llenosPrimerosCuatro === 0 && llenosUltimosCuatro === 4);
        }

        var puntuacionesValidas = true;

        $('input[type="text"].centrado').each(function() {
            if ($(this).hasClass('especial') || $(this).hasClass('puntuacion-automatica')) {
                return true;
            }

            var puntuacion = $(this).val();

            if (puntuacion === '') {
                puntuacionesValidas = false;
                $("#modalPuntuacionesVacias").css("display", "block");
                return false;
            }
        });

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

        if (puntuacionesValidas) {
            $("#modalConfirmarEnviar").css("display", "block");
        }
    });


    $('#btnConfirmarEnviar').click(function(e) {
    e.preventDefault();

    var id_equipo = $('#id_equipo').val();
    var division = $('#division').val();
    var alertMostrado = false;
    var existenRegistros = false;
    var puntuacionGuardada = false;
    var noRegistrado = false;
    var puntuaciones = {};


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
                totalGeneral: totalGeneral,
                totalCategoria1: totalCategoria1,
                totalCategoria2: totalCategoria2,
                totalCategoria3: totalCategoria3,
                totalCategoria4: totalCategoria4,
                totalCategoria5: totalCategoria5
            },
            success: function(response) {
                console.log(response);

                if (!existenRegistros && response === "existenRegistros") {
                    $("#modalExistenRegistros").css("display", "block");
                    existenRegistros = true;
                } else if (!puntuacionGuardada && response === "puntuacionGuardada") {
                    $("#modalEnviadas").css("display", "block");
                    puntuacionGuardada = true;
                } else if (!noRegistrado && response === "noRegistrado") {
                    $("#modalNoRegistrado").css("display", "block");
                    noRegistrado = true;
                } else if ("puntuacionesDefinitivas") {
                    $("#modalPuntuacionDefinitiva").css("display", "block");
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