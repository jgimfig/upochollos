<?php

// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

// MUMERO MAXIMO DE NOTICIAS A CARGAR POR LLAMADA
define("INTERVALO_CARGA", 5);

// RECIBIMOS EL NUMERO DE NOTICIAS QUE SE HAN CARGADO HASTA AHORA
if (isset($_POST['noticias_cargadas'])) {

    $inicio = intval(filter_var($_POST['noticias_cargadas'], FILTER_SANITIZE_NUMBER_INT));

    $noticias = array();
    foreach (getNoticiasPublicadas($inicio, INTERVALO_CARGA) as $noticia) {
        $n = array('id' => $noticia[0],
            'fecha_publicacion' => $noticia[1],
            'enlace' => $noticia[2],
            'titulo' => $noticia[3],
            'descripcion' => $noticia[4],
            'autor' => $noticia[5],
            'puntos' => $noticia[6],
            'urlAutor' => getURLAutor($noticia[5]),
            'puntuacion_noticia_usuario' => getPuntuacionNoticiaUsuario($noticia[0]),
            'fake' => isFake($noticia[0])
        );

        $noticias[] = json_encode($n);
    }
    echo json_encode($noticias); // DEVOLVEMOS LA INFORMACIÓN DE LAS NOTICIAS SIGUIENTES.
}
?>