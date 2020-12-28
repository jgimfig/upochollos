
//Variables globales que guardan la información de los patrocinadores
var PATROCINADORES = []
if(PATROCINADORES.length === 0){
    getPatrocinadores();
}

/*
 * FUNCION: cerrarVentanaAnuncio()
 *      - Recibe un evento JS cuando el usuario pulsa sobre el botón de cerrar ventana
 *      - Cierra la ventana que contiene el formulario de redactar anuncio, quita el blur 
 *        de la pantalla y devuelve la interación normal con la página
 *      - No devuelve nada
 */
function cerrarVentanaAnuncio(event) {
    $("body").children().css({filter: "blur(0rem)", "pointer-events": "auto"});
    $("#ventanaAnuncio").remove();
}

/*
 * FUNCION: validarFormularioAnuncio()
 *      - No recibe parámetro alguno
 *      - Válida los elementos del formulario
 *      - No devuelve nada
 */
function validarFormularioAnuncio() {

    if ($("#titulo").val().length <= 0) {
        siiimpleToast.alert('El anuncio debe tener un título');
        $("#titulo").css({"border-color": "red"});
        return false;
    }

    $("#titulo").css({"border-color": "black"});

    if ($("#fecha_inicio").val().length <= 0) {
        siiimpleToast.alert('Establece una fecha de publicación');
        $("#fecha_inicio").css({"border-color": "red"});
        return false;
    }

    $("#fecha_inicio").css({"border-color": "black"});

    if ($("#cuantia").val().length <= 0 || isNaN($("#cuantia").val())) {
        siiimpleToast.alert('Introduce un precio válido');
        $("#cuantia").css({"border-color": "red"});
        return false;
    }
    $("#cuantia").css({"border-color": "black"});


    if ($("#descripcionAnuncio").val().length <= 0) {
        siiimpleToast.alert('Debes escribir una descripción');
        $("#descripcionAnuncio").css({"border-color": "red"});
        return false;
    }

    $("#descripcionAnuncio").css({"border-color": "black"});

    return true;
}


/*
 * FUNCION: publicarAnuncio()
 *      - Recibe un Evento JS cuando el boton de publicar anuncio es pulsado
 *      - Despliega una ventana con el formulario de publicar anuncio
 *      - No devuelve nada
 */
function publicarAnuncio(event) {

    var selectInput = "<select name='patr'>";

    for (var i = 0; i < PATROCINADORES.length; i++)
    {
        var cif = PATROCINADORES[i][0];
        var nombre = PATROCINADORES[i][1];
        selectInput += "<option value='" + cif + "'>" + nombre + " - " + cif + "</option>";
    }
    selectInput += "</select>";



    $("body").children().css({filter: "blur(1.2rem)", "pointer-events": "none"});

    var ventana = "<div id='ventanaAnuncio'>\n\
                        <button id='cerrar' onclick='cerrarVentanaAnuncio(event)'>\n\
                        <img src='../img/iconos/iconoCerrarVentana.png' alt='Cerrar ventana'/>\n\
                        </button>\n\
                        <div>\n\
                        <h2>Publicar anuncio</h2>";

    ventana += "</div> \n\
                    <form action='subirAnuncio.php' method='post' onsubmit='return validarFormularioAnuncio() id='formSubirAnuncio'>\n\
                            "+selectInput+" \
                            <h3>Título: </h3><input id='titulo' type='text' name='titulo' value='' placeholder='Título'/><br/>\n\
                            <h3>Fecha inicio: </h3><input id='fecha_inicio' type='date' name='fechaInicio' value='' placeholder='Fecha de inicio'/><br/>\n\
                            <h3>Fecha fin: </h3><input id='fecha_fin' type='date' name='fechaFin' value='' placeholder='Fecha de fin'/><br/>\n\
                            <h3>Cuantía: </h3><input id='cuantia' type='number' step='0.01' name='cuantia' value='' placeholder='0.00'/> €<br/>\n\
                            <h3>Descripción: </h3><textarea id=descripcionAnuncio class='textareaDescripcion' name='descripcion' placeholder='Descripción'></textarea><br/>\n\
                            <h3>Contenido multimedia HTML: </h3><textarea class='textareaDescripcion' name='contenidoMultimedia' placeholder='Código HTML'></textarea><br/><br/>\n\
                            <input id='subirAnuncio' type='submit' name='subirAnuncio' value='Subir anuncio'/>\n\
                        </form>\n\
                    </div>";
    $("body").append(ventana);
}


/*
 * FUNCION: crearPatrocinador()
 *      - Recibe un Evento JS cuando el boton de crear patrocinador es pulsado
 *      - Reenvía al usuario a la página correspondiente
 *      - No devuelve nada
 */
function crearPatrocinador(event) {
    window.location.replace("../php/darAltaPatrocinador.php");
}

/*
 * FUNCION: getPatrocinadores()
 *      - No recibe parámetro alguno
 *      - Realiza una conexión con el servidor para recuperar el nombre de los patrocinadores
 *      - Rellena el array global de patrocinadores
 */
function getPatrocinadores() {

    $.ajax({
        url: 'patrocinadores.php',
        data: {},
        type: 'post',
        success: function (respuestas_json) {

            var info = JSON.parse(respuestas_json);

            for (var i = 0; i < (info.length); i++)
            {
                var p = JSON.parse(info[i]);
                var cif = p.cif;
                var nombre = p.nombre;
                PATROCINADORES.push([cif, nombre]);
            }
        }
    });

}