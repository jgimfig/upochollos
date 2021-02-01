<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (getNombreUsuario() == "") {
    header('location: ./principal.php');
}
/*
 * COMPRUEBA SI EL USUARIO HA INICIADO SESIÓN. SI NO LO ESTÁ, LO REDIRIGE A
 * LA PAGINA DE INICIO DE SESIÓN 
 */
//include_once 'logeado.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>UpoChollos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS DEL PERFIL-->
        <link rel="stylesheet" type="text/css" href="../css/estiloPerfil.css">
        <link href="../css/estiloPagina.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloNavAdmin.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloCrearProducto.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloPerfil.css" rel="stylesheet" type="text/css"/>
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include './libreriasJS.php'; ?>

        <!--INCLUSIÓN DE LIBRERIAS JS PROPIAS DEL PERFIL-->
        <script src="../js/tabs/jquery.hashchange.min.js" type="text/javascript"></script>
        <script src="../js/tabs/jquery.easytabs.js" type="text/javascript"></script>
        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DEL PERFIL-->
        <script src="../js/tabsPerfil.js" type="text/javascript"></script>
        <script src="../js/comprobacionProducto.js" type="text/javascript"></script>
        <script src="../js/comprobacionCupon.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#divCupones").click(function () {
                    $("#btnProducto").css({backgroundColor: ''});
                    $("#btnCupones").css({backgroundColor: 'orange'});
                    $("#producto").hide();
                    $("#cupon").show();
                });
                $("#divChollo").click(function () {
                    $("#btnProducto").css({backgroundColor: 'orange'});
                    $("#btnCupones").css({backgroundColor: ''});
                    $("#producto").show();
                    $("#cupon").hide();
                });
                $("#divCupones").click();
            });
        </script>
    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include './header.php';
        ?>
        <div class="gridC2">
            <div class="btnChollo" id="divChollo">
                <button class="tablink" id="btnProducto">Producto</button>
            </div>
            <div class="btnCupon" id="divCupones">
                <button class="tablink" id="btnCupones">Cupón</button>
            </div>
            <div class="btnUser" onclick="location.href = './usuario.php';">
                <button class="tablink" id="btnCupones">Usuario</button>
            </div>
        </div>
        <?php
        include './navAdmin.php';
        include './crearProducto.php';
        include './crearCupon.php';
        ?>
        <?php
        //INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
    </body>

</html>