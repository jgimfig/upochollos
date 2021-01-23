<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

// RECIBIMOS EL ID DE LA NOTICIA Y EL TEXTO DEL COMENTARIO
if (isset($_POST['id_noticia']) && isset($_POST['texto_comentario'])) {
    
    
    $id_noticia = trim(filter_var($_POST['id_noticia'], FILTER_SANITIZE_NUMBER_INT));
    
    $texto_comentario = trim(filter_var($_POST['texto_comentario'], FILTER_SANITIZE_STRING));
    
    
    
    $autor = getNombreUsuario();
    // SI SE NOS ENVÍA UN ID COMENTARIO SIGNIFICA QUE EL COMENTARIO ES UNA RESPUESTA A OTRO
    // DENTRO DE LA MISMA NOTICIA
    if(!isset($_POST['id_comentario'])){
        consulta("INSERT INTO comentario (texto, fecha_comentario, autor, id_noticia, responde) VALUES ('$texto_comentario', current_timestamp(), '$autor', '$id_noticia', NULL)");
    }else{ 
        $id_comentario = trim(filter_var($_POST['id_comentario'], FILTER_SANITIZE_NUMBER_INT));
        consulta("INSERT INTO comentario (texto, fecha_comentario, autor, id_noticia, responde) VALUES ('$texto_comentario', current_timestamp(), '$autor', '$id_noticia', '$id_comentario')");
    }
    
}
?>