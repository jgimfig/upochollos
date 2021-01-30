<?php

//CONSTANTES PARA LA CONEXIÓN CON LA BASE DE DATOS
define("HOST", "localhost");
define("USUARIO_BD", "root");
define("CONTRASENA_BD", "");
define("NOMBRE_BD", "upochollo");

/*
 * FUNCIÓN: consulta()
 *   - Recibe un string con una sentencia SQL
 *   - Ejecuta la sentencia sobre la base de datos
 *   - Devuelve un array con los resultados o booleano según el tipo de clausula urilizada
 */

function consulta($consulta) {

    $con = mysqli_connect(HOST, USUARIO_BD, CONTRASENA_BD, NOMBRE_BD);

    if ($con) {
        mysqli_set_charset($con, 'utf8');
        $resultadoConsulta = mysqli_query($con, $consulta);

        if ($resultadoConsulta === true) {
            mysqli_close($con);
            return true;
        }

        if ($resultadoConsulta) {
            $res = mysqli_fetch_all($resultadoConsulta);
            mysqli_close($con);
            return $res;
        }
        mysqli_close($con);
    }
    return false;
}

function registrarUsuario($usuario, $passwd, $email, $tipo) {

    $hash = password_hash($passwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario(usuario, hash, email, tipo, foto) VALUES ('$usuario','$hash','$email','$tipo', NULL)";

    return consulta($sql);
}

/*
 * FUNCIÓN: comprobarLogin()
 *   - Recibe dos strings opcionales, usuario y contraseña
 *   - Realiza la consulta pertinente a la base datos para iniciar la sesión 
 *     del usuario. Si no se especifica algún parametro, se intentará usar 
 *     los datos de la sesión activa, si la hubiera.
 *   - Devuelve un booleano que indica si el usuario ha podido iniciado sesión
 */

function comprobarLogin($usuario = "", $passwd = "") {

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_SESSION['usuario']) && isset($_SESSION['tipo'])) {
        return true;
    }

    $sql = "SELECT * FROM usuario WHERE usuario='$usuario'";

    $resul = consulta($sql);

    if ($resul && count($resul) > 0) {
        $pass = password_verify($passwd, $resul[0][2]);

        if ($pass) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $resul[0][4];
            return true;
        }
    }
    return false;
}

function getNombreUsuario() {

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (comprobarLogin()) {
        return $_SESSION['usuario'];
    }

    return "";
}

function getAdministrador() {

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (comprobarLogin()) {
        if ($_SESSION['tipo'] == "admin")
            return true;
        else
            return false;
    }
    return false;
}

/*
 * FUNCIÓN: getURLImagenUsuario()
 *   - No recibe parámetro alguno
 *   - Realiza una petición a la base de datos para obtener la URL de la foto
 *     de perfil del usuario.
 *   - Devuelve la URL de la foto de perfil del usuario
 */

function getURLImagenUsuario() {

    $usuario = getNombreUsuario();

    $img = consulta("SELECT foto FROM usuario WHERE usuario = '$usuario'")[0][0];

    if ($img === NULL) {
        return '../img/iconos/user.png';
    } else {
        return "../img/usuarios/$img";
    }
}

/*
 * FUNCIÓN: registrarProducto()
 *   - Recibe como parametros de entrada 
 *   - Inserta un nuevo producto.
 *   - Devuelve un boolean de si se ha instado correcctamente
 */

function registrarProducto($nombre, $descripcion, $enlace, $precioOriginal, $precioDescuento, $fechaVencimiento, $tienda, $categoria, $imagen) {

    $sql = 'INSERT INTO `producto` (`id`, `enlace`, `precio_original`, `nombre`, `fecha_publicado`, `fecha_vencimiento`, `precio_descuento`, `descripcion`, `imagen`, `usuario`, `nombre_categoria`, `nombre_tienda`) VALUES (NULL, "' . $enlace . '" , "' . $precioOriginal . '", "' . $nombre . '", "' . date('Y-m-d') . '", "' . $fechaVencimiento . '", "' . $precioDescuento . '", "' . $descripcion . '", "' . $imagen . '", "' . getNombreUsuario() . '", "' . $categoria . '", "' . $tienda . '");';

    return consulta($sql);
}

function modificarProducto($nombre, $descripcion, $enlace, $precioOriginal, $precioDescuento, $fechaVencimiento, $tienda, $categoria, $imagen, $id) {

    $sql = 'UPDATE `producto` SET `enlace`="' . $enlace . '", `precio_original`="' . $precioOriginal . '", `nombre`="' . $nombre . '", `fecha_publicado`="' . date('Y-m-d') . '", `fecha_vencimiento`="' . $fechaVencimiento
            . '", `precio_descuento`="' . $precioDescuento . '", `descripcion`="' . $descripcion
            . '", `imagen`="' . $imagen . '", `nombre_categoria`="' . $categoria . '", `nombre_tienda`="' . $tienda . '" WHERE `id`=' . $id;
    return consulta($sql);
}

function eliminarProducto($id) {
    $sql = "DELETE FROM `producto` WHERE id='" . $id . "';";

    return consulta($sql);
}

function getImagenProducto($id) {
    $sql = "SELECT imagen FROM `producto` WHERE `id`=" . $id;
    $resultado = consulta($sql);
    return $resultado[0];
}

function getUsuarioProducto($id) {
    $sql = "SELECT usuario FROM `producto` WHERE `id`=" . $id;
    $resultado = consulta($sql);

    return implode("", $resultado[0]);
}

function getUsuarioCupon($id) {
    $sql = "SELECT usuario FROM `cupon` WHERE `id`=" . $id;
    $resultado = consulta($sql);

    return implode("", $resultado[0]);
}

function getProducto($id) {
    $sql = 'SELECT * FROM `producto` WHERE `id`=' . $id;
    return consulta($sql);
}

function eliminarCategoria($nombre) {
    $query = "delete from categoria where nombre='" . $nombre . "'";
    return consulta($query);
}

function modificarCategoria($nombre, $colorBorde, $colorFondo) {
    $query = "INSERT INTO categoria (nombre, color_borde, color_fondo) VALUES('" . $nombre . "','" . $colorBorde . "','" . $colorFondo . "') ON DUPLICATE KEY UPDATE    
 color_borde='" . $colorBorde . "', color_fondo='" . $colorFondo . "'";
    return consulta($query);
}

function getCupon($id) {
    $sql = 'SELECT * FROM `cupon` WHERE `id`=' . $id;
    return consulta($sql);
}

function registrarCupon($id, $nombre, $codigo, $fechaPublicado, $fechaVencimiento, $descripcion) {

    $sql = 'INSERT INTO `cupon` (`id`, `nombre`, `codigo`, `fecha_publicado`, `fecha_vencimiento`, `descripcion`,`usuario`) VALUES ("' . $id . '", "' . $nombre . '" , "' . $codigo . '", "' . $fechaPublicado . '", "' . $fechaVencimiento . '", "' . $descripcion . '", "' . getNombreUsuario() . '") ON DUPLICATE KEY UPDATE    
nombre="' . $nombre . '",codigo="' . $codigo . '",fecha_publicado="' . $fechaPublicado . '",fecha_vencimiento="' . $fechaVencimiento . '",descripcion="' . $descripcion . '"';
    return consulta($sql);
}

function eliminarCupon($id) {
    $query = "delete from cupon where id='" . $id . "'";
    return consulta($query);
}

