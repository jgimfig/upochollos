<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
session_start();
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
$row = consulta("SELECT * FROM `cupon` ORDER BY `fecha_publicado` DESC LIMIT $start_from, $record_per_page");

$output = "<article class='marco'>";
for($var=0;$var<count($row);$var++){
    $output .= '  
            <section>
              <div>
               <strong>' . $row[$var][1] . '</strong>
              </div>
              <div>
                    <p>' . $row[$var][5] . '</p>
              </div>
              <div>
                    <p>' . $row[$var][3] . '</p>
              </div>
              <div>
                    <p>' . $row[$var][4] . '</p>
              </div>
               <div>
                    <p>' . $row[$var][2] . '</p>
              </div>
              <div class="boton">                  
                    <form action="producto.php" method="GET">
                    <input type="hidden" name="idProducto" id="idProducto" value="' . $row[$var][0] . '">
                    <input type="submit" value="Ir al producto">
                    </form>
              </div>
            </section>';
}

$output .= '</article><br /><div align = "center">';

$page_query= consulta("SELECT * FROM `cupon` ORDER BY id DESC");
$total_records = count($page_query);
$total_pages = ceil($total_records / $record_per_page);
for ($i = 1; $i <= $total_pages; $i++) {
    $output .= "<span class='paginationCupon_link' style='cursor:pointer;
    padding:6px;
    border:1px solid #ccc;' id='" . $i . "'>" . $i . "</span>";
}
$output .= '</div><br /><br />';
echo $output;
?>  