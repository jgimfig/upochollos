<?php

// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

//RECIBIMOS LOS DATOS REFERENTES A UNA NOTICIA
//SI TODOS LOS PARAMETROS SON CORRECTOS, LA NOTICIA QUE SUBA EL USUARIO SE REGISTRARÁ EN EL SISTEMA 
if (isset($_POST['subirNoticia']) && isset($_POST['enlace']) && isset($_POST['titulo']) && isset($_POST['descripcion']) && comprobarLogin()) {

    $enlace = $_POST['enlace'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    if (strlen($enlace) > 0 && strlen($titulo) > 0 && strlen($descripcion) > 0) {
        $enlace = trim(filter_var($enlace, FILTER_SANITIZE_URL));
        $titulo = trim(filter_var($titulo, FILTER_SANITIZE_STRING));
        $descripcion = trim(filter_var($descripcion, FILTER_SANITIZE_STRING));

        while (strpos($descripcion, '\n\n') !== false) {
            $descripcion = str_replace('\n\n', '\n', $descripcion);
        }

        if (strlen($enlace) > 0 && strlen($titulo) > 0 && strlen($descripcion) > 0 && $enlace !== false && $titulo !== false && $descripcion !== false) {
            $enl = filter_var($enlace, FILTER_VALIDATE_URL);
            $tit = preg_match('/[a-zA-Z0-9áéíóú]+\s*/', $titulo);
            $desc = preg_match('/[a-zA-Z0-9áéíóú]+\s*/', $descripcion);

            if ($enl !== false && strlen($enl) > 0 && $tit !== false && $desc !== false) {
                registrarNoticia($enlace, $titulo, $descripcion);
                header('location: comunidad.php');
            }
        }
    }
}
?>
