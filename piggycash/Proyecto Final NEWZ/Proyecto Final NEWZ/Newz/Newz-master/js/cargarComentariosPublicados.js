/*
 * VARIABLES GLOBALES PARA CONTROLAR LA EJECUCIÓN DE LA CARGA PROGRESIVA DE COMENTARIOS
 */
var EJECUTA_COMENTARIOS_PUBLICADOS = true;
var DETECTAR_SCROLL_COMENTARIOS_PUBLICADOS = true;

/*
 * CUANDO SE TERMINE DE CARGAR EL DOCUMENTO
 * 
 * SE CARGARÁ LA PRIMERA TANDA DE COENTARIOS Y SE HABILITARÁ LA DETECCIÓN DE 
 * LA PANTALLA DE CARGA. 
 * 
 * CUANDO LA ANIMACIÓN DE CARGA SE MUESTRE EN PANTALLA, SE CARGARÁN NUEVOS COMENTARIOS
 * SI NO HAY NINGUNO MÁS, SE DETIENE LA CARGA.
 */
$(document).ready(function () {
    getComentariosServidor();
    $(window).scroll(function () {
        if (DETECTAR_SCROLL_COMENTARIOS_PUBLICADOS) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elemTop = $("#cargarComentarios").offset().top;
            var elemBottom = elemTop + $("#cargarComentarios").height();

            if ((elemBottom <= docViewBottom) && (elemTop >= docViewTop)) {
                if (EJECUTA_COMENTARIOS_PUBLICADOS) {
                    getComentariosServidor();
                    EJECUTA_COMENTARIOS_PUBLICADOS = false;
                }
            } else {
                EJECUTA_COMENTARIOS_PUBLICADOS = true;
            }
        }
    });
});

//OBTENEMOS LA SIGUIENTE TANDA DE COMENTARIOS DEL SERVIDOR
function getComentariosServidor() {
    var comentariosCargados = parseInt($("#cargarComentarios").find("figure")[0].id);

    $.ajax({
        url: 'comentariosPublicados.php',
        data: {comentarios_cargados: comentariosCargados},
        type: 'post',
        success: function (respuestas_json) {
            var comentarios = JSON.parse(respuestas_json);

            if (comentarios.length > 0) {
                for (var i = 0; i < comentarios.length; i++) {
                    var comentario = JSON.parse(comentarios[i]);
                    cargarComentario(comentario); //CUANDO SE RESCATE LA INFORMACION DE UN COMENTARIO, LO MOSTRAMOS
                }

                $("#cargarComentarios").find("figure")[0].id = comentariosCargados + comentarios.length;

            } else {
                $("#cargarComentarios").remove();
                EJECUTA_COMENTARIOS_PUBLICADOS = false;
                DETECTAR_SCROLL_COMENTARIOS_PUBLICADOS = false;
            }
        }
    });
}

//MOSTRAMOS UN COMENTARIO EN LA PÁGINA
function cargarComentario(comentario) {
    var id = comentario.id;
    var texto = comentario.texto;
    var fecha_comentario = comentario.fecha_comentario;
    var autor = comentario.autor;
    var id_noticia = comentario.id_noticia;
    var responde = comentario.responde;
    var urlImagen = comentario.urlImagen;

    var stringComentario = "<article id='comentario_" + id + "' class ='comentario'>\n\
                            <div class='datosNoticia'>\n\
                            <div class='infoUsuario'>\n\
                            <figure><img src='" + urlImagen + "' alt='imagen perfil usuario'/></figure>\n\
                            <h4>" + autor + " - " + fecha_comentario + "'</h4>\n\
                            </div>\n\
                            </div>\n\
                            <div class='textoComentario'>\n\
                            <p>" + texto + "</p>\n\
                            </div>\n\
                            <div class='grupoBotones'>\n\
                            <a class='enlaceNoticia' href='../php/paginaNoticia.php?id="+id_noticia+"'>Ver noticia original\n\
                            </a>\n\
                            </div>\n\
                            </article>";

    $("#cargarComentarios").before(stringComentario);
}

