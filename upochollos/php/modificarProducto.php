<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

if (getNombreUsuario() == "" && !isset($_POST["idCupon"])) {
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
        <link href="../css/estiloCrearProducto.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloPagina.css" rel="stylesheet" type="text/css"/>
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DE COMUNIDAD-->
        <script src="../js/comprobacionProducto.js" type="text/javascript"></script>
    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include 'header.php';
        $var = getProducto($_POST['id']);
        ?>
        
        <form action="crud.php" method="post" enctype="multipart/form-data" class="grid-container" onsubmit="return comprobarModificacionProducto();">
            <div class="nombreDiv ip2">
                Intoducir nombre del producto<br><br><input type="text" id="nombre" name="nombreInput" class="ip" value= <?php echo "'" . $var[0][3] . "'"; ?>/>
            </div>
            <div class="enlaceDiv ip2">
                Intoducir enlace<br><br><input type="url" id="enlace" name="enlaceInput" class="ip" value= <?php echo "'" . $var[0][1] . "'"; ?>/>
            </div>
            <div class="descripcionDiv ip2">
                Intoducir descripción del producto<br><br><textarea id="descripcion" name="descripcionInput" rows="4" cols="50" class="ip"><?php echo $var[0][7]; ?></textarea>
            </div>
            <div class="precioOriginalDiv ip2">
                Intoducir el precio original<br><br><input type="text"  id="precioOriginal" name="precioOriginalInput" class="ip" value= <?php echo "'" . $var[0][2] . "'"; ?>/>
            </div>
            <div class="precioDescuentoDiv ip2">
                Intoducir el precio con el descuento<br><br><input type="text"  id="precioDescuento" name="precioDescuentoInput" class="ip" value= <?php echo "'" . $var[0][6] . "'"; ?>/>
            </div>
            <div class="fechaVencimientoDiv ip2">
                <label for="fechaVencimiento">Fecha Vencimiento</label><br><br>
                <input type="date" id="fechaVencimiento" name="fechaVencimientoInput" value= <?php echo "'" . $var[0][5] . "'"; ?> min=<?php echo "'" . date('Y-m-d') . "'"; ?>><br/><br/>
            </div>
            <div class="tiendaDiv ip2">
                Seleccione la tienda donde se vende el producto<br><br>
                <div class="select">
                    <select id="tienda" name="tiendaInput" required>
                        <?php
                        $result = consulta("SELECT * FROM `tienda`");
                        if (count($result) > 0) { //si la variable tiene al menos 1 fila entonces seguimos con el codigo
                            $combobit = "<option value=''>Seleccionar la opción</option>";
                            for ($i = 0; $i < count($result); $i++) {
                                if ($result[$i][0] == $var[0][11]) {
                                    $combobit .= " <option value=\"{$result[$i][0]}\" selected>{$result[$i][0]}</option>";
                                } else
                                    $combobit .= " <option value=\"{$result[$i][0]}\">{$result[$i][0]}</option>";
                            }
                        }
                        echo $combobit;
                        ?>
                    </select>
                </div>
            </div>
            <div class="categoriaDiv ip2">
                Seleccione la categoria del producto<br><br>
                <div class="select">
                    <select id="categoria" name="categoriaInput" required>
                        <?php
                        $result = consulta("SELECT * FROM `categoria`");
                        if (count($result) > 0) { //si la variable tiene al menos 1 fila entonces seguimos con el codigo
                            $combobit = "<option value=''>Seleccionar la opción</option>";
                            for ($i = 0; $i < count($result); $i++) {
                                if ($result[$i][0] == $var[0][10]) {
                                    $combobit .= " <option value=\"{$result[$i][0]}\" selected>{$result[$i][0]}</option>";
                                } else
                                    $combobit .= " <option value=\"{$result[$i][0]}\">{$result[$i][0]}</option>";
                            }
                        }
                        echo $combobit;
                        ?>
                    </select>
                </div>
            </div>
            <div class="imagenDiv ip2">
                Selecciona la imagen que desea subir<br><br>
                <img  height="100px" width="100px" src=<?php echo '"../img/fotos/' . $var[0][8] . '"'; ?> alt=<?php echo $var[0][3]; ?> />
                <input  type="file" id="imagen" name="imagenInput">
            </div>
            
            <input type="hidden"  name="id" value=<?php echo $_POST["id"]; ?>>
            
            <div class="btnCrearDiv ip3">
                <input type="submit" name="btnModificar" class="btnProducto" value="Modificar Producto"/>
            </div>    
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