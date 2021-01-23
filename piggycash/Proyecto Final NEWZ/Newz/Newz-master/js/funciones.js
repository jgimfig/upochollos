
/*
 * FUNCION: eliminarTematica()
 *      - Recibe un evento JS cuando el botón de eliminar temática es pulsado
 *      - Envía al servidor la información pertinente para desvincular 
 *        la temática del usuario.
 *      - No devuelve nada
 */
function eliminarTematica(event) {
    var id = event.target.id;
    id = id.split("_");
    id = id[1];
    var mensajero = document.createElement("form");
    mensajero.setAttribute("action", "tablon.php");
    mensajero.setAttribute("method", "post");
    var variableAEnviar = document.createElement("input");
    variableAEnviar.setAttribute("type", "hidden");
    variableAEnviar.setAttribute("name", "tematicaAEliminar");
    variableAEnviar.setAttribute("value", id);
    mensajero.appendChild(variableAEnviar);
    document.body.appendChild(mensajero);
    mensajero.submit();
    document.body.removeChild(mensajero);
}


/*
 * FUNCION: aniadirTematica()
 *      - Recibe un evento JS cuando el botón de añadir temática es pulsado
 *      - Envía al servidor la información pertinente para vincular 
 *        la temática al usuario.
 *      - No devuelve nada
 */
function aniadirTematica(event) {
    var id = event.target.id;
    id = id.split("_");
    id = id[1];
    var mensajero = document.createElement("form");
    mensajero.setAttribute("action", "aniadirCategoria.php");
    mensajero.setAttribute("method", "post");
    var variableAEnviar = document.createElement("input");
    variableAEnviar.setAttribute("type", "hidden");
    variableAEnviar.setAttribute("name", "tematicaAAniadir");
    variableAEnviar.setAttribute("value", id);
    mensajero.appendChild(variableAEnviar);
    document.body.appendChild(mensajero);
    mensajero.submit();
    document.body.removeChild(mensajero);
}

/*
 * FUNCION: meGusta()
 *      - Recibe un evento JS cuando el botón de 'Me gusta' de una noticia es 
 *        pulsado
 *      - Envía al servidor la información pertinente para registrar que 
 *        el usuario ha indicado que le gusta la noticia
 *      - No devuelve nada
 */
function meGusta(event) {
    var id = event.target.id;
    var datos = id.split("_");
    id = datos[1];
    var puntos = parseInt(datos[2]) + 1;
    $.post("puntuar.php", {id_noticia: id, puntuacion: 1}, function () {
        $("#puntos_" + id).find(".numPuntos").text(puntos + "");
        eliminaBotonesPuntuar(id, puntos - 1);
    });
}



/*
 * FUNCION: noMeGusta()
 *      - Recibe un evento JS cuando el botón de 'No me gusta' de una noticia es 
 *        pulsado
 *      - Envía al servidor la información pertinente para registrar que 
 *        el usuario ha indicado que NO le gusta la noticia
 *      - No devuelve nada
 */
function noMeGusta(event) {
    var id = event.target.id;
    var datos = id.split("_");
    id = datos[1];
    var puntos = parseInt(datos[2]) - 1;
    $.post("puntuar.php", {id_noticia: id, puntuacion: -1}, function () {
        $("#puntos_" + id).find(".numPuntos").text(puntos + "");
        eliminaBotonesPuntuar(id, puntos + 1);
    });
}

/*
 * FUNCION: eliminaBotonesPuntuar()
 *      - Recibe el id de una noticia y los puntos que tiene 
 *      -  borra de la pantalla los botones de 'me gusta' y 'no me gusta'
 *      - No devuelve nada
 */
function eliminaBotonesPuntuar(id, puntos) {
    $("#botonMeGusta_" + id + "_" + puntos).remove();
    $("#botonNoMeGusta_" + id + "_" + puntos).remove();
}

/*
 * FUNCION: guardarNoticia()
 *      - Recibe un evento JS cuando el botón de 'Guardar noticia' de una noticia es 
 *        pulsado
 *      - Envía al servidor la información pertinente para registrar que 
 *        el usuario ha indicado que desea guardar la noticia.
 *      - No devuelve nada
 */
function guardarNoticia(event) {
    var id = event.target.id;
    var datos = id.split("_");
    id = datos[1];

    $.post("guardarNoticia.php", {id_noticia: id}, function () {
        siiimpleToast.success('Noticia guardada');
    });
}


