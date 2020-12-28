<?php

//CONSTANTES PARA LA CONEXIÓN CON LA BASE DE DATOS
define("HOST", "localhost");
define("USUARIO_BD", "root");
define("CONTRASENA_BD", "");
define("NOMBRE_BD", "upochollos");

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

/*
 * FUNCIÓN: registrarUsuario()
 *   - Recibe cuatro strings con el nombre de usuario, la contraseña, su email y el tipo de usuario
 *   - Realiza la consulta pertinente a la base datos para dar de alta a un usuario en el sistema
 *   - Devuelve un booleano que indica el exito/fracaso de la operación
 */

function registrarUsuario($usuario, $passwd, $email, $tipo) {

    $hash = password_hash($passwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario(nombre_usuario, contrasenya, email, tipo_usuario, imagen) VALUES ('$usuario','$hash','$email','$tipo', NULL)";

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

    $sql = "SELECT * FROM usuario WHERE nombre_usuario='$usuario'";

    $resul = consulta($sql);

    if ($resul && count($resul) > 0) {
        $pass = password_verify($passwd, $resul[0][1]);

        if ($pass) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $resul[0][3];
            return true;
        }
    }
    return false;
}

/*
 * FUNCIÓN: getNombreUsuario()
 *   - No recibe parámetro alguno
 *   - Consulta el estado de la sesión para obtener el nombre de usuario
 *   - Devuelve en un string el nombre de usuario almacenado en la sesión
 */

function getNombreUsuario() {

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (comprobarLogin()) {
        return $_SESSION['usuario'];
    }

    return "";
}

/*
 * FUNCIÓN: getFechaRegistroUsuario()
 *   - No recibe parámetro alguno
 *   - Realiza una petición a la base de datos para obtener la fecha en la que el usuario se registró
 *   - Devuelve la fecha exacta en la que el usuario inició sesión con formato d/m/Y
 */

function getFechaRegistroUsuario() {

    $usuario = getNombreUsuario();
    $fecha = consulta("SELECT fecha_registro FROM usuario WHERE nombre_usuario = '$usuario'")[0][0];

    if ($fecha === NULL) {
        return '';
    }
    return date_format(date_create($fecha), "d/m/Y");
}

/*
 * FUNCIÓN: getPuntosUsuario()
 *   - No recibe parámetro alguno
 *   - Realiza una petición a la base de datos para obtener los puntos totales obtenidos 
 *     por el usuario, que radica en la suma de la puntuación de las noticas que ha publicado.
 *   - Devuelve la puntuación del usuario anteriormente mencionada.
 */

function getPuntosUsuario() {

    $nombreUsuario = getNombreUsuario();

    $consulta = consulta("SELECT SUM(puntua.puntos) FROM usuario, noticia, puntua WHERE usuario.nombre_usuario = '$nombreUsuario' AND noticia.autor=usuario.nombre_usuario AND puntua.id_noticia=noticia.id");

    if ($consulta !== false && $consulta !== true && $consulta[0][0] !== NULL) {
        return $consulta[0][0];
    }
    return 0;
}

/*
 * FUNCIÓN: getNumNoticiasUsuario()
 *   - No recibe parámetro alguno
 *   - Realiza una petición a la base de datos para obtener el numero total de noticias
 *     que el usuario a publicado
 *   - Devuelve el numero de noticias publicadas por el usuario
 */

function getNumNoticiasUsuario() {

    $nombreUsuario = getNombreUsuario();

    $consulta = consulta("SELECT COUNT(*) FROM noticia WHERE autor = '$nombreUsuario'");

    if ($consulta !== false && $consulta !== true && $consulta[0][0] !== NULL) {
        return $consulta[0][0];
    }
    return 0;
}

/*
 * FUNCIÓN: getNumComentariosUsuario()
 *   - No recibe parámetro alguno
 *   - Realiza una petición a la base de datos para obtener el numero total de comentarios
 *     que el usuario a publicado
 *   - Devuelve el numero de comentarios publicados por el usuario
 */

