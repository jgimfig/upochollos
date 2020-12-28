
/*
 * FUNCION: cerrarVentana()
 *      - Recibe un evento JS cuando el usuario pulsa sobre el botón de cerrar ventana
 *      - Cierra la ventana que contiene el formulario de redactar noticia, quita el blur 
 *        de la pantalla y devuelve la interación normal con la página
 *      - No devuelve nada
 */
function cerrarVentana(event) {
    $("body").children().css({filter: "blur(0rem)", "pointer-events": "auto"});
    $("#ventanaRedaccion").remove();
}


/*
 * FUNCION: validarFormulario()
 *      - No recibe parámetro alguno
 *      - Valida los campos del formulario de enviar noticia
 *      - Un booleano
 */
function validarFormulario() {

    if ( $("#enlace").val().length <= 0 ) {
        siiimpleToast.alert('Enlace incorrecto');
        $("#enlace").css({"border-color": "red"});
        return false;
    }

    $("#enlace").css({"border-color": "black"});

    if ( $("#titulo").val().length <= 0 ) {
        siiimpleToast.alert('Titulo incorrecto');
        $("#titulo").css({"border-color": "red"});
        return false;
    }
    
    $("#titulo").css({"border-color": "black"});

    if ($("#textareaDescripcion").val().length <= 0) {
        siiimpleToast.alert('Descripción incorrecta');
        $("#textareaDescripcion").css({"border-color": "red"});
        return false;
    }
    $("#textareaDescripcion").css({"border-color": "black"});

    return true;
}


/*
 * FUNCION: redactar()
 *      - Recibe un evento JS cuando el usuario se situa encima del textarea para publicar una noticia
 *      - APLICA UN EFECTO DE BLUR A TODA LA PÁGINA, DESHABILITA TODA INTERACCIÓN POSIBLE
 *        Y MUESTRA UNA VENTANA EMERGENTE CON EL FORMULARIO PARA ENVIAR UNA NOTICIA
 *      - No devuelve nada
 */
function redactar(event) {
    $("body").children().css({filter: "blur(1.2rem)", "pointer-events": "none"});
    $("body").append("<div id='ventanaRedaccion'>\n\
                        <button id='cerrarVentana' onclick='cerrarVentana(event)'>\n\
                        <img src='../img/iconos/iconoCerrarVentana.png' alt='Cerrar ventana'/>\n\
                        </button>\n\
                        <h2>Publicar noticia</h2>\n\
                        <form action='redactarNoticia.php' method='post' onsubmit='return validarFormulario()'>\n\
                            <h3>Enlace: </h3><input id='enlace' type='text' name='enlace' value='' placeholder='Enlace'/><br/>\n\
                            <h3>Titulo: </h3><input id='titulo' type='text' name='titulo' value='' placeholder='Titulo'/><br/>\n\
                            <h3>Descripción: </h3><textarea id='textareaDescripcion' name='descripcion' placeholder='Descripción'></textarea><br/>\n\
                            <input id='subirNoticia' type='submit' name='subirNoticia' value='Subir noticia'/>\n\
                        </form>\n\
                    </div>");
}