/*
 * FUNCION: compartirNoticia()
 *      - Recibe un evento JS cuando el botón de 'Compartir' de una noticia es 
 *        pulsado
 *      - Hace las llamadas pertinentes al plugin ayoshare para compartir la noticia
 *      - No devuelve nada
 */
function compartirNoticia(event) {
    var id = event.target.id;
    var datos = id.split("_");
    id = datos[1];

    var enlace = $('#titulo_noticia_' + id).find('a').attr('href');

    $('#botonCompartir_' + id).replaceWith("<div id='anu_" + id + "' class='anu' data-ayoshare='" + enlace + "'></div>");

    $(".anu").ayoshare({
        counter: false,
        button: {
            google: false,
            facebook: true,
            pinterest: false,
            linkedin: true,
            twitter: true,
            flipboard: false,
            email: false,
            whatsapp: true,
            telegram: true,
            line: true,
            bbm: false,
            viber: false,
            sms: false
        }
    });

    $(".ayoshare").children().css({"font-size": "25pt"});

    setTimeout(function () {
        $('#anu_' + id).replaceWith("<button id='botonCompartir_" + id + "' type='button' name='botonCompatir' value='compartir' class='boton' title='Compartir' onclick='compartirNoticia(event)'><img id='imgBotonCompartir_'" + id + "' src='../img/iconos/iconoCompartir.svg' alt='compartir'/></button>");
    }, 10000);
}

/*
 * FUNCION: comentarNoticia()
 *      - Recibe un evento JS cuando el un comentario se publicó
 *      - Recarga la ágina
 *      - No devuelve nada
 */
function comentarNoticia(event) {
    var id = event.target.id.split('_')[1];
    window.location.replace('../php/paginaNoticia.php?id=' + id);
}


/*
 * FUNCION: enviarComentario()
 *      - Recibe un evento JS cuando el botón de publicar un comentario se pulsó
 *      - Envía al servidor el texto del comentario y el id de la notica comentada
 *      - No devuelve nada
 */
function enviarComentario(event) {
    var id = event.target.id;
    var datos = id.split("_");
    id = datos[2];

    var texto = $("#escribirComentario").val();

    if (texto.length > 0) {
        $.post("enviarComentario.php", {id_noticia: id, texto_comentario: texto}, function () {
            window.location.replace('../php/paginaNoticia.php?id=' + id);
        });
    } else {
        siiimpleToast.alert('El comentario no puede estar vacío');
    }
}


/*
 * FUNCION: responder()
 *      - Recibe un evento JS cuando el botón de responder a un comentario se pulsó
 *      - Muestra un textarea y un botón para que el usuario pueda escribir su respuesta
 *      - No devuelve nada
 */
function responder(event) {
    var id = event.target.id;
    var datos = id.split("_");
    id = datos[1];
    var id_noticia = datos[2];

    $(".respuestaComentario").remove();
    $("#comentario_" + id).after("<div class='respuestaComentario'><textarea id='escribirComentario_" + id + "' class='noticia estiloRespuesta' placeholder='Escribe un comentario...'></textarea><button id='boton_comentario_" + id_noticia + "_" + id + "' class='boton' onclick='enviarRespuesta(event)'>Enviar</button></div>");

    var margenPadre = parseInt($("#comentario_" + id).css("margin-left"), 10);

    margenPadre = margenPadre * 1.5;

    $(".respuestaComentario").css({"margin-left": margenPadre + "px", "padding-top": "0"});
}

/*
 * FUNCION: enviarRespuesta()
 *      - Recibe un evento JS cuando el botón de publicar una respuesta a un comentario se pulsó
 *      - Envía al servidor el texto del comentario, el id de la notica comentada y el id del comentario
 *        al que se pretende responder
 *      - No devuelve nada
 */
function enviarRespuesta(event) {
    var id = event.target.id;
    var datos = id.split("_");
    var id_noticia = datos[2];
    var id_comentario = datos[3];

    var texto = $("#escribirComentario_" + id_comentario).val();

    $.post("enviarComentario.php", {id_noticia: id_noticia, id_comentario: id_comentario, texto_comentario: texto}, function () {
        window.location.replace('../php/paginaNoticia.php?id=' + id_noticia);
    });
}


/*
 * FUNCION: mostrarRespuestas()
 *      - Recibe un evento JS cuando el botón de publicar una respuesta a un comentario se pulsó
 *      - Envía al servidor la petición pertinente. Y recibe de él las respuestas al comentario seleccionado
 *      - No devuelve nada
 */