function getNumComentariosUsuario() {

    $nombreUsuario = getNombreUsuario();

    $consulta = consulta("SELECT COUNT(*) FROM comentario WHERE autor = '$nombreUsuario'");

    if ($consulta !== false && $consulta !== true && $consulta[0][0] !== NULL) {
        return $consulta[0][0];
    }
    return 0;
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

    $img = consulta("SELECT imagen FROM usuario WHERE nombre_usuario = '$usuario'")[0][0];

    if ($img === NULL) {
        return '../img/iconos/iconoUsuario.svg';
    } else {
        return "../img/usuarios/$img";
    }
}

/*
 * FUNCIÓN: cambiaImagenUsuario()
 *   - Recibe un string con el nombre temporal del fichero que contiene la nueva foto de perfil
 *   - Guarda el archivo en el servidor y notifica el cambio a la base de datos
 *   - No devuelve nada
 */

function cambiaImagenUsuario($imagen) {
    $usuario = getNombreUsuario();

    copy($imagen, "../img/usuarios/$usuario.png");

    consulta("UPDATE usuario SET imagen = '$usuario.png' WHERE usuario.nombre_usuario = '$usuario' ");
}

/*
 * FUNCIÓN: getTodasCategorias()
 *   - No recibe parámetro alguno
 *   - Realiza una petición a la base de datos para obtener todas las categorias 
 *   - Devuelve un array con el nombre de las categorias 
 */

function getTodasCategorias() {
    $categorias = array();

    $sql = "SELECT nombre FROM categoria";

    $cat = consulta($sql);

    foreach ($cat as $c) {
        $categorias[] = $c[0];
    }

    return $categorias;
}

/*
 * FUNCIÓN: cambiaImagenUsuario()
 *   - No recibe parámetro alguno
 *   - Realiza una petición a la base de datos para obtener todas las categorias 
 *     en las que el usuario esté interesado.
 *   - Devuelve un array con el nombre de las categorias 
 */

function getCategorias() {
    $categorias = array();

    $usuario = getNombreUsuario();

    $sql = "SELECT nombre_categoria FROM interesado_en WHERE nombre_usuario = '$usuario'";

    $cat = consulta($sql);

    foreach ($cat as $c) {
        $categorias[] = $c[0];
    }

    return $categorias;
}

/*
 * FUNCIÓN: encomillar()
 *   - Recibe un array de strings
 *   - Añade comillas simples a todos los strings del array 
 *   - Devuelve un array con los elementos encomillados.
 */

function encomillar($array) {
    $res = array();
    foreach ($array as $texto) {
        $res[] = "'" . $texto . "'";
    }

    return $res;
}

/*
 * FUNCIÓN: eliminarTildes()
 *   - Recibe un string por referencia
 *   - Elimina las tildes del texto 
 *   - No devuelve nada, modifica el parámetro recibido por la referencia
 */

function eliminarTildes(&$texto) {
    $texto = str_ireplace("á", "a", $texto);
    $texto = str_ireplace("é", "e", $texto);
    $texto = str_ireplace("í", "i", $texto);
    $texto = str_ireplace("ó", "o", $texto);
    $texto = str_ireplace("ú", "u", $texto);
}

/*
 * FUNCIÓN: getDatosCategorias()
 *   - No recibe parámetro alguno
 *   - Hace una consulta a la base de datos para obtener todos los datos de 
 *     aquellas categorías que sean de interes para el usuario. 
 *   - Devuelve un array multidimensional con los datos de las categorías 
 */

function getDatosCategorias() {

    $res = array();

    $categorias = implode(",", encomillar(getCategorias()));

    $sql = "SELECT * FROM categoria WHERE nombre IN ($categorias)";

    $consulta = consulta($sql);

    if ($consulta !== true && $consulta !== false) {
        $res = $consulta;
    }
    return $res;
}

