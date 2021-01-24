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

        <!--ESTILOS PROPIOS DE COMUNIDAD-->
        <link rel="stylesheet" type="text/css" href="./css/estiloComunidad.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->

        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DE COMUNIDAD-->


        <script>
            function validacion() {
                var noFallo = true;

                if ($('#nombre').val().length === 0) {
                    $('#nombre').style.borderColor = "red";
                    $('#nombre').value = "Error, debe rellenar el nombre";
                    $('#nombre').style.color = "red";
                    noFallo = false;
                }

                if ($('#descripcion').val().length === 0) {
                    $('#descripcion').style.borderColor = "red";
                    $('#descripcion').value = "Error, debe rellenar la descripción";
                    $('#descripcion').style.color = "red";
                    noFallo = false;
                }

                if ($('#precioOriginal').val().length === 0 || (is_numeric($('#precioOriginal').val()) && $('#precioOriginal').val() >= 0 && ctype_digit($('#precioOriginal').val()))) {
                    $('#precioOriginal').style.borderColor = "red";
                    $('#precioOriginal').value = "Error, debe rellenar el precio original correctamente. Debe introducir un numero positivo.";
                    $('#precioOriginal').style.color = "red";
                    noFallo = false;
                }

                if ($('#precioDescuento').val().length === 0 || (is_numeric($('#precioDescuento').val()) && $('#precioDescuento').val() >= 0 && ctype_digit($('#precioDescuento').val()))) {
                    $('#precioDescuento').style.borderColor = "red";
                    $('#precioDescuento').value = "Error, debe rellenar el precio con descuento correctamente. Debe introducir un numero positivo.";
                    $('#precioDescuento').style.color = "red";
                    noFallo = false;
                }

                if ($('#precioDescuento').val() < $('#precioOriginal').val()) {
                    $('#precioDescuento').style.borderColor = "red";
                    $('#precioDescuento').value = "El precio del descuento debe ser inferior al original";
                    $('#precioDescuento').style.color = "red";
                    noFallo = false;
                }

                if (validacionFoto()) {
                    noFallo = false;
                }

                if ($('#url').val().length === 0 || !is_url($('#url').val())) {
                    noFallo = false;
                }
                return noFallo;
            }
            function validacionFoto() {
                if ($("#imagen").value == '') {
                    $("#imagen").style.borderColor = "red";
                    $("#imagen").value = "Error, debe subir una imagen del producto";
                    $("#imagen").style.color = "red";
                    return true;
                } else {
                    if (typeof ($("#imagen").files) != "undefined") {
                        var Extension = $("#imagen").value.substring($("#imagen").value.lastIndexOf('.') + 1).toLowerCase();
                        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {

                            var size = parseFloat($("#imagen").files[0].size / (1024 * 1024)).toFixed(2);
                            if (size > 4) {
                                $("#imagen").style.borderColor = "red";
                                $("#imagen").value = "Por favor, selecciona una imagen que pese menos de 4 MB";
                                $("#imagen").style.color = "red";
                                return true;
                            } else {
                                return false;
                            }
                        }
                    } else {
                        $("#imagen").style.borderColor = "red";
                        $("#imagen").value = "Seleccione un archivo con extensión de una fotografía";
                        $("#imagen").style.color = "red";
                        return true;
                    }
                }
                else {
                    alert("This browser does not support HTML5.");
                }
            }
            function is_url(str) {
                regexp = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
                if (regexp.test(str))
                {
                    return true;
                } else
                {
                    $("#url").style.borderColor = "red";
                    $("#url").value = "Por favor, escriba una URL correcta";
                    $("#url").style.color = "red";
                    return false;
                }
            }
        </script>
    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        //include 'header.php';
        ?>

        <form action="create.php" enctype="multipart/form-data" method="POST" onsubmit="return validacion();">
            Intoducir nombre del producto: <input type="text" id="nombre"/><br><br>

            Intoducir descripción del producto:<textarea id="descripcion"  rows="4" cols="50"></textarea><br/><br/>

            Intoducir enlace: <input type="url"  id="enlace"/><br/><br/>

            Intoducir el precio original: <input type="number"  id="precioOriginal"/><br/><br/>

            Intoducir el precio con el descuento: <input type="number"  id="precioDescuento"/><br/><br/>

            <label for="fecha_vencimiento">Fecha Vencimiento:</label>

            <input type="date" id="fecha_vencimiento" value=<?php echo "'" . date('Y-m-d', strtotime("+1 week")) . "'"; ?> min=<?php echo "'" . date('Y-m-d') . "'"; ?>><br/><br/>

            Seleccione la tienda donde se vende el producto: 
            <select id="tienda" required>
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
            <select id="categoria" required>
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

            Selecciona la imagen que desea subir: <input type="file" name="imagen" id="imagen"><br/><br/>

            <input type="button" id="btnCrear" name="crearProducto" value="Crear Producto"><br/><br/>
        </form>			

        <!--NCLUIMOS EL ASIDE CON LA PUBLICIDAD Y UN BOTÓN DE SUBIR A LA CABECERA -->
        <?php
//        include './php/aside.php';
//        include './php/subir.php';
        ?>
    </div>
    <?php
    //INCLUIMOS EL FOOTER
//    include './php/footer.php';
    ?>
</body>

</html>