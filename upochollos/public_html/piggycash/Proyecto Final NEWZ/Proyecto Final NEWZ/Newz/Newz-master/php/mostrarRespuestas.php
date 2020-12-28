<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';


// RECIBIMOS EL ID DE UNA NOTICIA Y EL ID DE UN COMENTARIO
// DEVOLVEMOS TODAS LAS RESPUESTAS AL COMENTARIO DE LA NOTICIA
if(isset($_POST['id_noticia']) && isset($_POST['id_comentario'])){
    
    $id_noticia = filter_var($_POST['id_noticia'], FILTER_SANITIZE_STRING);
    $id_comentario = filter_var($_POST['id_comentario'], FILTER_SANITIZE_NUMBER_INT);
    
    $consulta = consulta("SELECT * FROM comentario WHERE id_noticia='$id_noticia' AND responde='$id_comentario'");
    
    $respuestas = array();
    foreach ($consulta as $c){
        $respuesta = array();
        $respuesta['id'] = $c[0];
        $respuesta['texto'] = $c[1];
        $respuesta['fecha'] = $c[2];
        $respuesta['autor'] = $c[3];
        $respuesta['id_noticia'] = $c[4];    
        $respuesta['responde'] = $c[5];
        $respuesta['imagenAutor'] = getURLAutor($c[3]);
        $respuesta['numRespuestas'] = getNumRespuestas($c[0]);
        
        $respuestas[] = json_encode($respuesta);
    }
    echo json_encode($respuestas);
}

?>
