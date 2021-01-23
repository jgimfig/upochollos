<?php

// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

// RECIBE EL NOMBRE DE UNA FUENTE, SI EL USUARIO NO ESTABA INTERESADO EN LA MISMA, SE VINCULARÁ A ÉL Y VICEVERSA
if (comprobarLogin()) {
    if (isset($_POST['nombre_fuente'])) {
        
        $nombre_fuente = $_POST['nombre_fuente'];
        $nombre_fuente = trim(filter_var($nombre_fuente, FILTER_SANITIZE_STRING));

        if (strlen($nombre_fuente) > 0 && $nombre_fuente !== false) {
            $nombre_usuario = getNombreUsuario();

            $consulta = consulta("SELECT COUNT(*) FROM elegida_por WHERE nombre_usuario='$nombre_usuario' AND nombre_fuente='$nombre_fuente'");

            if ($consulta) {
                if (intval($consulta[0][0]) === 0) {
                    consulta("INSERT INTO elegida_por(nombre_usuario, nombre_fuente) VALUES('$nombre_usuario', '$nombre_fuente')");           
                } else {
                    consulta("DELETE FROM elegida_por WHERE nombre_usuario='$nombre_usuario' AND nombre_fuente='$nombre_fuente'");
                }
            }
        }
    }
}
?>