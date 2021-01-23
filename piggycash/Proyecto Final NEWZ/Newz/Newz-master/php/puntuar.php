<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

// RECIBIMOS EL ID DE LA NOTICIA Y LA PUNTUACIÓN OTORGADA POR EL USUARIO
// Y LA ENVIAMOS A LA TABLA PUNTUA BASE DE DATOS
if(isset($_POST['id_noticia']) && isset($_POST['puntuacion']) && comprobarLogin()){
    
    $id_noticia = filter_var($_POST['id_noticia'], FILTER_SANITIZE_NUMBER_INT);
    $nombre_usuario = getNombreUsuario();
    $puntuacion = filter_var($_POST['puntuacion'], FILTER_SANITIZE_NUMBER_INT);
    
    if(getPuntuacionNoticiaUsuario($id_noticia) === 0){
        consulta("INSERT INTO puntua (puntos, fecha_puntuacion, nombre_usuario, id_noticia) VALUES ('$puntuacion', current_timestamp(), '$nombre_usuario', '$id_noticia')");
    }
}
?>