/*
 * FUNCIÓN: getCategoriasNoInteresadoUsuario()
 *   - No recibe parámetro alguno
 *   - Hace una consulta a la base de datos para obtener todos los datos de 
 *     aquellas categorías que NO sean de interes para el usuario. 
 *   - Devuelve un array multidimensional con los datos de las categorías 
 */

function getCategoriasNoInteresadoUsuario() {
    $categorias = getCategorias();

    if (count($categorias) > 0) {
        $categorias = implode(",", encomillar(getCategorias()));

        $sql = "SELECT * FROM categoria WHERE nombre NOT IN ($categorias)";
    } else {
        $sql = "SELECT * FROM categoria";
    }
    return consulta($sql);
}

/*
 * FUNCIÓN: getAnuncios()
 *   - No recibe parámetro alguno
 *   - Hace una consulta a la base de datos para obtener todos los datos de los
 *     anuncios vigentes.
 *   - Devuelve un array multidimensional con los datos de los anuncios 
 */

function getAnuncios() {
    return consulta("SELECT titulo, descripcion, contenido_multimedia, fecha_inicio FROM anuncio WHERE fecha_inicio <= CURRENT_DATE AND ( fecha_fin IS NULL OR CURRENT_DATE <= fecha_fin ) ORDER BY anuncio.cuantia DESC");
}

/*
 * FUNCIÓN: getContenidoMultimediaAnuncio()
 *   - Recibe un string con el nombre del fichero que contiene el contenido multimedia de un archivo
 *   - Lee el fichero especificado y lo guarda en un string. 
 *   - Devuelve un string con las etiquetas HTML que acompañan al anuncio 
 */

function getContenidoMultimediaAnuncio($nombreFichero) {
    $contenido = "";

    $dir = "../anuncios/$nombreFichero";
    $fp = fopen($dir, "r");
    flock($fp, LOCK_SH);

    while (!feof($fp)) {
        $contenido .= fread($fp, 999);
    }

    flock($fp, LOCK_UN);
    fclose($fp);

    return $contenido;
}

/*
 *  FUNCIÓN: getNoticias()
 *   - Recibe un string con el enlace a un medio RSS, un string con la temática,
 *     un numero entero con el maximo numero de noticias a devolver y el nombre de la fuente.
 *   - Se conecta al RSS especificado y recopila aquellas noticias que contengan 
 *     la temática especificada. Recopilará tantas como indique el parámetro maxNoticias 
 *   - Devuelve un array multidimensional con la información de las noticias recopiladas
 */

function getNoticias($enlace, $tematica, $maxNoticias, $fuente) {
    $noticiasElegidas = array();

    $noticias = simplexml_load_string(file_get_contents($enlace));

    $fechaActual = date("d-m-Y - H:i");
    foreach ($noticias->channel->item as $noticia) {

        $fechaNoticia = $fechaActual;
        if ($noticia->pubDate) {
            $fechaNoticia = date("d-m-Y - H:i", strtotime($noticia->pubDate));
        }
        $enlaceNoticia = $noticia->link->__toString();
        $tituloNoticia = $noticia->title->__toString();
        $descripcionNoticia = trim(filter_var($noticia->description->__toString(), FILTER_SANITIZE_STRING));
        $imagenNoticia = NULL;

        if (isset($noticia->enclosure['url'][0])) {
            $imagenNoticia = $noticia->enclosure['url'][0];
        }

        if ($imagenNoticia === NULL || strlen($imagenNoticia) === 0) {
            $imagenNoticia = "";

            //SOLUCION DE COMPATIBILIDAD PARA RSS QUE NO SIGUEN EL ESTANDAR
            $imagenNoticia = getURLImageFromRSS($noticia->description[0]);
        }

        if (strlen(trim($imagenNoticia)) <= 0) {
            $imagenNoticia = '../img/iconos/iconoImagenNoticiaPorDefecto.svg';
        }

        $descripcionNoticia = substr($descripcionNoticia, 0, min(array(140, strlen($descripcionNoticia)))) . "...";

        if (contieneTematica($descripcionNoticia, $tematica) || contieneTematica($tituloNoticia, $tematica)) {

            if (strlen($descripcionNoticia) < strlen($tituloNoticia)) {
                $descripcionNoticia = '';
            }

            $noticiasElegidas[] = array($tituloNoticia, $fechaNoticia, $enlaceNoticia, $descripcionNoticia, $imagenNoticia, $fuente);

            if (count($noticiasElegidas) >= $maxNoticias) {
                return $noticiasElegidas;
            }
        }
    }
    return $noticiasElegidas;
}

