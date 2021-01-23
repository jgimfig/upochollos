<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>UpoChollos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        
        <!--ESTILOS PROPIOS DE COMUNIDAD-->
        <link rel="stylesheet" type="text/css" href="../css/estiloPrincipal.css">
        
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
                <h2>Chollos</h2>
                <?php
                //SI EL USUARIO ESTÁ LOGEADO SE LE PERMITE ESCRIBIR NOTICIAS
                if (comprobarLogin()) {
                    ?>
                    <article>
                        <textarea id="escribirNoticia" class="noticia" placeholder="Escribe una nueva noticia..." onfocus="redactar(event)"></textarea>
                    </article>   
                    <?php
                }
                ?>
                <?php
                //CARGAMOS LAS PRIMERAS 5 NOTICIAS
                $noticias = getNoticiasComunidad(0, 5);

                $nombreUsuario = getNombreUsuario();

                $logeado = strlen($nombreUsuario) > 0;

                foreach ($noticias as $noticia) {
                    $id = $noticia[0];
                    $fecha = $noticia[1];
                    $enlace = $noticia[2];
                    $titulo = $noticia[3];
                    $descripcion = $noticia[4];
                    $nombreAutor = $noticia[5];
                    $puntos = $noticia[6];

                    // COMIENZO DE UNA NOTICIA
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

                    // SOLO PUEDE PUNTUARSE UNA NOTICIA SI SE ESTÁ LOGEADO
                    // Y ADEMÁS NO HAYA VOTADO PREVIAMENTE LA NOTICIA
                    if (getPuntuacionNoticiaUsuario($id) == 0 && $logeado) {
                        echo "<button id='botonMeGusta_$id" . '_' . "$puntos' type='button' name='botonMeGusta' value='meGusta' class='boton' title='Me gusta' onclick='meGusta(event)'> ";
                        echo "<img id='imgBotonMeGusta_$id" . '_' . "$puntos' src='../img/iconos/iconoMeGusta.svg' alt='meGusta'/>";
                        echo "</button>";
                        echo "<button id='botonNoMeGusta_$id" . '_' . "$puntos' type='button' name='botonNoMeGusta' value='noMeGusta' class='boton' title='No me gusta' onclick='noMeGusta(event)'> ";
                        echo "<img id='imgBotonNoMeGusta_$id" . '_' . "$puntos' src='../img/iconos/iconoNoMeGusta.svg' alt='noMeGusta'/>";
                        echo "</button>";
                    }

                    // SI EL USUARIO ESTÁ LOGEADO, SE LE PERMITIRÁ PUBLICAR COMENTARIOS
                    // Y GUARDAR LA NOTICIA
                    if ($logeado) {
                        echo "<button id='botonComentario_$id' type='button' name='botonComentario' value='comentario' class='boton' title='Comentario' onclick='comentarNoticia(event)'> ";
                        echo "<img id='imgBotonComentario_$id' src='../img/iconos/iconoComentario.svg' alt='comentario'/>";
                        echo "</button>";
                        echo "<button id='botonGuardar_$id' type='button' name='botonGuardar' value='guardar' class='boton' title='Guardar' onclick='guardarNoticia(event)' >";
                        echo "<img id='imgBotonGuardar_$id' src='../img/iconos/iconoGuardar.svg' alt='guardar noticia'/>";
                        echo "</button>";
                    }

                    // TANTO SI ESTÁ LOGEADO COMO SI NO, SE PERMITIRÁ COMPARTIR LA NOTICIA
                    echo "<button id='botonCompartir_$id' type='button' name='botonCompatir' value='compartir' class='boton' title='Compartir' onclick='compartirNoticia(event)'> ";
                    echo "<img id='imgBotonCompartir_$id' src='../img/iconos/iconoCompartir.svg' alt='compartir'/>";
                    echo "</button>";

                    //  SI EL USUARIO ESTÁ LOGEADO Y NO HA MARCADO LA NOTICIA PREVIAMENTE COMO FALSA
                    // SE PERMITIRÁ MARCARLA COMO TAL
                    if ($logeado) {
                        if (!isFake($id)) {
                            echo "<button id='botonFakeNews_$id' type='button' name='botonFakeNews' value='FakeNews' class='boton' title='FakeNews' onclick='fakeNews(event)'>";
                            echo "<img id='imgBotonFakeNews_$id' src='../img/iconos/iconoFakeNews.svg' alt='marcar como fake News'/>";
                            echo "</button>";
                        }
                    }
                    
                    if (isAdmin()) {
                        // BOTON DE ELIMINAR -- EXLCUSIVO ADMINS
                        echo "<button id='botonEliminar_$id' type='button' name='botonEliminar' value='eliminar' class='boton' title='Eliminar' onclick='eliminarNoticia(event)'> ";
                        echo "<img id='imgbotonEliminar_$id' src='../img/iconos/iconoPapelera.png' alt='compartir'/>";
                        echo "</button>";
                    }
                    
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<figure>";
                    echo "<img src='' alt=''/>";
                    echo "</figure>";
                    echo "</article> ";
                }
                ?> 

                <!--MEDIANTE JAVASCRIPT SE IRÁN CARGANDO LAS NOTICIAS PROGRESIVAMENTE -->
                <div id="cargando">
                    <figure id="5"> <!-- A PARTIR DE QUE NOTICIA EMPEZAR A CARGAR -->
                        <img src="../img/iconos/iconoCargando.gif" alt="cargando noticias"/>
                    </figure>
                </div>
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