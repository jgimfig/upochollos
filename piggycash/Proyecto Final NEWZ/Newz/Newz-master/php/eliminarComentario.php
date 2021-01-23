<?php

// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

/*
 * COMPRUEBA SI EL USUARIO HA INICIADO SESIÓN. SI NO LO ESTÁ, LO REDIRIGE A
 * LA PAGINA DE INICIO DE SESIÓN 
 */
include_once 'logeado.php';

//SOLO APLICA SI EL USUARIO ES ADMINISTRADOR
if(isAdmin())
{
    
    if (isset($_POST['id_comentario'])){
        
       $id = filter_var($_POST['id_comentario'], FILTER_SANITIZE_NUMBER_INT);
       
       consulta("DELETE FROM comentario WHERE responde = '$id'");
       consulta("DELETE FROM comentario WHERE id = '$id'");
        
    }
    
}

?>