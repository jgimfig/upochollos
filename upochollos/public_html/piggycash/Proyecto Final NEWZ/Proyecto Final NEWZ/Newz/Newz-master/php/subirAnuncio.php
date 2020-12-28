<?php

// INCLUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

if (isAdmin()) {

    if (isset($_POST['titulo']) && isset($_POST['fechaInicio']) && isset($_POST['cuantia']) && isset($_POST['descripcion']) && isset($_POST['patr'])) {
        $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
        $fechaInicio = filter_var($_POST['fechaInicio'], FILTER_SANITIZE_STRING);
        $cuantia = filter_var($_POST['cuantia'], FILTER_SANITIZE_NUMBER_FLOAT);
        $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING);
        $contenidoMultimedia = $_POST['contenidoMultimedia'];
        $fechaFin = 'NULL';
        $patrocinador = filter_var($_POST['patr'], FILTER_SANITIZE_STRING);

        if (isset($_POST['fechaFin']) && strlen($_POST['fechaFin']) > 0) {
            $fechaFin = "'" . filter_var($_POST['fechaFin'], FILTER_SANITIZE_STRING) . "'";
        }

        $fileName = "../anuncios/" . $patrocinador . $titulo . $fechaInicio . ".txt";

        $f = fopen($fileName, 'w') or die("ERROR");
        flock($f, LOCK_EX) or die("ERROR");
        fwrite($f, $_POST['contenidoMultimedia']);
        flock($f, LOCK_UN);
        fclose($f);

        consulta("INSERT INTO anuncio (titulo, fecha_inicio, fecha_fin, descripcion, cuantia, contenido_multimedia) "
                . "VALUES ('$titulo', '$fechaInicio', $fechaFin, '$descripcion', '$cuantia', '$fileName') ");


        consulta("INSERT INTO patrocina (cif_patrocinador, titulo_anuncio, fecha_inicio_anuncio) VALUES "
                . "('$patrocinador', '$titulo', '$fechaInicio') ");
    }
    header('location: ../index.php');
}