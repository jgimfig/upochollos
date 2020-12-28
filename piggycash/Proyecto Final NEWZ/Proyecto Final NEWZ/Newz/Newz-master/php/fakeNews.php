<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Newz</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS DE FAKE NEWS-->
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
                <h2>Fake news</h2>
                <?php
                
                // RESCATAMOS LA INFORMACIÓN DE LAS NOTICIAS FALSAS DE ESTE MES
                $noticias = getFakeNews();
                
                //MOSTRAMOS LAS NOTICIAS FALSAS
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
                    echo "<div class='grupoBotones'>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<figure>";
                    echo "<img src='' alt=''/>";
                    echo "</figure>";
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