/*
 *  FUNCIÓN: getURLImageFromRSS()
 *   - Recibe un string con etiquetas HTML
 *   - Esta función es una solución de compatibilidad. Algunos medios no siguen el
 *     estándar RSS, incluyendo imagenes junto al texto codificandas en HTML plano
 *   - Devuelve un string con la url de la primera imagen que se encuentre si la hubiera.
 */

function getURLImageFromRSS($image) {

    preg_match_all('/<img[^>]+>/i', $image, $imgs); // Nos quedamos con las imagenes de la noticia incrustadas en la descripcion
    if (count($imgs[0]) > 0) {
        preg_match_all('/(src)=("[^"]*")/i', $imgs[0][0], $src); // Conseguimos el src de la imagen
        if (count($src) > 0) {
            if ($src[0][0]) {
                $imagenNoticia = $src[0][0];

                if (stripos($imagenNoticia, ".PNG") || stripos($imagenNoticia, ".JPEG") || stripos($imagenNoticia, ".JPG")) {

                    $imagenNoticia = str_replace("src= ", "", $imagenNoticia);
                    $imagenNoticia = str_replace("src=", "", $imagenNoticia);
                    $imagenNoticia = str_replace("src = ", "", $imagenNoticia);
                    $imagenNoticia = str_replace("src =", "", $imagenNoticia);
                    $imagenNoticia = str_replace("src", "", $imagenNoticia);
                    $imagenNoticia = str_replace("\"", "", $imagenNoticia);
                    $imagenNoticia = str_replace("'", "", $imagenNoticia);
                    return $imagenNoticia;
                }
            }
        }
    }

    return "";
}

/*
 *  FUNCIÓN: contieneTematica()
 *   - Recibe dos strings con un texto y una temática
 *   - Se estudiará si el texto dado, trata sobre la temática especificada
 *   - Devuelve un booleano
 */

function contieneTematica($texto, $tematica) {
    $contieneTematica = false;

    $i = 0;

    eliminarTildes($tematica);
    eliminarTildes($texto);

    while ($i < (strlen($tematica) / 2) && !$contieneTematica) {

        if (strripos($texto, substr($tematica, 0, strlen($tematica) - $i)) !== false) {
            $contieneTematica = true;
        }
        $i++;
    }
    return $contieneTematica;
}

/*
 *  FUNCIÓN: aniadirTematica()
 *   - Recibe un string con una temática
 *   - Se hará una consulta a la base de datos para añadir la temática especirficada
 *     a la lista de temáticas de interés para el usuario  
 *   - No devuelve nada
 */

function aniadirTematica($tematica) {
    $usuario = getNombreUsuario();

    consulta("INSERT INTO interesado_en (nombre_usuario, nombre_categoria) VALUES ('$usuario','$tematica')");
}

/*
 *  FUNCIÓN: eliminarTematica()
 *   - Recibe un string con una temática
 *   - Se hará una consulta a la base de datos para eliminar la temática especirficada
 *     de la lista de temáticas de interés para el usuario  
 *   - No devuelve nada
 */

function eliminarTematica($tematica) {
    $usuario = getNombreUsuario();
    consulta("DELETE FROM interesado_en WHERE nombre_usuario='$usuario' AND nombre_categoria='$tematica'");
}

