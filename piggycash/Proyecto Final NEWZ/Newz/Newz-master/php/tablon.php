<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

/*
 * COMPRUEBA SI EL USUARIO HA INICIADO SESIÓN. SI NO LO ESTÁ, LO REDIRIGE A
 * LA PAGINA DE INICIO DE SESIÓN 
 */
include_once 'logeado.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Newz</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS DE TABLÓN-->
        <link rel="stylesheet" type="text/css" href="../css/estiloTablon.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include './libreriasJS.php'; ?>
        
        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS DEL TABLÓN-->
        <script type="text/javascript" src="../js/animarCategoria.js"></script>
    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include './header.php';
        
        // SI RECIBIMOS UNA TEMÁTICA MEDIANTE POST, LA ELIMINAMOS DEL PERFIL DEL USUARIO
        if (isset($_POST['tematicaAEliminar'])) {
            $tematica = trim(filter_var($_POST['tematicaAEliminar'], FILTER_SANITIZE_STRING));
            eliminarTematica($tematica);
        }
        ?>

        <!-- DIVISOR PRINCIPAL: Divide contenido prncipal y publicidad -->
        <div id="divisorPagina">
            
            <!--CÁTEGORIAS SELECCIONADAS POR EL USUARIO-->
            <section>
                <h2>Mis categorías</h2>
                <?php
                
                // RESCATAMOS LAS CATEGORÍAS EN LAS QUE EL USUARIO ESTÉ INTERESADO
                $categoriasUsuario = getDatosCategorias();
                
                // ALMACENAMOS LAS CATEGORÍAS EN UN CONTENEDOR DE TARJETAS
                echo "<div class='todasCategorias'>";
                
                // CREAMOS UNA TARJETA POR CADA CATEGORIA 'c'
                foreach ($categoriasUsuario as $c) {
                    echo "<div class='categoria'>";
                    
                    // ENLACE A LA PAGINA DE CATEGORIA (GET)
                    echo "<h3><a href='../php/tematica.php?tematica=$c[0]'>$c[0]</a></h3>"; 
                    
                     //IMAGEN DE FONDO DE LA CATEGORÍA
                    echo "<figure class='fondoCategoria'>";
                    echo "<img src='../img/categorias/$c[1]' alt='$c[0]' />"; 
                    echo "</figure>";
                    
                    // BOTON DE ELIMINAR CATEGORÍA DE LA LISTA DEL USUARIO
                    echo "<figure class='eliminarCategoria' hidden>"; 
                    echo "<button class='botonEliminar'>"; 
                    echo "<img id='eliminar_$c[0]' src='../img/categorias/iconoEliminarCategoria.png' alt='iconoEliminarCategoria' onclick='eliminarTematica(event)'/>";
                    echo "</button>";
                    echo "</figure>";
                    
                    echo "</div>";
                }
                echo "<div class='categoria'>";
                echo "<h3><a href='../php/aniadirCategoria.php'>Añadir</a></h3>";
                echo "<figure>";
                
                // TARJETA DE AÑADIR NUEVA CATEGORÍA
                echo "<img id='aniadirCategoria' src='../img/categorias/iconoAniadirCategoria.png' alt='Añadir categoria' />";
                
                echo "</figure>";
                echo "</div>";
                echo "</div>";
                ?>
            </section>

            <!--NCLUIMOS EL ASIDE CON LA PUBLICIDAD Y UN BOTÓN DE SUBIR A LA CABECERA -->
            <?php
            include './aside.php';
            include './subir.php';
            ?>

        </div>
        <?php
        //INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
    </body>

</html>