<?php
include_once 'funciones.php';

// ESTE ARCHIVO DEVUELVE MEDIANTE JSON TODAS LAS FUENTES
// MARCANDO CON VERDADERO O FALSO AQUELLAS EN LAS QUE EL USUARIO ESTÉ O NO INTERESADO
if(comprobarLogin()){
    $fuentesUsuario = getFuentesUsuario();
    $fuentesNoSeleccionadas = getFuentesNoSeleccionadas($fuentesUsuario);
    
    $fuentes = array();
    
    foreach($fuentesUsuario as $fu){
        $fuentes[] = json_encode(array('nombre_fuente'=>$fu, 'seleccionada'=>true));
    }
    
    foreach($fuentesNoSeleccionadas as $fns){
        $fuentes[] = json_encode(array('nombre_fuente'=>$fns, 'seleccionada'=>false));
    }
    
    echo json_encode($fuentes);
}
?>

