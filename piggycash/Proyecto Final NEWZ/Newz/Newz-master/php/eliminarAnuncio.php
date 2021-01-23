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
    
    if (isset($_POST['titulo_noticia']) && isset($_POST['fecha_noticia'])){
        
        $titulo = filter_var($_POST['titulo_noticia'], FILTER_SANITIZE_STRING); 
        $fecha = filter_var($_POST['fecha_noticia'], FILTER_SANITIZE_STRING); 
        
        unlink("../anuncios/".getPatrocinador($titulo, $fecha).$titulo.$fecha.".txt");
        consulta("DELETE FROM patrocina WHERE patrocina.titulo_anuncio = '$titulo' AND patrocina.fecha_inicio_anuncio = '$fecha'");
        consulta("DELETE FROM anuncio WHERE anuncio.titulo = '$titulo' AND anuncio.fecha_inicio = '$fecha'");
        
    }
    
}

