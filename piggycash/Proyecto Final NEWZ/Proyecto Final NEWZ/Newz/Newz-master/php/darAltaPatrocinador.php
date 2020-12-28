<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

/*
 * COMPRUEBA SI EL USUARIO HA INICIADO SESIÓN. SI NO LO ESTÁ, LO REDIRIGE A
 * LA PAGINA DE INICIO DE SESIÓN 
 */
include_once 'logeado.php';

/*SI NO ES UN ADMINISTRADOR NO PUEDE ENTRAR A ESTA PÁGINA*/
if (!isAdmin())
{
    header('location: ../index.php');
}

?>

<?php

        if (isset($_POST['darDeBaja']))
        {
            $cif = filter_var($_POST['darDeBaja'], FILTER_SANITIZE_STRING);
            
            consulta( "DELETE FROM patrocinador WHERE patrocinador.cif = '$cif'");
        }
        
        if (isset($_POST['cif']) && isset($_POST['nombre'])) {
            
            $nombrePatrocinador = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $cifPatrocinador = filter_var($_POST['cif'], FILTER_SANITIZE_STRING);
            
            consulta("INSERT INTO patrocinador (cif, nombre) VALUES ('$cifPatrocinador', '$nombrePatrocinador')");
        }


?>


<!DOCTYPE html>
<html>
    <head>
        <title>Newz</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS DEL FORMULARIO-->
        <link rel="stylesheet" type="text/css" href="../css/estiloPagina.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include './libreriasJS.php'; ?>

    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include './header.php';
        ?>

        
        <form action="#" method="POST" class ="formRegistroPatrocinador">
            <h1>Dar de alta un nuevo patrocinador</h1>
            CIF:<br>
            <input type="text" name="cif" placeholder="CIF">
            <br>
            Nombre:<br>
            <input type="text" name="nombre" placeholder="Nombre del patrocinador">
            <br><br>
            <input type="submit" value="Registrar">
        </form> 
        
        <form action="#" method="POST" class ="formRegistroPatrocinador">
            <h1>Dar de baja un patrocinador</h1>
            
            <select name="darDeBaja">
                <option selected> --- </option>
                <?php
                        foreach (getPatrocinadores() as $p)
                        {
                            $cif = $p[0];
                            $nombre = $p[1];
                            echo " <option value='$cif'>$nombre -$cif</option>";
                        }
                ?>
                
            </select>
            
            <br><br>
            <input type="submit" value="Dar de baja">
        </form> 

    </div>
    <?php
    //INCLUIMOS EL FOOTER
    include './footer.php';
    ?>
</body>

</html>