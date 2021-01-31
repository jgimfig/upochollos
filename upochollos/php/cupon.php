<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (!isset($_GET["idCupon"])) {
    header('location: ./principal.php');
}
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
        <!--        <link rel="stylesheet" type="text/css" href="../css/estiloPaginacion.css">-->
        <link rel="stylesheet" type="text/css" href="../css/estiloPagina.css">
        <link href="../css/estiloClipboard.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloPerfil.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloPaginacion.css" rel="stylesheet" type="text/css"/>
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS-->
        <script type='text/javascript' src='../js/comprobacionProducto.js'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script>
            function cpy() {
                /* Get the text field */
                var copyText = document.getElementById("input");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                document.execCommand("copy");

                /* Alert the copied text */
                alert("Copiado el codigo: " + copyText.value);
            }
        </script>
    </head>


    <body>
        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include 'header.php';
        ?>
        <?php
        $row = getCupon($_GET["idCupon"]);
        if (getUsuarioCupon($_GET["idCupon"]) == getNombreUsuario() || getAdministrador()) {
            echo '<div class = "gridC">
                <div class = "btnChollo" id = "divChollo">
                    
                    <form method="post" action="crud.php">
                    <input type="hidden" name="id" value="' . $_GET["idCupon"] . '">
                        <button class = "tablink" name="eliminarCupon">Eliminar Cupón</button>
                 </form>
                </div>
                <div class = "btnCupon" id = "divCupones">
                    <form method="post" action="modificarCupon.php">
                    <input type="hidden"  name="id" value="' . $_GET["idCupon"] . '">
                    <button class = "tablink" name="btnModificar">Modificar Cúpon</button>
                 </form>
                    
                </div>
            </div>';
        }
        echo '<div  class="grid-container3">
              <div class="tituloC">
               <strong>' . $row[0][1] . '</strong>
              </div>
              <div class="descripcionC">
                    <p>' . $row[0][5] . '</p>
              </div>
              <div class="fechaC">
                    <p><b>Fecha de publicación</b>: ' . $row[0][3] . '</p>
                    <p><b>Fecha de fin</b>: ' . $row[0][4] . '</p>
              </div>
              <div class="autorC">
              <i class="fas fa-user-edit"></i>
                    <span>' . $row[0][6] . '</span>
              </div>
              <div class="boton botonC">                  
                    <input type="text" value=' . $row[0][2] . ' id="input" disabled>
                    <button onclick="cpy()">Copy text</button>  
              </div>
            </div>
              
            ';
        ?>     
    </body>  
</html> 