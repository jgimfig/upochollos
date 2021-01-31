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
            <div  class="grid-container3">
              <div class="tituloC">
               <strong>' . $row[$var][1] . '</strong>
              </div>
              <div class="descripcionC">
                    <p>' . $row[$var][5] . '</p>
              </div>
              <div class="fechaC">
                    <p><b>Fecha de publicación</b>: ' . $row[$var][3] . '</p>
                    <p><b>Fecha de fin</b>: ' . $row[$var][4] . '</p>
              </div>
              <div class="autorC">
              <i class="fas fa-user-edit"></i>
                    <span>' . $row[$var][6] . '</span>
              </div>
              <div class="boton botonC">                  
                    <form action="cupon.php" method="GET">
                    <input type="hidden" name="idCupon" id="idCupon" value="' . $row[$var][0] . '">
                    <button class="botonI">Ir al cupón</button>
                    </form>
              </div>
            </div>';
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