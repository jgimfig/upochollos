<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

// SI EL USUARIO NO ESTÁ LOGEADO SERÁ REDIRIGIDO A LA VENTANA DE LOGIN
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
        
        // AGREGAMOS LA TEMATICA RECIBIDA A LA BASE DE DATOS
        if (isset($_POST['tematicaAAniadir'])) {
            $tematica = $_POST['tematicaAAniadir'];
            aniadirTematica($tematica);
        }
        ?>

        <!-- DIVISOR PRINCIPAL: Divide contenido prncipal y publicidad -->
        <div id="divisorPagina">
            <section>
                <h2>Añadir Categorías</h2>
                
                <!--CÁTEGORIAS NO SELECCIONADAS POR EL USUARIO-->
                <?php
                $categoriasUsuario = getCategoriasNoInteresadoUsuario();
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
                    
                    // BOTON DE AÑADIR CATEGORÍA A LA LISTA DEL USUARIO
                    echo "<figure class='aniadirCategoria'>";
                    echo "<button class='botonAniadir'>";
                    echo "<img id='aniadir_$c[0]' src='../img/categorias/iconoAniadirCategoria.png' alt='iconoAniadirCategoria' onclick='aniadirTematica(event)'/>";
                    echo "</button>";
                    echo "</figure>";
                    
                    echo "</div>";
                }
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

