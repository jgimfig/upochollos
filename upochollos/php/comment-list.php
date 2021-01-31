<?php

require_once ("funciones.php");
session_start();
$con = mysqli_connect(HOST, USUARIO_BD, CONTRASENA_BD, NOMBRE_BD);
$id = $_SESSION["idProducto"];
$sql = "SELECT * FROM `comentario` where `id_producto`='" . $id . "' ORDER BY `id_comentario_padre` asc, `id` asc";
$result = mysqli_query($con, $sql);
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);

mysqli_close($con);
//print_r( $record_set);
echo json_encode($record_set);
?>