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

        <!--ESTILOS PROPIOS DEL PERFIL-->
        <link rel="stylesheet" type="text/css" href="../css/estiloComunidad.css">
        <link rel="stylesheet" type="text/css" href="../css/estiloPerfil.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include './libreriasJS.php'; ?>

        <!--INCLUSIÓN DE LIBRERIAS JS PROPIAS DEL PERFIL-->
        <script src="../js/tabs/jquery.hashchange.min.js" type="text/javascript"></script>
        <script src="../js/tabs/jquery.easytabs.js" type="text/javascript"></script>

        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DEL PERFIL-->
        <script src="../js/tabsPerfil.js" type="text/javascript"></script>
        <script src="../js/cargarNoticiasPublicadas.js" type="text/javascript"></script>
        <script src="../js/cargarComentariosPublicados.js" type="text/javascript"></script>
        <script src="../js/cargarNoticiasGuardadas.js" type="text/javascript"></script>
    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include './header.php';
        ?>

        <!-- DIVISOR PRINCIPAL: Divide contenido prncipal y publicidad -->
        <div id="perfilZonaSuperior">
            <div id="datosUsuario">
                <!--FOTO DE PERFIL-->
                <div id="imgPerfil">
                    <?php
                    $urlImagen = getURLImagenUsuario();
                    echo "<figure id='imgPerfil'><img src='$urlImagen' alt='imagen perfil usuario'/></figure>";
                    ?>
                </div>

                <!--NOMBRE DE USUARIO Y FECHA DE REGISTRO-->
                <div id="nombreYFechaUsuario">
                    <?php
                    $nombreUsuario = getNombreUsuario();
                    $fechaUsuario = getFechaRegistroUsuario();
                    echo "<p id='nombreUsuario'>$nombreUsuario</p>";
                    echo "<p id='fechaUsuario'>$fechaUsuario</p>";
                    ?>
                </div>

                <!--BOTÓN DE AJUSTES-->
                <div id="ajustes">
                    <figure><a href="ajustes.php"><img src="../img/iconos/iconoAjustes.svg" alt="ajustes de perfil"/></a></figure>
                </div>
            </div>

            <!--ESTADISTICAS DEL USUARIO-->
            <div id="estadisticas">
                <h2>Estadísticas</h2>
                <div id="conjuntoEstadisticas">
                    <div id="puntos" class="datoEstadistica">
                        <!--PUNTOS OBTENIDOS-->
                        <h3>Puntos</h3>
                        <?php
                        $puntos = getPuntosUsuario();
                        echo "<p id='puntosUsuario'>$puntos</p>";
                        ?>
                    </div>

                    <!--NUMERO DE NOTICIAS PUBLICADAS-->
                    <div id="nNoticias" class="datoEstadistica">
                        <h3>NºNoticias</h3>
                        <?php
                        $nNoticias = getNumNoticiasUsuario();
                        echo "<p id='nNoticiasUsuario'>$nNoticias</p>";
                        ?>
                    </div>

                    <!--NUMERO DE COMENTARIOS PUBLICADOS-->
                    <div id="nComentarios" class="datoEstadistica">
                        <h3>NºComentarios</h3>
                        <?php
                        $nComentarios = getNumComentariosUsuario();
                        echo "<p id='nComentariosUsuario'>$nComentarios</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!--VISTA DE PESTAÑAS PARA NOTICIAS PUBLICADAS, COMENTARIOS PUBLICADOS Y NOTICIAS GUARDADAS-->
        <!--ES UNA LISTA CON LAS PESTAÑAS DEFINIDAS,  MEDIANTE UN PLUGIN JS SE VERÁ A MODO DE PESTAÑAS-->
        <div id="tab-container" class="tab-container">
            <ul class='etabs'>
                <li class='tab'><a href="#tab-1">Noticias publicadas</a></li>
                <li class='tab'><a href="#tab-2">Comentarios realizados</a></li>
                <li class='tab'><a href="#tab-3">Noticias guardadas</a></li>
            </ul>
            <div id="tab-1">
                <div id="cargarNoticias"><figure id="0"><img src="../img/iconos/iconoCargando.gif" alt="cargando noticias"/></figure></div>
            </div>
            <div id="tab-2">
                <div id="cargarComentarios"><figure id="0"><img src="../img/iconos/iconoCargando.gif" alt="cargando comentarios"/></figure></div>
            </div>
            <div id="tab-3">
                <div id="cargarNoticiasGuardadas"><figure id="0"><img src="../img/iconos/iconoCargando.gif" alt="cargando noticias guardadas"/></figure></div>
            </div>
        </div>

        <!--NCLUIMOS UN BOTÓN DE SUBIR A LA CABECERA -->
        <?php
        include './subir.php';
        ?>

        <?php
        //INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
    </body>

</html>