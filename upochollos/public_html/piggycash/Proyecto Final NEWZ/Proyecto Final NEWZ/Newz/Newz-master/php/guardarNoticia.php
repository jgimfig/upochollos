<?php
//FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

//RECIBE EL ID DE UNA NOTICIA
//SI ESTA NO ESTÁ GUARDADA POR EL USUARIO, LA GUARDA
if(isset($_POST['id_noticia'])){
    $id_noticia = filter_var($_POST['id_noticia'], FILTER_SANITIZE_NUMBER_INT);
    $nombre_usuario = getNombreUsuario();
    
    if(!isNoticiaGuardada($id_noticia)){
        consulta("INSERT INTO guarda (nombre_usuario, id_noticia) VALUES ('$nombre_usuario', '$id_noticia')");
    }
}
?>