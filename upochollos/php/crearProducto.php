<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>

<form action="crudProducto.php" method="post" enctype="multipart/form-data" class="grid-container" onsubmit="return comprobarProducto();">
    <div class="nombreDiv ip2">
        Intoducir nombre del producto<br><br><input type="text" id="nombre" name="nombreInput" class="ip"/>
    </div>
    <div class="enlaceDiv ip2">
        Intoducir enlace<br><br><input type="url" id="enlace" name="enlaceInput" class="ip"/>
    </div>
    <div class="descripcionDiv ip2">
        Intoducir descripción del producto<br><br><textarea id="descripcion" name="descripcionInput" rows="4" cols="50" class="ip"></textarea>
    </div>
    <div class="precioOriginalDiv ip2">
        Intoducir el precio original<br><br><input type="text"  id="precioOriginal" name="precioOriginalInput" class="ip"/>
    </div>
    <div class="precioDescuentoDiv ip2">
        Intoducir el precio con el descuento<br><br><input type="text"  id="precioDescuento" name="precioDescuentoInput" class="ip"/>
    </div>
    <div class="fechaVencimientoDiv ip2">
        <label for="fechaVencimiento">Fecha Vencimiento</label><br><br>
        <input type="date" id="fechaVencimiento" name="fechaVencimientoInput" value=<?php echo "'" . date('Y-m-d', strtotime("+1 week")) . "'"; ?> min=<?php echo "'" . date('Y-m-d') . "'"; ?>><br/><br/>
    </div>
    <div class="tiendaDiv ip2">
        Seleccione la tienda donde se vende el producto<br><br>
        <div class="select">
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
                    for ($var = 0; $var < count($result); $var++) {
                        $combobit .= " <option value=\"{$result[$var][0]}\">{$result[$var][0]}</option>";
                    }
                }
                echo $combobit;
                ?>
            </select>
        </div>
    </div>
    <div class="imagenDiv ip2">
        Selecciona la imagen que desea subir<br><br><input type="file" id="imagen" name="imagenInput" >
    </div>
    <div class="btnCrearDiv ip3">
        <input type="submit" name="btnCrear" class="btnProducto" value="Crear Producto"/>
    </div>    
</form>			
