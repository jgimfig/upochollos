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
    
    if (isset($_POST['id_noticia'])){
        
       $id = filter_var($_POST['id_noticia'], FILTER_SANITIZE_NUMBER_INT);
       
       consulta("DELETE FROM comentario WHERE id_noticia = '$id' AND responde IS NOT NULL");
       consulta("DELETE FROM comentario WHERE id_noticia = '$id'");
       consulta("DELETE FROM  fake_news WHERE id_noticia = '$id'");
       consulta("DELETE FROM guarda WHERE id_noticia = '$id'");
       consulta("DELETE FROM puntua WHERE id_noticia = '$id'");
       consulta("DELETE FROM noticia WHERE id = '$id'");
        
    }
    
}