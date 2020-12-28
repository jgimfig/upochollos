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
        <link rel="stylesheet" type="text/css" href="../css/estiloTematica.css">

        <!--ESTILOS PROPIOS DE TABLÓN-->
        <link rel="stylesheet" type="text/css" href="../css/estiloTablon.css">

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
            
            <!--NOTICIAS CARGADAS-->
            <section>
                <?php
                
                //RESCATAMOS LA TEMATICA SELECCIONADA POR EL USUARIO
                $tematica = $_GET['tematica'];
                echo "<h2>$tematica</h2>";
                
                // RESCATAMOS LAS NOTICIAS DEL USUARIO EN BASE A LA TEMÁTICA
                // ELEGIDA Y EN BASE A SUS FUENTES PREFERIDAS
                $noticias = getNoticiasUsuario($tematica, 3);

                // COSTRUIMOS LAS TARJETAS QUE INLICUIRAN LAS NOTICIAS
                foreach ($noticias as $noticia) {
                    $titulo = $noticia[0];
                    $fuente = $noticia[5];
                    $fecha = $noticia[1];
                    $enlace = $noticia[2];
                    $descripcion = $noticia[3];
                    $imagen = $noticia[4];

                    echo "<article class='noticia'>";
                    echo "<div class='infoNoticia'>";
                    echo "<div class='datosNoticia'>";
                    echo "<div class='titulo'>";
                    echo "<h3><a href='$enlace'>$titulo</a></h3>";
                    echo "<h4>$fuente - $fecha</h4>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='contenidoNoticia'>";
                    echo "<p>$descripcion</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<figure>";
                    echo "<img src='$imagen' alt='Imagen de la noticia'/>";
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