/*
 *  FUNCIÓN: getNoticiasUsuario()
 *   - Recibe dos strings, una temática y un numero entero que especifica el 
 *     maximo numero de noticias a cargar
 *   - Se hará una consulta a la base de datos para, a la postre rescatar
 *     mediante RSS todas aquellas noticias de las fuentes seleccionadas por el usuario
 *     que traten la temática especificada 
 *   - Devuelve un array multidimensional con las noticias que cumplan ese criterio
 */

function getNoticiasUsuario($tematica, $maxNoticias) {

    $usuario = getNombreUsuario();

    $fuentes = consulta("SELECT rss,nombre FROM fuente, elegida_por WHERE fuente.nombre = elegida_por.nombre_fuente AND elegida_por.nombre_usuario = '$usuario'");

    if ($fuentes === NULL) {
        return array();
    }

    $noticias = array();
    foreach ($fuentes as $fuente) {
        $noticias = array_merge($noticias, getNoticias($fuente[0], $tematica, $maxNoticias, $fuente[1]));
    }

    return $noticias;
}

/*
 *  FUNCIÓN: getNoticiasComunidad()
 *   - Recibe dos numeros enteros, el primero indica la noticia de inicio y el 
 *     segundo el numero maximo de noticias a cargar a partir de la noticia especificada
 *     en el primer parámetro
 *   - Se hará una consulta a la base de datos para rescatar todas aquellas noticias de la comunidad 
 *     que estén dentro del intervalo
 *   - Devuelve un array multidimensional con las noticias que cumplan ese criterio
 */


function getNoticiasComunidad($noticiaInicio, $numNoticias) {
    $consulta = consulta("SELECT * FROM noticia ORDER BY fecha_publicacion DESC LIMIT $noticiaInicio, $numNoticias");

    $noticias = array();
    foreach ($consulta as $c) {
        $noticias[] = array($c[0], $c[1], $c[2], $c[3], $c[4], $c[5], getPuntuacionNoticia($c[0]));
    }

    return $noticias;
}


/*
 *  FUNCIÓN: getURLAutor()
 *   - Recibe un string com el nombre de un usuario
 *   - Se hará una consulta a la base de datos para rescatar la URL dentro del servidor
 *     donde se almacena la foto de perfil del usuario especificado
 *   - Devuelve un string con la URL a la foto de perfil del usuario especificado
 */

function getURLAutor($nombreUsuario) {
    $consulta = consulta("SELECT imagen FROM usuario WHERE nombre_usuario = '$nombreUsuario'");
    $imagenAutor = '../img/iconos/iconoUsuario.svg';

    if ($consulta) {
        $img = $consulta[0][0];
        if ($img !== NULL) {
            $imagenAutor = "../img/usuarios/$img";
        }
    }
    return $imagenAutor;
}

/*
 *  FUNCIÓN: getPuntuacionNoticia()
 *   - Recibe un numero entero con el id de una noticia
 *   - Se hará una consulta a la base de datos para rescatar la puntuación
 *     de una noticia otorgada por los usuarios.
 *   - Devuelve un número entero con la puntuación de la noticia.
 */

function getPuntuacionNoticia($idNoticia) {
    $puntuacion = 0;

    $consulta = consulta("SELECT SUM(puntos) FROM puntua WHERE id_noticia='$idNoticia'");

    if ($consulta !== false && $consulta !== true && $consulta[0][0] !== NULL) {
        $puntuacion = $consulta[0][0];
    }
    return $puntuacion;
}

/*
 *  FUNCIÓN: getPuntuacionNoticiaUsuario()
 *   - Recibe un numero entero con el id de una noticia
 *   - Se hará una consulta a la base de datos para rescatar la puntuación
 *     de una noticia otorgada por el usuario
 *   - Devuelve un número entero con la puntuación de la noticia
 */

function getPuntuacionNoticiaUsuario($idNoticia) {
    $usuario = getNombreUsuario();

    $puntuacion = 0;

    $consulta = consulta("SELECT SUM(puntos) FROM puntua WHERE id_noticia='$idNoticia' AND nombre_usuario='$usuario'");

    if ($consulta !== false && $consulta !== true && $consulta[0][0] !== NULL) {
        $puntuacion = $consulta[0][0];
    }
    return $puntuacion;
}

