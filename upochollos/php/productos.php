<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (!getAdministrador())
    header('location: ./principal.php');

?>
<!DOCTYPE html>

<html>
    <head>
        <title>UpoChollos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS DE CUPON-->
        <link rel="stylesheet" type="text/css" href="../css/estiloPagina.css">
        <link href="../css/estiloCupon.css" rel="stylesheet" type="text/css"/>
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php
        include 'libreriasJS.php';
        include 'header.php';
        ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECIFICAS DE LA PAGINA DE USUARIO-->
        <script type='text/javascript' src='../js/comprobacionLogin.js'></script>
        <script type='text/javascript' src='../js/categoria.js'></script>
        <script type='text/javascript' src='https://raw.githubusercontent.com/johnpolacek/stacktable.js/master/stacktable.js'></script>
        <script>
            $('#responsive-table').stacktable({myClass: 'stacktable small-only'});
        </script>
    </head>
    <body>
        <main>
            <div class="container">
                <table id="responsive-table" class="large-only" cellspacing="0">
                    <tbody>
                        <tr align="left" style="text-align: center">
                            <th width="0%">ID</th>
                            <th width="15%">Nombre</th>
                            <th width="15%">Enlace</th>
                            <th width="30%">Descripción</th>
                            <th width="10%">Usuario</th>
                            <th width="10%">Fecha publicación</th>
                            <th width="10%">Fecha Vencimiento</th>
                            <th width="5%">Categoria</th>
                            <th width="5%">Tienda</th>
                            <th width="10%">Eliminar</th>
                        </tr>
                        <?php
                        $consulta = ("select * from producto");
                        $producto= consulta($consulta);
                        for ($i = 0; $i < count($producto); $i++) {
                            echo "<tr>"
                            . "<td>" . $producto[$i][0] . "</td>"
                            . "<td>" . $producto[$i][3] . "</td>"
                            . "<td>" . $producto[$i][1] . "</td>"
                            . "<td>" . $producto[$i][7] . "</td>"
                            . "<td>" . $producto[$i][9] . "</td>"
                            . "<td>" . $producto[$i][4] . "</td>"
                            . "<td>" . $producto[$i][5] . "</td>"
                            . "<td>" . $producto[$i][10] . "</td>"
                            . "<td>" . $producto[$i][11] . "</td>"
                            ?>
                        <form action="crud.php" method="post" >
                            <?php
                            echo "<input name='id' type='hidden' value=" . $producto[$i][0] . ">";
                            echo "<td><input class='enviar' name='btnBorrar' type='submit' value='Eliminar'/></td>";
                            ?></form><?php
                        echo "</tr>";
                    }
                    echo '</tbody>
                        </table>
                      </div>';
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>


