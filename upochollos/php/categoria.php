<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (!getAdministrador())
    header('location: ./principal.php');

if (isset($_GET['eliminar'])) {
    $query = "delete from categoria where nombre='" . $_GET['ncategoria'] . "'";
    if (!consulta($query))
        echo "<script>alert('No se puede eliminar ya que hay un producto asociado a dicha categoria');</script>";
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

        <!--ESTILOS PROPIOS DE LOGIN-->
        <link href="../css/estiloCategoria.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../css/estiloPagina.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php
        include 'libreriasJS.php';
        include 'header.php';
        ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECIFICAS DE LA PAGINA DE USUARIO-->
        <script type='text/javascript' src='../js/comprobacionLogin.js'></script>
        <script type='text/javascript' src='../js/categoria.js'></script>

    </head>
    <body>
        <main>
            <div id="gestion">
                <h2>Gestión de categorias</h2>
                <form name="fcategoria" method="POST" action="crud.php">
                    <p>Nombre Categoria:</p>
                    <input class="input" type="text" name="ncategoria" id="ncategoria"/>
                    <p>Color Borde:</p>
                    <input type="color" id="icolorBorde" name="colorBorde"/></br></br>
                    <p>Color Fondo:</p>
                    <input type="color" id="icolorFondo" name="colorFondo"/></br></br>
                    <input class="enviar" id="crear" name="modificarCategoria" type="submit" value="Crear/Editar"/>
                </form>
            </div>
            <div id="tiendas">
                <table>
                    <tbody id="tablaTiendas">
                        <tr>
                            <th>Nombre</th>
                            <th>Color Borde</th>
                            <th>Color Fondo</th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php
                        $consulta = ("select * from categoria");
                        $categoria = consulta($consulta);
                        for ($i = 0; $i < count($categoria); $i++) {
                            echo "<tr>"
                            . "<td>" . $categoria[$i][0] . "</td>"
                            . "<td class='color' style='color:" . $categoria[$i][1] . "'>" . $categoria[$i][1] . "</td>"
                            . "<td class='color' style='color:" . $categoria[$i][2] . "'>" . $categoria[$i][2] . "</td>"
                            . "<td><button class='enviar' onclick=editar(this)>Editar</button></td>";
                            ?>
                        <form action="crud.php" method="post" >
                            <?php
                            echo "<input name='ncategoria' type='hidden' value=" . $categoria[$i][0] . ">";
                            echo "<td><input class='enviar' name='eliminarCategoria' type='submit' value='Eliminar'/></td>";
                            ?></form><?php
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
                    <?php
//INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
</html>


