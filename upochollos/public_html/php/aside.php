<?php
// INCLUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>

<!--ASIDE COMÚN A TODAS LAS PAGINAS QUE MUESTRA PUBLICIDAD-->
<aside>
    <?php
    // SI EL USUARIO ES ADMINISTRADOR SE MOSTRARÁ UNA VENTANA EMERGENTE CON UN FORMAULARIO
    // Y AGREGAR UNA NOTICIA
    if (isAdmin()) {
        echo "<script type='text/javascript' src='../js/publicarAnuncio.js'></script>";
        echo "</button>";
        echo "<button class='mas' title='Añadir anuncio' onclick='publicarAnuncio()' >";
        echo "<img id='imgBotonGuardar' src='../img/iconos/iconoGuardar.svg' alt='publicar anuncio'/>";
        echo "</button>";
        echo "<br/><br><button id='crearPatrocinador' onclick='crearPatrocinador(event)'>Gestionar patrocinadores</button> <br/><br/><br/>";
    }

    // RESCATAMOS LA INFORMACIÓN DE TODOS LOS ANUNCIOS EN FECHA VIGENTE
    // Y LOS MOSTRAMOS EN EL ASIDE
   /* foreach (getAnuncios() as $anuncio) {

        $titulo = $anuncio[0];
        $descripcion = $anuncio[1];
        $contenidoMultimedia = getContenidoMultimediaAnuncio($anuncio[2]);
        $fechaInicioAnuncio = $anuncio[3];

        if (isAdmin()) {
            $id = $titulo.'_'.$fechaInicioAnuncio;
            echo "<br/><br/><br/><button id='$id' onclick='borrarAnuncio(event)' class='borrarAnuncio'>Borrar este anuncio</button>";
        }
        
        echo "<div class = 'publicidad'>";
        echo "<h3>$titulo</h3>";
        echo "<p>$descripcion</p>";
        echo "$contenidoMultimedia"; //STRING CON ETIQUETAS HTML QUE INCLUYEN CONTENIDO ADICIONAL POR PARTE DE LOS ANUNCIANTES
        // YA SEAN VIDEOS, SCRIPTS, ETC.        
        echo "</div>";
    }*/
    ?>

</aside>