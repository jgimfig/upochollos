<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (!getAdministrador())
    header('location: ./principal.php');

if (isset($_GET['eliminar'])) {
    $query = "delete from cupon where id='" . $_GET['id'] . "'";
    if (!consulta($query))
        echo "<script>alert('No se ha podido borrar el cupon');</script>";
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
    </head>
    <body>
        <main style="border-top: solid rgba(248,181,0,1) 1px">
            <div class="container">
                <table id="responsive-table" class="large-only" cellspacing="0">
                    <tbody>
                        <tr align="left" style="text-align: center">
                            <th width="0%">ID</th>
                            <th width="15%">Nombre</th>
                            <th width="15%">Codigo</th>
                            <th width="30%">Descripción</th>
                            <th width="10%">Usuario</th>
                            <th width="10%">Fecha publicación</th>
                            <th width="10%">Fecha Vencimiento</th>
                            <th width="10%">Eliminar</th>
                        </tr>
                        <?php
                        $consulta = ("select * from cupon");
                        $cupon = consulta($consulta);
                        for ($i = 0; $i < count($cupon); $i++) {
                            echo "<tr>"
                            . "<td>" . $cupon[$i][0] . "</td>"
                            . "<td>" . $cupon[$i][1] . "</td>"
                            . "<td>" . $cupon[$i][2] . "</td>"
                            . "<td>" . $cupon[$i][5] . "</td>"
                            . "<td>" . $cupon[$i][6] . "</td>"
                            . "<td>" . $cupon[$i][3] . "</td>"
                            . "<td>" . $cupon[$i][4] . "</td>"
                            ?>
                        <form action="crud.php" method="post" >
                            <?php
                            echo "<input name='id' type='hidden' value=" . $cupon[$i][0] . ">";
                            echo "<td><input class='enviar' name='eliminarCupon' type='submit' value='Eliminar'/></td>";
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
                        <?php
//INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
    </body>
</html>