function mostrarRespuestas(event) {
    var id = event.target.id;
    var datos = id.split("_");
    var id_noticia = datos[2];
    var id_comentario = datos[3];

    $.ajax({
        url: 'mostrarRespuestas.php',
        data: {id_noticia: id_noticia, id_comentario: id_comentario},
        type: 'post',
        success: function (respuestas_json) {
            var respuestas = JSON.parse(respuestas_json);

            var margenPadre = parseInt($("#comentario_" + id_comentario).css("margin-left"), 10);

            margenPadre = margenPadre * 1.5;

            for (var i = 0; i < respuestas.length; i++) {
                var respuesta = JSON.parse(respuestas[i]);

                var id_coment = respuesta.id;
                var texto = respuesta.texto;
                var fecha = respuesta.fecha;
                var autor = respuesta.autor;
                var id_not = respuesta.id_noticia;
                var responde = respuesta.responde;
                var imagenAutor = respuesta.imagenAutor;
                var numRespuestas = respuesta.numRespuestas;

                var botonRespuestas = "";
                if (numRespuestas > 0) {
                    botonRespuestas = "<button id='boton_verRespuestas_" + id_not + "" + '_' + "" + id_coment + "' class='boton botonVerRespuestas' onclick='mostrarRespuestas(event)'>Ver respuestas</button>";
                }

                $("#comentario_" + id_comentario).after("<article id='comentario_" + id_coment + "' class ='comentario respuesta'>\n\
                                            <div class='datosNoticia'>\n\
                                            <div class='infoUsuario'>\n\
                                            <figure><img src='" + imagenAutor + "' alt='imagen perfil usuario'/></figure>\n\
                                            <h4>" + autor + " - " + fecha + "</h4>\n\
                                            </div>\n\
                                            </div>\n\
                                            <div class='textoComentario'>\n\
                                            <p>" + texto + "</p>\n\
                                            </div>\n\
                                            <div class='grupoBotones'>\n\
                                            <button id='botonResponder_" + id_coment + "" + '_' + "" + id_not + "' type='button' name='botonResponder' value='responder' class='boton botonResponder' title='Responder' onclick='responder(event)'> \n\
                                            <img id='imgBotonResponder_" + id_coment + "" + '_' + "" + id_not + "' src='../img/iconos/iconoResponder.png' alt='responder'/>\n\
                                            </button>\n\
                                            " + botonRespuestas + "\n\
                                            </div>\n\
                                            </article>");

                if (margenPadre === 0) {
                    $("#comentario_" + id_coment).css({"margin-left": "3em"});
                } else {
                    $("#comentario_" + id_coment).css({"margin-left": margenPadre + "px"});
                }
            }

            $("#boton_verRespuestas_" + id_noticia + "" + '_' + "" + id_comentario + "").remove();
        }
    });
}


/*
 * FUNCION: fakeNews()
 *      - Recibe un evento JS cuando el botón de 'FakeNews' de una noticia se pulsó
 *      - Envía al servidor la petición del usuario de marcar como fake
 *      - No devuelve nada
 */
function fakeNews(event) {
    var id = event.target.id;
    var datos = id.split("_");
    id = datos[1];

    $.post("marcarFakeNews.php", {id_noticia: id}, function () {
        siiimpleToast.alert('Noticia marcada como fake news');
        eliminaBotonFakeNews(id);
    });
}

/*
 * FUNCION: eliminaBotonFakeNews()
 *      - Recibe el id de un botón de 'FakeNews' de una noticia
 *      - Elimina dicho botón de la pantalla
 *      - No devuelve nada
 */
function eliminaBotonFakeNews(id) {
    $("#botonFakeNews_" + id).remove();
}

/*
 * FUNCION: borrarAnuncio()
 *      - Recibe un evento JS de un botón para eliminar un anuncio
 *      - Manda al servidor la información necesaria para eliminarlo
 *       - No devuelve nada
 */
function borrarAnuncio(event){
    
    var id = event.target.id;
    var titulo = id.split("_")[0];
    var fecha = id.split("_")[1];
    
    $.post("eliminarAnuncio.php", {titulo_noticia: titulo, fecha_noticia:fecha}, function () {
        window.location.replace("../index.php");
    });
}


function eliminarNoticia(event){
    
    var id = event.target.id.split("_")[1];
    $.post("eliminarNoticia.php", {id_noticia:id}, function () {
        window.location.replace("../index.php");
    });
    
}

function eliminarComentario(event){
    
    var id = event.target.id.split("_")[1];
    $.post("eliminarComentario.php", {id_comentario:id}, function () {
        window.location.reload();
    });
    
}