
/*
 * CUANDO EL DOCUMENTO ESTÉ CARGADO
 */
$(document).ready(function () {

    /*
     * CUANDO SE SUBA UN NUEVA FOTO, SE PODRÁ EN LA PAGINA DE AJUSTES
     * COMO IMAGEN TEMPORAL Y ASÍ DARLE MEJOR FEEDBACK AL USUARIO
     */
    $("#fotoPerfil").change(function () {
        cargarImagenTemporal(this);
    });

    /*
     * CUANDO SE SUBA UNA NUEVA FOTO, SE VALIDARÁ
     */
    $("#fotoPerfil").fileValidator({
        onInvalid: function (validationType, file) {
            siiimpleToast.alert('La foto no puede tener un tamaño superior a 2MB');
            siiimpleToast.alert('Debes subir una imagen');
            setTimeout(function(){
                location.reload();
            }, 1000);
        },
        maxSize: '2m',
        type: 'image',
    });


    /*
     * OCULTAMOS EL INPUT DE SUBIR FOTO DE PERFIL
     * Y LE DAMOS ESA INTERACCIÓN A IMAGEN DE FOTO DE PERFIL
     */
    $("#fotoPerfilActual").find("img").click(function () {
        $("#fotoPerfil").trigger('click');
    });
    $("#fotoPerfil").hide();

    /*
     * CARGAMOS EL SELECTOR DE FUENTES
     */
    getFuentes();
});


/*
 * DADO UN CAMPO DE TIPO INPUT, SE MUESTRA LA IMAGEN SUBIDA A MODO DE EJMPLO ANTES DE SUBIRSE
 */
function cargarImagenTemporal(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgActual').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


/*
 * HACE UNA LLAMADA AL SERVIDOR VÍA AJAX Y RESCATA TODAS LAS FUENTES
 * LAS QUE ESTÉN HABILITADAS SE MOSTRARÁN CON EL INTERRUPTOR ENCENDIDO Y VICEVERSA
 */
function getFuentes() {
    $.ajax({
        url: 'fuentes.php',
        data: {},
        type: 'post',
        success: function (respuestas_json) {
            var fuentes = JSON.parse(respuestas_json);

            if (fuentes.length > 0) {
                $("#contenedorFuentes").empty();
            }

            $("#contenedorFuentes").append("<h3>Fuentes</h3>");

            for (var i = 0; i < fuentes.length; i++) {
                var fuente = JSON.parse(fuentes[i]);
                var nombre_fuente = fuente.nombre_fuente;
                var seleccionada = fuente.seleccionada;

                if (seleccionada) {
                    $("#contenedorFuentes").append("<div class='activarFuente'><p>" + nombre_fuente + "</p><input name='nombreFuente' type='checkbox' id='" + nombre_fuente + "' onclick='seleccionarFuente(event)' checked/></div>");
                } else {
                    $("#contenedorFuentes").append("<div class='activarFuente'><p>" + nombre_fuente + "</p><input name='nombreFuente' type='checkbox' id='" + nombre_fuente + "' onclick='seleccionarFuente(event)'/></div>");
                }
            }
            $.switcher('input[type=checkbox]');
        }
    });
}


/*
 * CUANDO PULSAMOS SOBRE EL INTERRUPTOR DE UNA FUENTE, ESTA DISPARA UN EVENTO
 * Y ENVÍA VIA AJAX LA FUENTE SELECCIONADA. EL SERVIDOR SE ENCARGARÁ DE 
 * HABILITARLA/DESHABILITARLA
 */
function seleccionarFuente(event) {
    var id = event.target.id;
    $.ajax({
        url: 'seleccionarFuentes.php',
        data: {nombre_fuente: id},
        type: 'post',
        success: function (respuestas_json) {
        }
    });
}

