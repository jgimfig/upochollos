<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

// MUMERO MAXIMO DE COMENTARIOS A CARGAR POR LLAMADA
define("INTERVALO_CARGA", 5);

// RECIBIMOS EL NUMERO DE COMENTARIOS QUE SE HAN CARGADO HASTA AHORA
if(isset($_POST['comentarios_cargados'])){
    $inicio = intval($_POST['comentarios_cargados']);
    
    
    $comentarios = array();
    foreach (getComentariosPublicados($inicio, INTERVALO_CARGA) as $comentario){
        $c = array( 'id'=>$comentario[0], 
                    'texto'=>$comentario[1], 
                    'fecha_comentario'=>$comentario[2], 
                    'autor'=>$comentario[3], 'id_noticia'=>$comentario[4], 
                    'responde'=>$comentario[5], 
                    'urlImagen'=> getURLAutor($comentario[3])
            );  
        
        $comentarios[] = json_encode($c);
    }
    echo json_encode($comentarios);  // DEVOLVEMOS LA INFORMACIÓN DE LOS COMENTARIOS SIGUIENTES.
}
?>