<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>
<?php

$record_per_page = 2;
$page = '';

if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $record_per_page;
$row = consulta("SELECT * FROM `producto` ORDER BY `fecha_publicado` DESC LIMIT $start_from, $record_per_page");

$output = "<article class='marco'>";
for($var=0;$var<count($row);$var++){
    $output .= '  
            <section class="grid-container">
              <div class="fotoG">
                <img class="fotoGrid" src="../img/fotos/'.$row[$var][8].'" alt="'.$row[$var][3].'">
              </div>
              <div class="titulo">
               <strong>' . $row[$var][3] . '</strong>
              </div>
              <div class="precio">
                <span>
                    <span>' . $row[$var][6] . '</span>
                    <span>' . $row[$var][2] . '</span>
                    <span>' . $row[$var][11] . '</span>
                </span>
              </div>
              <div class="descripcion">
                <div>
                    <p>' . $row[$var][7] . '</p>
                </div>
              </div>
              <div class="autor">
                <span>
                    <i class="fas fa-user-edit"></i>
                    <p>' . $row[$var][9] . '</p>
                </span>
              </div>
              <div class="boton">                  
                    <form action="producto.php" method="GET">
                    <input type="hidden" name="idProducto" id="idProducto" value="' . $row[$var][0] . '">
                    <input type="submit" value="Ir al producto">
                    </form>
              </div>
            </section>
';
}

$output .= '</article><br /><div align = "center">';

$page_query= consulta("SELECT * FROM `producto` ORDER BY id DESC");
$total_records = count($page_query);
$total_pages = ceil($total_records / $record_per_page);
for ($i = 1; $i <= $total_pages; $i++) {
    $output .= "<span class='pagination_link' style='cursor:pointer;
    padding:6px;
    border:1px solid #ccc;' id='" . $i . "'>" . $i . "</span>";
}
$output .= '</div><br /><br />';
echo $output;
?>  