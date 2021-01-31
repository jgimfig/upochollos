<?php

include_once 'funciones.php';

if (isset($_POST["btnCrear"])) {
    if (isset($_POST['nombreInput']) && isset($_POST['descripcionInput']) && isset($_POST['enlaceInput']) && isset($_POST['precioOriginalInput']) && isset($_POST['precioDescuentoInput'])) {

        $nombre = filter_var($_POST['nombreInput'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_POST['descripcionInput'], FILTER_SANITIZE_STRING);
        $enlace = filter_var($_POST['enlaceInput'], FILTER_SANITIZE_URL);

        if ($nombre !== false && $descripcion !== false && $enlace !== false) {
            $nombreImagen = basename($_FILES["imagenInput"]["name"]);
            if (registrarProducto(trim($nombre),trim($descripcion),trim($enlace),trim($_POST['precioOriginalInput']),trim($_POST['precioDescuentoInput']),trim($_POST['fechaVencimientoInput']),$_POST['tiendaInput'], $_POST['categoriaInput'], $nombreImagen)) {
                $target_dir = "../img/fotos/";
                $target_file = $target_dir . basename($_FILES["imagenInput"]["name"]);
                if (move_uploaded_file($_FILES['imagenInput']['tmp_name'], $target_file)) {
                    header('location: principal.php');
                } else {
                    echo "Imagen no cargada correctamente.";
                    $uploadOk = 0;
                }
            } else {
                echo "<script>
                    alert('No se ha podido crear el producto correctamente');
                    window.location.href='./principal.php';
                    </script>";
            }
        }
    }
}
if (isset($_POST["btnBorrar"])) {
    $nombreImagen = getImagenProducto($_POST['id']);
    unlink('../img/fotos/' . $nombreImagen[0]);
    eliminarProducto($_POST["id"]);
    if (getAdministrador()) {
        header('location: productos.php');
    } else
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
                if (modificarProducto(trim($nombre), trim($descripcion),trim($enlace),trim($_POST['precioOriginalInput']),trim($_POST['precioDescuentoInput']),trim($_POST['fechaVencimientoInput']),trim($_POST['tiendaInput']),trim($_POST['categoriaInput']),$nombreImagenAntiguo[0], $_POST['id'])) {
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
                    if (modificarProducto(trim($nombre),trim($descripcion),trim($enlace),trim($_POST['precioOriginalInput']),trim($_POST['precioDescuentoInput']), $_POST['fechaVencimientoInput'], $_POST['tiendaInput'], $_POST['categoriaInput'], $nombreImagen, $_POST['id'])) {
                        header('location: principal.php');
                    } else {
                        echo "<script>
                    alert('No se ha podido modificar el producto correctamente');
                    window.location.href='./principal.php';
                    </script>";
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
        echo "<script>
                    alert('No se ha podido eliminar la categoria correctamente.Puede que esté asociada a un producto');
                    window.location.href='./categoria.php';
                    </script>";
    }
}

if (isset($_POST['modificarCategoria'])) {
    if(isset($_POST['ncategoria'])&& trim($_POST['ncategoria'])!="") {
        if (modificarCategoria(trim($_POST["ncategoria"]), $_POST["colorBorde"], $_POST["colorFondo"])) {
            header('location: categoria.php');
        } else {
            echo "<script> alert('No se ha podido modificar la categoria correctamente'); window.location.href='./categoria.php'; </script>";
        }
    }else {
            echo "<script> alert('No está permitido poner campos vacios.'); window.location.href='./categoria.php'; </script>";
        }
}
if (isset($_POST["btnCrearCupon"])) {
    if (isset($_POST['cnombre']) && isset($_POST['ccodigo']) && isset($_POST['cFechaPublicacion']) && isset($_POST['cFechaVencimiento']) && isset($_POST['cdescripcion'])) {
        $nombre = filter_var($_POST['cnombre'], FILTER_SANITIZE_STRING);
        $codigo = filter_var($_POST['ccodigo'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_POST['cdescripcion'], FILTER_SANITIZE_STRING);
        if ($nombre !== false && $descripcion !== false && $codigo !== false) {
            if (isset($_POST['cId'])) {
                if (registrarCupon($_POST['cId'],trim($nombre),trim($codigo), $_POST['cFechaPublicacion'], $_POST['cFechaVencimiento'],trim($descripcion))) {
                    header('location: principal.php');
                } else {
                    echo "<script>
                    alert('No se ha podido añadir el cupón correctamente');
                    window.location.href='./principal.php';
                    </script>";
                }
            } else {
                if (registrarCupon(NULL,trim($nombre),trim($codigo), $_POST['cFechaPublicacion'], $_POST['cFechaVencimiento'],trim($descripcion))) {
                    header('location: principal.php');
                } else {
                    echo "<script>
                    alert('No se ha podido añadir el cupón correctamente');
                    window.location.href='./principal.php';
                    </script>";
                }
            }
        }
    }
}
if (isset($_POST['eliminarCupon'])) {
    if (eliminarCupon($_POST["id"])) {
        if (getAdministrador()) {
            header('location: cupones.php');
        } else
            header('location: principal.php');
    } else {
        echo "<script>
                    alert('No se ha podido eliminar el cupón');
                    window.location.href='./principal.php';
                    </script>";
    }
}

if (isset($_POST['rating'])) {
    if (getUsuarioPuntua($_POST["idProducto"]) == 0) {
        if (getNombreUsuario() != "") {
            if (puntuar($_POST["idProducto"], $_POST["rating"])) {
                echo "<script>
                    alert('Se ha guardado la puntuacion correctamente');
                    window.location.href='./principal.php';
                    </script>";
            } else {
                echo "<script>
                    alert('No se ha guardado la puntuacion correctamente');
                    window.location.href='./principal.php';
                    </script>";
            }
        } else {
            echo "<script>
                    alert('Debes de estar logueado para puntuar.');
                    window.location.href='./principal.php';
                    </script>";
        }
    } else {
        echo "<script>
                alert('Solo se puede puntuar un producto 1 vez.');
                window.location.href='./principal.php';
                </script>";
    }
}
?>

