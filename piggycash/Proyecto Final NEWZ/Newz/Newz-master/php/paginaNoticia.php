<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

/*
 * COMPRUEBA SI EL USUARIO HA INICIADO SESIÓN. SI NO LO ESTÁ, LO REDIRIGE A
 * LA PAGINA DE INICIO DE SESIÓN 
 */
include_once 'logeado.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Newz</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS DEL TABLÓN-->
        <link rel="stylesheet" type="text/css" href="../css/estiloComunidad.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include './libreriasJS.php'; ?>

    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include './header.php';
        ?>

        <!-- DIVISOR PRINCIPAL: Divide contenido prncipal y publicidad -->
        <div id="divisorPagina">
            <section>
                <h2>Comunidad</h2>
                <?php
                //RESCATAMOS EL ID DE LA NOTICIA A CARGAR
                if (isset($_GET['id'])) {

                    // SANEAMOS EL ID RECIBIDO
                    $id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

                    //RESCATAMOS LA INFORMACIÓN DE LA NOTICIA DE LA BASE DE DATOS
                    // Y LA MOSTRAMOS
                    $noticia = getNoticiaComunidad($id);

                    $fecha = $noticia[1];
                    $enlace = $noticia[2];
                    $titulo = $noticia[3];
                    $descripcion = $noticia[4];
                    $nombreAutor = $noticia[5];
                    $puntos = $noticia[6];

                    // COMIENZO DE LA NOTICIA
                    echo "<article class='noticia'>";
                    echo "<div class='infoNoticia'>";
                    echo "<div class='datosNoticia'>";

                    //TITULO DE LA NOTICIA Y SU ENLACE A LA FUENTE ORIGINAL
                    echo "<div class='titulo'>";
                    echo "<h3 id='titulo_noticia_$id'><a href='$enlace'>$titulo</a></h3>";
                    echo "<div class='infoUsuario'>";
                    echo "<figure>";

                    // INFORMACIÓN DEL AUTOR Y FECHA DE PUBLICACÍON DE LA NOTICIA
                    $urlImagen = getURLAutor($nombreAutor);
                    echo "<figure><img src='$urlImagen' alt='imagen perfil usuario'/></figure>";
                    echo "</figure>";
                    echo "<h4>$nombreAutor - $fecha</h4>";
                    echo "</div>";


                    echo "</div>";
                    echo "</div>";
                    echo "<div class='contenidoNoticia'>";

                    //BREVE DESCRIPCIÓN DE LA NOTICIA
                    echo "<p>$descripcion</p>";

                    // BOTONES CON LOS QUE SE PUEDE INTERACTUAR EN LA NOTICIA
                    echo "<div class='grupoBotones'>";
                    echo "<p id='puntos_$id' class='puntos'>Puntos: <span class='numPuntos'>$puntos</span></p>";

                    // SOLO PUEDE PUNTUARSE UNA NOTICIA SI NO SE HA VOTADO PREVIAMENTE
                    if (getPuntuacionNoticiaUsuario($id) == 0) {
                        echo "<button id='botonMeGusta_$id" . '_' . "$puntos' type='button' name='botonMeGusta' value='meGusta' class='boton' title='Me gusta' onclick='meGusta(event)'> ";
                        echo "<img id='imgBotonMeGusta_$id" . '_' . "$puntos' src='../img/iconos/iconoMeGusta.svg' alt='meGusta'/>";
                        echo "</button>";
                        echo "<button id='botonNoMeGusta_$id" . '_' . "$puntos' type='button' name='botonNoMeGusta' value='noMeGusta' class='boton' title='No me gusta' onclick='noMeGusta(event)'> ";
                        echo "<img id='imgBotonNoMeGusta_$id" . '_' . "$puntos' src='../img/iconos/iconoNoMeGusta.svg' alt='noMeGusta'/>";
                        echo "</button>";
                    }

                    // BOTON DE GUARDAR NOTICIA 
                    echo "<button id='botonGuardar_$id' type='button' name='botonGuardar' value='guardar' class='boton' onclick='guardarNoticia(event)' >";
                    echo "<img id='imgBotonGuardar_$id' src='../img/iconos/iconoGuardar.svg' alt='guardar noticia'/>";
                    echo "</button>";

                    // BOTON DE COMPARTIR
                    echo "<button id='botonCompartir_$id' type='button' name='botonCompatir' value='compartir' class='boton' title='Compartir' onclick='compartirNoticia(event)'> ";
                    echo "<img id='imgBotonCompartir_$id' src='../img/iconos/iconoCompartir.svg' alt='compartir'/>";
                    echo "</button>";

                    if (isAdmin()) {
                        // BOTON DE ELIMINAR -- EXLCUSIVO ADMINS
                        echo "<button id='botonEliminar_$id' type='button' name='botonEliminar' value='eliminar' class='boton' title='Eliminar' onclick='eliminarNoticia(event)'> ";
                        echo "<img id='imgbotonEliminar_$id' src='../img/iconos/iconoPapelera.png' alt='compartir'/>";
                        echo "</button>";
                    }

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</article> ";
                }
                ?> 

                <!--TEXTAREA QUE PERMITE ESCRIBIR UN COMENTARIO EN LA NOTICIA-->
                <article class="comentarios">
                    <textarea id="escribirComentario" class="noticia" placeholder="Escribe un comentario..."></textarea>
                    <?php
                    echo "<button id='boton_comentario_$id' class='boton' onclick='enviarComentario(event)'>Enviar</button>";
                    ?>
                </article>

                <?php
                // RESCATAMOS TODOS LOS COMENTARIOS REFERENTES A LA NOTICIA 
                $comentarios = getComentariosNoticia($id);

                foreach ($comentarios as $noticia) {
                    $id = $noticia[0];
                    $texto = $noticia[1];
                    $fecha = $noticia[2];
                    $nombreAutor = $noticia[3];
                    $id_noticia = $noticia[4];

                    echo "<article id='comentario_$id' class ='comentario'>";
                    echo "<div class='datosNoticia'>";
                    echo "<div class='infoUsuario'>";
                    $urlImagen = getURLAutor($nombreAutor);
                    echo "<figure><img src='$urlImagen' alt='imagen perfil usuario'/></figure>";
                    echo "<h4>$nombreAutor - $fecha</h4>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='textoComentario'>";
                    echo "<p>$texto</p>";
                    echo "</div>";
                    echo "<div class='grupoBotones'>";
                    echo "<button id='botonResponder_$id" . '_' . "$id_noticia' type='button' name='botonResponder' value='responder' class='boton botonResponder' title='Responder' onclick='responder(event)'> ";
                    echo "<img id='imgBotonResponder_$id" . '_' . "$id_noticia' src='../img/iconos/iconoResponder.png' alt='responder'/>";
                    echo "</button>";
                    echo "<button id='boton_verRespuestas_$id_noticia" . '_' . "$id' class='boton botonVerRespuestas' onclick='mostrarRespuestas(event)'>Ver respuestas</button>";
                    if (isAdmin()) {
                        // BOTON DE ELIMINAR -- EXLCUSIVO ADMINS
                        echo "<button id='botonEliminarComent_$id' type='button' name='botonEliminar' value='eliminar' class='boton botonResponder' title='Eliminar' onclick='eliminarComentario(event)'> ";
                        echo "<img id='imgbotonEliminarComent_$id' src='../img/iconos/iconoPapelera.png' alt='compartir'/>";
                        echo "</button>";
                    }
                    echo "</div>";
                    echo "</article> ";
                }
                ?>
            </section>

            <!--NCLUIMOS EL ASIDE CON LA PUBLICIDAD Y UN BOTÓN DE SUBIR A LA CABECERA -->
            <?php
            include './aside.php';
            include './subir.php';
            ?>

        </div>
        <?php
//INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
    </body>

</html>
