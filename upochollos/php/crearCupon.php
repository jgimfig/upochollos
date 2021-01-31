<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (getNombreUsuario() == "") {
    header('location: ./principal.php');
}
?>
<div align="center" id="cupon" onsubmit="return comprobarCupon();">
    <form name="fcategoria" method="POST" action="crud.php">
        <p>Nombre Cupón:</p>
        <input type="text" class="ip4" name="cnombre" id="nombre"  required/>
        <p>Código Cupón:</p>
        <input type="text" class="ip4" name="ccodigo" id="codigo"  required/>
        <p>Fecha publicación:</p>
        <input type="date" name="cFechaPublicacion" id="FechaPublicacion" value=<?php echo "'" . date('Y-m-d') . "'"; ?> min=<?php echo "'" . date('Y-m-d') . "'"; ?>"/>
        <p>Fecha vencimiento:</p>
        <input type="date" name="cFechaVencimiento" id="FechaVencimiento" value=<?php echo "'" . date('Y-m-d', strtotime("+1 week")) . "'"; ?> min=<?php echo "'" . date('Y-m-d') . "'"; ?>/>
        <p>Descripcion:</p>
        <input type="text" name="cdescripcion" id="descripcion" class="ip4" required/>
        <br><br>
        <input class="btnProducto2" id="crear" name="btnCrearCupon" type="submit" value="Crear"/>
    </form>
</div>		
