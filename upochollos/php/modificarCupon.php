<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (getNombreUsuario() == "") {
    header('location: ./principal.php');
}
$var = getCupon($_POST['id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>UpoChollos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS-->
        <link href="../css/estiloPagina.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloPerfil.css" rel="stylesheet" type="text/css"/>
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DE COMUNIDAD-->
        
    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include 'header.php';
        ?>
        <div align="center" id="cupon">
            <form name="fcategoria" method="POST" action="crud.php">
                <p>Nombre Cupón:</p>
                <input type="text" class="ip4" name="cnombre" id="nombre" value= <?php echo "'" . $var[0][1] . "'"; ?> required/>
                <p>Código Cupon:</p>
                <input type="text" class="ip4" name="ccodigo" id="codigo" value= <?php echo "'" . $var[0][2] . "'"; ?> required/>
                <p>Fecha publicación:</p>
                <input type="date" name="cFechaPublicacion" id="FechaPublicacion" value=<?php echo "'" . date('Y-m-d') . "'"; ?> min=<?php echo "'" . $var[0][3] . "'"; ?>"/>
                <p>Fecha vencimiento:</p>
                <input type="date" name="cFechaVencimiento" id="FechaVencimiento" value=<?php echo "'" . date('Y-m-d', strtotime("+1 week")) . "'"; ?> min=<?php echo "'" . date('Y-m-d') . "'"; ?>/>
                <p>Descripcion:</p>
                <input type="text" name="cdescripcion" id="descripcion" class="ip4" value= <?php echo "'" . $var[0][5] . "'"; ?> required/>
                <input type="hidden" name="cId" id="idCupon" value= <?php echo "'" . $var[0][2] . "'"; ?> />
                <br><br>
                <input class="btnProducto2" id="crear" name="btnCrearCupon" type="submit" value="Modificar"/>
            </form>
        </div>		

        <!--NCLUIMOS EL ASIDE CON LA PUBLICIDAD Y UN BOTÓN DE SUBIR A LA CABECERA -->
        <?php
        //include './php/aside.php';
        //include './php/subir.php';
        //INCLUIMOS EL FOOTER
        //include './php/footer.php';
        ?>
    </body>
</html>
