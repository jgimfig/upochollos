/*
 * VARIABLES GLOBALES PARA CONTROLAR LA EJECUCIÓN DE LA CARGA PROGRESIVA DE NOTICIAS
 */
var EJECUTA_NOTICIAS_GUARDADAS = true;
var DETECTAR_SCROLL_NOTICIAS_GUARDADAS = true;

/*
 * CUANDO SE TERMINE DE CARGAR EL DOCUMENTO
 * 
 * SE CARGARÁ LA PRIMERA TANDA DE NOTICIAS Y SE HABILITARÁ LA DETECCIÓN DE 
 * LA PANTALLA DE CARGA. 
 * 
 * CUANDO LA ANIMACIÓN DE CARGA SE MUESTRE EN PANTALLA, SE CARGARÁN NUEVAS NOTICIAS
 * SI NO HAY NINGUNA MÁS, SE DETIENE LA CARGA.
 */
$(document).ready(function () {
    getNoticiasGuardadasServidor();
    $(window).scroll(function () {
        if (DETECTAR_SCROLL_NOTICIAS_GUARDADAS) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elemTop = $("#cargarNoticiasGuardadas").offset().top;
            var elemBottom = elemTop + $("#cargarNoticiasGuardadas").height();

            if ((elemBottom <= docViewBottom) && (elemTop >= docViewTop)) {
                if (EJECUTA_NOTICIAS_GUARDADAS) {
                    getNoticiasGuardadasServidor();
                    EJECUTA_NOTICIAS_GUARDADAS = false;
                }
            } else {
                EJECUTA_NOTICIAS_GUARDADAS = true;
            }
        }
    });
});

//OBTENEMOS LA SIGUIENTE TANDA DE NOTICIAS DEL SERVIDOR
function getNoticiasGuardadasServidor() {
    var noticiasCargadas = parseInt($("#cargarNoticiasGuardadas").find("figure")[0].id);

    $.ajax({
        url: 'noticiasGuardadas.php',
        data: {noticias_cargadas: noticiasCargadas},
        type: 'post',
        success: function (respuestas_json) {
            var noticias = JSON.parse(respuestas_json);

            if (noticias.length > 0) {
                for (var i = 0; i < noticias.length; i++) {
                    var noticia = JSON.parse(noticias[i]);
                    cargarNoticiasGuardadas(noticia); //CUANDO SE RESCATE LA INFORMACION DE UNA NOTICIA, LA MOSTRAMOS
                }

                $("#cargarNoticiasGuardadas").find("figure")[0].id = noticiasCargadas + noticias.length;

            } else {
                $("#cargarNoticiasGuardadas").remove();
                EJECUTA_NOTICIAS_GUARDADAS = false;
                DETECTAR_SCROLL_NOTICIAS_GUARDADAS = false;
            }
        }
    });
}

//MOSTRAMOS UNA NOTICIA EN LA PÁGINA
function cargarNoticiasGuardadas(noticia) {
    var id = noticia.id;
    var fecha_publicacion = noticia.fecha_publicacion;
    var enlace = noticia.enlace;
    var titulo = noticia.titulo;
    var descripcion = noticia.descripcion;
    var autor = noticia.autor;
    var puntos = noticia.puntos;
    var imagen = noticia.urlAutor;
    var puntuacion_noticia_usuario = noticia.puntuacion_noticia_usuario;
    var fake = noticia.fake;

    var stringNoticia = "<article class='noticia'>\n\
                        <div class='infoNoticia'>\n\
                        <div class='datosNoticia'>\n\
                        <div class='titulo'>\n\
                        <h3 id='titulo_noticia_" + id + "'><a href='" + enlace + "'>" + titulo + "</a></h3>\n\
                        <div class='infoUsuario'>\n\
                        <figure>\n\
                        <figure><img src='" + imagen + "' alt='imagen perfil usuario'/></figure>\n\
                        </figure>\n\
                        <h4>" + autor + " - " + fecha_publicacion + "</h4>\n\
                        </div>\n\
                        </div>\n\
                        </div>\n\
                        <div class='contenidoNoticia'>\n\
                        <p>" + descripcion + "</p>\n\
                        <div class='grupoBotones'>\n\
                        <p id='puntos_" + id + "' class='puntos'>Puntos: <span class='numPuntos'>" + puntos + "</span></p>";


    if (puntuacion_noticia_usuario === 0) {
        stringNoticia += "<button id='botonMeGusta_" + id + "" + '_' + "" + puntos + "' type='button' name='botonMeGusta' value='meGusta' class='boton' title='Me gusta' onclick='meGusta(event)'>\n\
                        <img id='imgBotonMeGusta_" + id + "" + '_' + "" + puntos + "' src='../img/iconos/iconoMeGusta.svg' alt='meGusta'/>\n\
                        </button>\n\
                        <button id='botonNoMeGusta_" + id + "" + '_' + "" + puntos + "' type='button' name='botonNoMeGusta' value='noMeGusta' class='boton' title='No me gusta' onclick='noMeGusta(event)'>\n\
                        <img id='imgBotonNoMeGusta_" + id + "" + '_' + "" + puntos + "' src='../img/iconos/iconoNoMeGusta.svg' alt='noMeGusta'/>\n\
                        </button>";
    }


    stringNoticia += "<button id='botonComentario_" + id + "' type='button' name='botonComentario' value='comentario' class='boton' title='Comentario' onclick='comentarNoticia(event)'>\n\
                    <img id='imgBotonComentario_" + id + "' src='../img/iconos/iconoComentario.svg' alt='comentario'/>\n\
                    </button>\n\
                    <button id='botonGuardar_" + id + "' type='button' name='botonGuardar' value='guardar' class='boton' title='Guardar' onclick='guardarNoticia(event)' >\n\
                    <img id='imgBotonGuardar_" + id + "' src='../img/iconos/iconoGuardar.svg' alt='guardar noticia'/>\n\
                    </button>\n\
                    <button id='botonCompartir_" + id + "' type='button' name='botonCompatir' value='compartir' class='boton' title='Compartir' onclick='compartirNoticia(event)'>\n\
                    <img id='imgBotonCompartir_" + id + "' src='../img/iconos/iconoCompartir.svg' alt='compartir'/>\n\
                    </button>";



    if (!fake) {
        stringNoticia += "<button id='botonFakeNews_" + id + "' type='button' name='botonFakeNews' value='FakeNews' class='boton' title='FakeNews' onclick='fakeNews(event)'>\n\
                        <img id='imgBotonFakeNews_" + id + "' src='../img/iconos/iconoFakeNews.svg' alt='marcar como fake news'/>\n\
                        </button>";
    }

    stringNoticia += "</div>\n\
                    </div>\n\
                    </div>\n\
                    <figure>\n\
                    <img src='' alt=''/>\n\
                    </figure>\n\
                    </article>";

    $("#cargarNoticiasGuardadas").before(stringNoticia);
}

