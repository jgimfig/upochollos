<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
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
        
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DE COMUNIDAD-->
        <script src="../js/comprobacionProducto.js" type="text/javascript"></script>
    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        //include 'header.php';
        ?>

        <form action="crudProducto.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarProducto();">
            Intoducir nombre del producto: <input type="text" id="nombre" name="nombreInput"/><br><br>

            Intoducir descripción del producto:<textarea id="descripcion" name="descripcionInput" rows="4" cols="50"></textarea><br/><br/>

            Intoducir enlace: <input type="url" id="enlace" name="enlaceInput"/><br/><br/>

            Intoducir el precio original: <input type="text"  id="precioOriginal" name="precioOriginalInput"/><br/><br/>

            Intoducir el precio con el descuento: <input type="text"  id="precioDescuento" name="precioDescuentoInput"/><br/><br/>

            <label for="fechaVencimiento">Fecha Vencimiento:</label>

            <input type="date" id="fechaVencimiento" name="fechaVencimientoInput" value=<?php echo "'" . date('Y-m-d', strtotime("+1 week")) . "'"; ?> min=<?php echo "'" . date('Y-m-d') . "'"; ?>><br/><br/>

            Seleccione la tienda donde se vende el producto: 
            <select id="tienda" name="tiendaInput" required>
                <?php
                $result = consulta("SELECT * FROM `tienda`");
                if (count($result) > 0) { //si la variable tiene al menos 1 fila entonces seguimos con el codigo
                    $combobit = "<option value=''>Seleccionar la opción</option>";
                    for ($var = 0; $var < count($result); $var++) {
                        $combobit .= " <option value=\"{$result[$var][0]}\">{$result[$var][0]}</option>";
                    }
                }
                echo $combobit;
                ?>
            </select><br/><br/>

            Seleccione la categoria del producto: 
            <select id="categoria" name="categoriaInput" required>
                <?php
                $result = consulta("SELECT * FROM `categoria`");
                if (count($result) > 0) { //si la variable tiene al menos 1 fila entonces seguimos con el codigo
                    $combobit = "<option value=''>Seleccionar la opción</option>";
                    for ($var = 0; $var < count($result); $var++) {
                        $combobit .= " <option value=\"{$result[$var][0]}\">{$result[$var][0]}</option>";
                    }
                }
                echo $combobit;
                ?>
            </select><br><br>

            Selecciona la imagen que desea subir: <input type="file" id="imagen" name="imagenInput" ><br/><br/>

            <input type="submit" name="btnCrear" value="Crear Producto"/>
        </form>			
        <!--NCLUIMOS EL ASIDE CON LA PUBLICIDAD Y UN BOTÓN DE SUBIR A LA CABECERA -->
        <?php
        //include './php/aside.php';
        //include './php/subir.php';
        //INCLUIMOS EL FOOTER
        //include './php/footer.php';
        ?>
    </body>
</html>