/*
 *  FUNCIÓN: registrarNoticia()
 *   - Recibe tres strings, enlace, título y descripción de una noticia
 *   - Se hará una consulta a la base de datos para insertar la noticia en 
 *     la página
 *   - No devuelve nada
 */

function registrarNoticia($enlace, $titulo, $descripcion) {
    $usuario = getNombreUsuario();

    consulta("INSERT INTO noticia(fecha_publicacion, enlace, titulo, descripcion, autor) VALUES (current_timestamp(), '$enlace', '$titulo', '$descripcion', '$usuario')");
}

/*
 *  FUNCIÓN: isNoticiaGuardada()
 *   - Recibe el id de una noticia
 *   - Se hará una consulta a la base de datos para averiguar si una noticia
 *     ha sido guardada por el usuario
 *   - Devuelve un booleano
 */

function isNoticiaGuardada($id_noticia) {
    $usuario = getNombreUsuario();

    $consulta = consulta("SELECT COUNT(*) FROM guarda WHERE id_noticia = '$id_noticia' AND nombre_usuario = '$usuario'");

    if ($consulta !== false && $consulta[0][0] !== NULL && $consulta[0][0] > 0) {
        return true;
    }
    return false;
}

/*
 *  FUNCIÓN: isNoticiaGuardada()
 *   - Recibe el id de una noticia
 *   - Realiza una consulta a la base de datos para obtener los datos de la
 *     noticia
 *   - Devuelve la información de la noticia
 */

function getNoticiaComunidad($id) {

    $c = consulta("SELECT * FROM noticia WHERE id='$id'")[0];

    return array($c[0], $c[1], $c[2], $c[3], $c[4], $c[5], getPuntuacionNoticia($c[0]));
}

/*
 *  FUNCIÓN: getComentariosNoticia()
 *   - Recibe el id de una noticia
 *   - Realiza una consulta a la base de datos para obtener los comentarios de la noticia
 *   - Devuelve un array multidimensional con la información de todos loc comentarios de la noticia
 */

function getComentariosNoticia($id) {

    $consulta = consulta("SELECT * FROM comentario WHERE id_noticia = '$id' AND responde IS NULL");

    $comentarios = array();
    foreach ($consulta as $c) {
        $comentarios[] = array($c[0], $c[1], $c[2], $c[3], $c[4]);
    }
    return $comentarios;
}

/*
 *  FUNCIÓN: getNumRespuestas()
 *   - Recibe el id de un comentario
 *   - Realiza una consulta a la base de datos para obtener el numero de respuestas al comentario
 *   - Devuelve un numero entero con el número de respuestas
 */

function getNumRespuestas($idComentario) {
    $consulta = consulta("SELECT COUNT(*) FROM comentario WHERE responde='$idComentario'");

    if ($consulta !== false && $consulta[0][0] !== NULL && $consulta[0][0] > 0) {
        return $consulta[0][0];
    } else {
        return 0;
    }
}

/*
 *  FUNCIÓN: isFake()
 *   - Recibe el id de una noticia
 *   - Realiza una consulta a la base de datos para saber si el usuario ha
 *     marcado la noticia como falsa
 *   - Devuelve un booleano
 */

function isFake($id) {
    $usuario = getNombreUsuario();
    $consulta = consulta("SELECT COUNT(*) FROM fake_news WHERE id_noticia='$id' AND nombre_usuario='$usuario'");

    if ($consulta !== false && $consulta[0][0] !== NULL && $consulta[0][0] > 0) {
        return true;
    } else {
        return false;
    }
}

/*
 *  FUNCIÓN: getFakeNews()
 *   - No recibe parámetro alguno
 *   - Realiza una consulta a la base de datos que nos da la iformación
 *     de aquellas noticias falsas marcadas como tal por la cuarta parte de los 
 *     usuarios este mes.
 *   - Devuelve un array multidimensional con la información de las noticias falsas
 */

