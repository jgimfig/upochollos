<?php

include_once 'funciones.php';

if (isset($_POST["btnCrear"])) {
    if (isset($_POST['nombreInput']) && isset($_POST['descripcionInput']) && isset($_POST['enlaceInput']) && isset($_POST['precioOriginalInput']) && isset($_POST['precioDescuentoInput'])) {

        $nombre = filter_var($_POST['nombreInput'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_POST['descripcionInput'], FILTER_SANITIZE_STRING);
        $enlace = filter_var($_POST['enlaceInput'], FILTER_SANITIZE_URL);

        if ($nombre !== false && $descripcion !== false && $enlace !== false) {
            $nombreImagen = basename($_FILES["imagenInput"]["name"]);
            if (registrarProducto($nombre, $descripcion, $enlace, $_POST['precioOriginalInput'], $_POST['precioDescuentoInput'], $_POST['fechaVencimientoInput'], $_POST['tiendaInput'], $_POST['categoriaInput'], $nombreImagen)) {
                $target_dir = "../img/fotos/";
                $target_file = $target_dir . basename($_FILES["imagenInput"]["name"]);
                if (move_uploaded_file($_FILES['imagenInput']['tmp_name'], $target_file)) {
                    header('location: principal.php');
                } else {
                    echo "Imagen no cargada correctamente.";
                    $uploadOk = 0;
                }
            } else {
                echo " <script type='text/javascript'></script>";
            }
        }
    }
}
if (isset($_POST["btnBorrar"])) {
    $nombreImagen = getImagenProducto($_POST['id']);
    unlink('../img/fotos/' . $nombreImagen[0]);
    eliminarProducto($_POST["id"]);
    header('location: principal.php');
}

if (isset($_POST["btnModificar"])) {
    if (isset($_POST['nombreInput']) && isset($_POST['descripcionInput']) && isset($_POST['enlaceInput']) && isset($_POST['precioOriginalInput']) && isset($_POST['precioDescuentoInput'])) {

        $nombre = filter_var($_POST['nombreInput'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_POST['descripcionInput'], FILTER_SANITIZE_STRING);
        $enlace = filter_var($_POST['enlaceInput'], FILTER_SANITIZE_URL);

        if ($nombre !== false && $descripcion !== false && $enlace !== false) {
            $nombreImagen = basename($_FILES["imagenInput"]["name"]);
            $nombreImagenAntiguo = getImagenProducto($_POST['id']);
            if ($nombreImagen == "") {//No cambiar foto
                if (modificarProducto($nombre, $descripcion, $enlace, $_POST['precioOriginalInput'], $_POST['precioDescuentoInput'], $_POST['fechaVencimientoInput'], $_POST['tiendaInput'], $_POST['categoriaInput'], $nombreImagenAntiguo[0], $_POST['id'])) {
                    header('location: principal.php');
                } else {
                    echo " <script type='text/javascript'></script>";
                }
            } else if ($nombreImagen != $nombreImagenAntiguo) {//cambiar foto
                $target_dir = "../img/fotos/";
                unlink($target_dir . $nombreImagenAntiguo[0]);
                $target_file = $target_dir . basename($_FILES["imagenInput"]["name"]);
                if (!move_uploaded_file($_FILES['imagenInput']['tmp_name'], $target_file)) {
                    echo "La imagen no se ha guardado correctamente.";
                } else {
                    if (modificarProducto($nombre, $descripcion, $enlace, $_POST['precioOriginalInput'], $_POST['precioDescuentoInput'], $_POST['fechaVencimientoInput'], $_POST['tiendaInput'], $_POST['categoriaInput'], $nombreImagen, $_POST['id'])) {
                        header('location: principal.php');
                    } else {
                        echo " <script type='text/javascript'></script>";
                    }
                }
            }
        }
    }
}

if (isset($_POST['eliminarCategoria'])) {
    if (eliminarCategoria($_POST["ncategoria"])) {
        header('location: categoria.php');
    } else {
        echo " <script type='text/javascript'></script>";
    }
}

if (isset($_POST['modificarCategoria'])) {
    if (modificarCategoria($_POST["ncategoria"], $_POST["colorBorde"], $_POST["colorFondo"])) {
        header('location: categoria.php');
    } else {
        echo " <script type='text/javascript'></script>";
    }
}
?>

