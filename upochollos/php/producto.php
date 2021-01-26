<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>
<!DOCTYPE html>  
<html>  
    <head>  
        <title></title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link href="../css/estiloPaginacion.css" rel="stylesheet" type="text/css"/>
    </head>  
    <body>
        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include 'header.php';
        ?>
        <?php
        $row = consulta('SELECT * FROM `producto` WHERE `id`='.$_GET["idProducto"]);
        echo '<article class="marco">
            <section class="grid-container">
              <div class="fotoG">
                <img class="fotoGrid" src="../img/fotos/'.$row[0][8].'" alt="'.$row[0][3].'">
              </div>
              <div class="titulo">
               <strong>' . $row[0][3] . '</strong>
              </div>
              <div class="precio">
                <span>
                    <span>' . $row[0][6] . '</span>
                    <span>' . $row[0][2] . '</span>
                    <span>' . $row[0][11] . '</span>
                </span>
              </div>
              <div class="descripcion">
                <div>
                    <p>' . $row[0][7] . '</p>
                </div>
              </div>
              <div class="autor">
                <span>
                    <i class="fas fa-user-edit"></i>
                    <p>' . $row[0][9] . '</p>
                </span>
              </div>
              <div class="boton">
                    <button class="button buttonC" onclick="window.location.href=' . $row[0][1] . '">Ir al producto</button>
              </div>
            </section>
            </article><br />';
        ?>     
    </body>  
</html> 