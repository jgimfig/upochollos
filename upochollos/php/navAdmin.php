<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>

<?php
// Si el usuario que ha iniciado sesión es un administardor, le aparecerá .
// En caso contrario se muestra una imagen genérica y la opción de inciar sesión
if (getAdministrador()) {
    ?>
    <nav class='navAdmin'>
        <ul class='ulNav'>
            <li class='liNav' onclick="location.href ='./categoria.php'"><p>ADMINISTAR CATEGORÍAS</p></li>
            <li class='liNav' onclick="location.href ='./tienda.php'"><p>ADMINISTAR TIENDA</p></li>
            <li class='liNav' onclick="location.href ='./'"><p>ADMINISTAR CUPONES</p></li>
            <li class='liNav' onclick="location.href ='./'"><p>ADMINISTAR ANUNCIOS</p></li>
        </ul>
    </nav>
    <?php
}
?>


