<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

/*
 * COMPRUEBA SI EL USUARIO HA INICIADO SESIÓN. SI NO LO ESTÁ, LO REDIRIGE A
 * LA PAGINA DE INICIO DE SESIÓN 
 */
include_once 'logeado.php';



if (isset($_POST['subirFoto'])) {

    $mime = $_FILES['fotoPerfil']['type'];
    $size = $_FILES['fotoPerfil']['size'];

    echo image_type_to_mime_type(IMAGETYPE_PNG);

    if ($size < 2097152) {

        if ($mime === image_type_to_mime_type(IMAGETYPE_PNG) || $mime === image_type_to_mime_type(IMAGETYPE_JPEG)) {
            cambiaImagenUsuario($_FILES['fotoPerfil']['tmp_name']);
            header('location: perfil.php');
        }
    }
}


//SI EL USUARIO ES ADMIN SE GESTIONARÁ LAS FUENTES Y CATEGORÍAS
if (isAdmin()) {
    
    if (isset($_POST['nombre']) && isset($_POST['rss']) && isset($_POST['registrarFuente'])) {

        $nombreFuente = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $rss = filter_var($_POST['rss'], FILTER_SANITIZE_URL);

        if (filter_var($rss, FILTER_VALIDATE_URL)) {
            consulta("INSERT INTO fuente (nombre, rss) VALUES ('$nombreFuente', '$rss') ");
        }
    }

    if (isset($_POST['eliminarFuente']) && isset($_POST['submEliminarFuente'])) {

        $nombreFuente = filter_var($_POST['eliminarFuente'], FILTER_SANITIZE_STRING);

        consulta("DELETE FROM elegida_por WHERE nombre_fuente = '$nombreFuente'");
        consulta("DELETE FROM fuente WHERE nombre = '$nombreFuente'");
    }

    if (isset($_POST['eliminarCategoria']) && isset($_POST['submEliminarCategorias'])) {

        $nombreCat = filter_var($_POST['eliminarCategoria'], FILTER_SANITIZE_STRING);

        consulta("DELETE FROM interesado_en WHERE nombre_categoria = '$nombreCat'");
        consulta("DELETE FROM categoria WHERE nombre = '$nombreCat'");
    }
    
    if (isset($_POST['nombreCategoria']) && isset($_POST['registrarCategoria']) && isset($_FILES['fotoCategoria'])) {
        
        $nombreCat = filter_var($_POST['nombreCategoria'], FILTER_SANITIZE_STRING);
        $fichero = $_FILES['fotoCategoria']['tmp_name'];
        
        $filename = "$nombreCat".".png";
        
        copy($fichero, "../img/categorias/".$filename);
        
        consulta("INSERT INTO categoria (nombre, imagen) VALUES ('$nombreCat', '$filename') ");
    }
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Newz</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS DEL TABLÓN-->
        <link rel="stylesheet" type="text/css" href="../css/ajustes.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include './libreriasJS.php'; ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DE AJUSTES-->
        <script src="../js/ajustes.js" type="text/javascript"></script>
    </head>
    <body>

        <?php
//INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include './header.php';
        ?>

        <!-- DIVISOR PRINCIPAL: Divide contenido principal del resto -->
        <div id="divisorPagina">
            <section>
                <!--FORMULARIO PARA SUBIR LA NUEVA FOTO DE PERFIL Y SUBIR LA NUEVA-->
                <form action="#" method="post" enctype="multipart/form-data" id="formFoto">

                    <!--FOTO DE PERFIL ACTUAL-->
                    <h3>Foto de perfil</h3>
                    <?php
                    echo "<figure id='fotoPerfilActual'>";
                    echo "<img id='imgActual' class='fotoPerfil' src='$urlImagen' alt='cambiar foto de perfil'/>";
                    echo "</figure>";
                    ?>
                    <!--INPUT: file -> nueva foto de perfil -->
                    <input id="fotoPerfil" name="fotoPerfil" type="file"/><br/>
                    <!--INPUT: submit -->
                    <input id="subirFoto" class="boton" name="subirFoto" type="submit" value="Subir foto"/>
                </form>

                <!--ZONA ADMINISTRADOR-->
                <?php
                if (isAdmin()) {
                    ?>

                    <!--FORMULARIO PARA SUBIR LA GESTIÓN DE FUENTES y CATEGORIAS-->
                    <div id="gestion">
                        <form action="#" method="post">

                            <!--AÑADIR FUENTE-->
                            <h3>Añadir fuente</h3>
                            <h4>Nombre de la fuente</h4>
                            <input type="text" name="nombre" placeholder="Nombre"/><br/><br/>
                            <h4>URL RSS de la fuente</h4>
                            <input type="url" name="rss" placeholder="URL RSS"/><br/><br/>
                            <input type="submit" name="registrarFuente" value="Registrar fuente"/>
                        </form>

                        <br/>

                        <form action="#" method="post">

                            <!--Fuentes actuales en el sistema-->
                            <h3>Eliminar fuente</h3>
                            <select name="eliminarFuente">
                                <option selected>---</option>
                                <?php
                                foreach (getTodasLasFuentes() as $f) {

                                    echo "<option value='$f'>$f</option> ";
                                }
                                ?>
                            </select>
                            <br/>
                            <br/>
                            <input type="submit" name="submEliminarFuente" value="Eliminar fuente"/>
                        </form>

                        <br/>
                        
                        <form action="#" method="post" enctype="multipart/form-data">

                            <!--AÑADIR CATEGORÍA-->
                            <h3>Añadir categoría</h3>
                            <h4>Nombre de la categoría</h4>
                            <input type="text" name="nombreCategoria" placeholder="Nombre"/><br/><br/>
                            <h4>Imagen PNG de la categoría</h4>
                            <input type="file" name="fotoCategoria"><br/><br/>
                            <input type="submit" name="registrarCategoria" value="Registrar categoría"/>
                        </form>
                        
                        <br/>

                        <form action="#" method="post">

                            <!--Categorías actuales en el sistema-->
                            <h3>Eliminar categoría</h3>
                            <select name="eliminarCategoria">
                                <option selected>---</option>
                                <?php
                                foreach (getTodasCategorias() as $f) {

                                    echo "<option value='$f'>$f</option> ";
                                }
                                ?>
                            </select>
                            <br/>
                            <br/>
                            <input type="submit" name="submEliminarCategorias" value="Eliminar fuente"/>
                        </form>

                        <br/>
                    </div>
                    <?php
                }
                ?>

                <!--ALMACENARÁ EN CHECKBOXES LAS FUENTES PREFERIDAS POR EL USUARIO -->
                <!--MEDIANTE UN PLUGIN EXTERNO SE LES DARÁ ASPECTO DE INTERRUPTOR-->
                <!--
                    AL HACERSE CLIC SOBRE UNO DE ELLOS, SE DISPARARÁ UN EVENTO QUE 
                    ENVIARÁ LA PETICIÓN AL SERVIDOR PARA HABILITAR/DESHABILITAR ESA 
                    FUENTE
                -->
                <div id="contenedorFuentes">

                </div>

            </section>

            <!--NCLUIMOS UN BOTÓN DE SUBIR A LA CABECERA -->
            <?php
            include './subir.php';
            ?>

        </div>
        <?php
//INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
    </body>

</html>
