<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>

<header>
    <div id="cabecera">

        <figure id="logo"><img src="../img/logo.png" alt="logo Newz"/></figure>
        
        <?php
        // Si el usuario ha iniciado sesión se mostrará su foto de perfil
        // y la opción de cerrar sesión.
        // En caso contrario se muestra una imagen genérica y la opción de inciar sesión
        /*if (comprobarLogin()) {
            $urlImagen = getURLImagenUsuario();
            echo "<p><a href='logout.php'>Cerrar sesión</a></p> <a href='../php/perfil.php'><figure id='sesion'><img src='$urlImagen' alt='icono de usuario'/></figure></a>";
        } else {
            echo "<a href='../php/login.php'><figure id='sesion'><img src='../img/iconos/iconoUsuario.svg' alt='icono de usuario'/></figure></a>";
        }*/
        ?>

    </div>
</header>
<nav>
    <ol>
        <li><a href="tablon.php">Tablón</a></li>
        <li><a href="comunidad.php">Comunidad</a></li>
        <li><a href="fakeNews.php">Fake news</a></li>
    </ol>
</nav>