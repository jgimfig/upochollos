<?php

// INCLUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
/*
 * CONSULTA CON LA BASE DE DATOS PARA OBTENER LA INFORMACIÓN DE LOS PATROCINADORES
 * Y LA DEVUELVE A JS MEDIANTE JSON
 */

if (isAdmin()) {
    $patrocinadores = array();

    foreach (getPatrocinadores() as $patrocinador) {
        $patrocinadores[] = json_encode(array(
            'cif' => $patrocinador[0],
            'nombre' => $patrocinador[1],
        ));
    }

    echo json_encode($patrocinadores);
}