function getFakeNews() {

    $numUsuarios = intval(getNumeroUsuarios() / 4);

    $consulta = consulta("SELECT id, fecha_publicacion, enlace, titulo, descripcion, autor, COUNT(*) as numVotos FROM fake_news, noticia WHERE fake_news.id_noticia = noticia.id AND MONTH(fecha_publicacion) = MONTH(CURRENT_DATE) AND YEAR(fecha_publicacion) = YEAR(CURRENT_DATE) GROUP BY(id_noticia) ORDER BY(numVotos) DESC");

    if ($consulta) {
        $fakeNews = array();
        $i = 0;
        while ($i < count($consulta) && intval($consulta[$i][6]) >= $numUsuarios) {
            $fakeNews[] = $consulta[$i];
            $i++;
        }
        return $fakeNews;
    } else {
        return array();
    }
}

/*
 *  FUNCIÓN: getNumeroUsuarios()
 *   - No recibe parámetro alguno
 *   - Realiza una consulta a la base de datos para conocer el número de usuarios 
 *     registrados
 *   - Devuelve un número entero con el número de usuarios registrados
 */

function getNumeroUsuarios() {
    $consulta = consulta("SELECT COUNT(*) FROM usuario");

    if ($consulta !== false && $consulta[0][0] !== NULL && $consulta[0][0] > 0) {
        return $consulta[0][0];
    } else {
        return 0;
    }
}

/*
 *  FUNCIÓN: getNoticiasPublicadas()
 *   - Recibe dos numeros enteros, el primero indica la noticia de inicio y el 
 *     segundo el numero maximo de noticias a cargar a partir de la noticia especificada
 *     en el primer parámetro
 *   - Se hará una consulta a la base de datos para rescatar todas aquellas noticias 
 *     publicadas por el usuario
 *   - Devuelve un array multidimensional con las noticias que cumplan ese criterio
 */

function getNoticiasPublicadas($inicio, $numNoticias) {

    $nombreUsuario = getNombreUsuario();

    $consulta = consulta("SELECT * FROM noticia WHERE autor = '$nombreUsuario' ORDER BY fecha_publicacion DESC LIMIT $inicio, $numNoticias");

    $noticias = array();
    foreach ($consulta as $c) {
        $noticias[] = array($c[0], $c[1], $c[2], $c[3], $c[4], $c[5], getPuntuacionNoticia($c[0]));
    }

    return $noticias;
}

/*
 *  FUNCIÓN: getComentariosPublicados()
 *   - Recibe dos numeros enteros, el primero indica el comentatio de inicio y el 
 *     segundo el numero maximo de noticias a cargar a partir del comentario especificado
 *     en el primer parámetro
 *   - Se hará una consulta a la base de datos para rescatar todas aquellos comentarios 
 *     publicadas por el usuario
 *   - Devuelve un array multidimensional con los comentatarios que cumplan ese criterio
 */

function getComentariosPublicados($inicio, $numComentarios) {

    $nombreUsuario = getNombreUsuario();

    $consulta = consulta("SELECT * FROM comentario WHERE autor = '$nombreUsuario' ORDER BY fecha_comentario DESC LIMIT $inicio, $numComentarios");

    $comentarios = array();
    foreach ($consulta as $c) {
        $comentarios[] = array($c[0], $c[1], $c[2], $c[3], $c[4], $c[5]);
    }

    return $comentarios;
}

/*
 *  FUNCIÓN: getNoticiasGuardadas()
 *   - Recibe dos numeros enteros, el primero indica la noticia de inicio y el 
 *     segundo el numero maximo de noticias a cargar a partir de la noticia especificada
 *     en el primer parámetro
 *   - Se hará una consulta a la base de datos para rescatar todas aquellas noticias 
 *     guardadas por el usuario
 *   - Devuelve un array multidimensional con las noticias que cumplan ese criterio
 */

