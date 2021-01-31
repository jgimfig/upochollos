<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>

<aside class="aside">
    <h2 class='col-sm-12'>Categorias</h2>
    <?php
    $consulta = ("select * from categoria");
    $categoria = consulta($consulta);
    for ($i = 0; $i < count($categoria); $i++) {
        echo  '<div class="col-sm-4 asideCategoria" onclick="filtrado(`'.$categoria[$i][0].'`);"  style="background-color:' . $categoria[$i][2] . '; border: 2px solid '. $categoria[$i][1].'"><p class="asideCategoria">'. $categoria[$i][0] .'</p></div>';
    }
    ?>
    <br/><br/><h2 class='col-sm-12'>Tiendas</h2>
    <?php
    $consulta = ("select * from tienda");
    $tiendas = consulta($consulta);
    for ($i = 0; $i < count($tiendas); $i++) {
        echo '<img onclick="filtrado(`'.$tiendas[$i][0].'`);" class="asideTienda col-sm-6" src="../img/tiendas/' . $tiendas[$i][1] . '"/>';
    }
    ?>
</aside>
<!--
echo  '<div class="col-sm-4 asideCategoria" onclick="filtrado("'.$categoria[$i][0].'")><a class="asideCategoria" style="background-color:"' . $categoria[$i][2] . '"; border: 2px solid "'. $categoria[$i][1].'">'. $categoria[$i][0] .'</a></div>';
-->