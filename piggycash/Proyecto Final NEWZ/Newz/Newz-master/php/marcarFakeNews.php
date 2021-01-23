<?php

// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

/*
  ESTE FICHERO RECIBE MEDIANTE POST, EL ID DE UNA NOTICIA Y LA REPORTA COMO FALSA
  EN BASE AL NOMBRE DE USUARIO DE QUIEN LA REPORTA
 */

if (isset($_POST['id_noticia']) && comprobarLogin()) {
    $id_noticia = filter_var($_POST['id_noticia'], FILTER_SANITIZE_NUMBER_INT);
    $nombre_usuario = getNombreUsuario();

    if (!isFake($id_noticia)) {
        consulta("INSERT INTO fake_news (nombre_usuario, id_noticia) VALUES ('$nombre_usuario', '$id_noticia')");
    }
}
?>

