<?php

require_once ("funciones.php");
session_start();
if (isset($_POST['comment_id']) && isset($_POST['comment']) && trim($_POST['comment_id']) != "" && trim($_POST['comment']) != "") {
    $commentarioPadreId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
    $commentario = isset($_POST['comment']) ? $_POST['comment'] : "";
    $id = $_SESSION["idProducto"];

    $sql = "INSERT INTO `comentario`(`id`,`id_producto`,`usuario`,`texto`,`fecha`,`id_comentario_padre`) VALUES (NULL,'" . $id . "','" . getNombreUsuario() . "','" . $commentario . "','" . date('Y-m-d') . "','" . $commentarioPadreId . "')";

    echo consulta($sql);
} else {
    echo "<script>
                    alert('No está permitido añadir comentarios vacios.');
                    window.location.href='./principal.php';
                    </script>";
}
?>