function getNoticiasGuardadas($inicio, $fin) {

    $nombreUsuario = getNombreUsuario();

    $consulta = consulta("SELECT id, fecha_publicacion, enlace, titulo, descripcion, autor FROM noticia, guarda WHERE noticia.id=guarda.id_noticia AND nombre_usuario = '$nombreUsuario' ORDER BY fecha_publicacion DESC LIMIT $inicio, $fin");

    $noticias = array();
    foreach ($consulta as $c) {
        $noticias[] = array($c[0], $c[1], $c[2], $c[3], $c[4], $c[5], getPuntuacionNoticia($c[0]));
    }

    return $noticias;
}

/*
 *  FUNCIÓN: getTodasLasFuentes()
 *   - No recibe parámetro alguno
 *   - Realiza una consulta a la base de datos para conocer el nombre de todas las fuentes
 *   - Devuelve un array con el nombre de las fuentes
 */

function getTodasLasFuentes() {

    $consulta = consulta("SELECT fuente.nombre FROM fuente");

    $fuentes = array();
    foreach ($consulta as $f) {
        $fuentes[] = $f[0];
    }

    return $fuentes;
}

/*
 *  FUNCIÓN: getFuentesUsuario()
 *   - No recibe parámetro alguno
 *   - Realiza una consulta a la base de datos para conocer el nombre de las fuentes 
 *     de interés para el usuario
 *   - Devuelve un array con el nombre de las fuentes
 */

function getFuentesUsuario() {
    $nombreUsuario = getNombreUsuario();

    $consulta = consulta("SELECT fuente.nombre FROM fuente, elegida_por WHERE fuente.nombre = elegida_por.nombre_fuente AND elegida_por.nombre_usuario='$nombreUsuario'");

    $fuentes = array();
    foreach ($consulta as $f) {
        $fuentes[] = $f[0];
    }

    return $fuentes;
}

/*
 *  FUNCIÓN: getFuentesNoSeleccionadas()
 *   - Recibe un array con el nombre de las fuentes
 *   - Realiza una consulta a la base de datos para conocer el nombre 
 *     de las fuentes que no son de interés para el usuario
 *   - Devuelve un array con el nombre de las fuentes
 */

function getFuentesNoSeleccionadas($fuentesSeleccionadas) {
    $consulta = consulta("SELECT nombre FROM fuente");

    $fuentes = array();
    foreach ($consulta as $f) {
        $fuentes[] = $f[0];
    }

    return array_diff($fuentes, $fuentesSeleccionadas);
}

/*
 *  FUNCIÓN: isAdmin()
 *   - No recibe parámetro alguno
 *   - Comprueba el estado de la sesión para averiguar si el usuario es administrador o no
 *   - Devuelve un booleano
 */

function isAdmin() {

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!isset($_SESSION['tipo'])) {
        return false;
    }

    return strcmp($_SESSION['tipo'], "usuario_admin") === 0 && comprobarLogin();
}

/*
 *  FUNCIÓN: getPatrocinadores()
 *   - No recibe parámetro alguno
 *   - Devuelve todos los datos de los patrocinadores
 */

function getPatrocinadores() {
    return consulta("SELECT * FROM patrocinador ");
}

/*
 *  FUNCIÓN: getPatrocinadores()
 *   - Recibe un string y una fecha
 *   - Busca en la base de datos el patrocinador de ese anuncio
 *   - Devuelve el nomnbre del patrocinador
 */
function getPatrocinador($titulo, $fechaInicioAnuncio) {

    return consulta("SELECT cif_patrocinador FROM patrocina WHERE titulo_anuncio = '$titulo' && fecha_inicio_anuncio = '$fechaInicioAnuncio'")[0][0];
}

/*
 *  FUNCIÓN: esImagen()
 *   - Recibe un string con el path de un fichero
 *   - Revisa si el fichero es una imagen
 *   - Devuelve un booleano
 */
function esImagen($path) {
    
    $a = getimagesize($path);
    $image_type = $a[2];

    if (in_array($image_type, array(IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
        return true;
    }
    return false;
}
?>

