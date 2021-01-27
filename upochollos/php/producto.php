<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

if(isset($_GET['eliminar'])){
    $query="delete from tienda where nombre='".$_GET['ntienda']."'";
    echo $query;
    consulta($query);
}
?>
<!DOCTYPE html>  
<html>  
    <head>
        <title>UpoChollos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS-->
         <link rel="stylesheet" type="text/css" href="../css/estiloPaginacion.css">
         <link rel="stylesheet" type="text/css" href="../css/estiloPagina.css">
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS-->
        <script type='text/javascript' src='../js/comprobacionProducto.js'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>


    <body>
        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include 'header.php';
        ?>
        <?php
        $row = getProducto($_GET["idProducto"]);
        if (getUsuarioProducto($_GET["idProducto"]) == getNombreUsuario() ) {
            echo '<form method="post" action="crudProducto.php">
                    <input type="hidden" name="id" value="' . $_GET["idProducto"].'">
                    <input type="submit" name="btnBorrar" value="Eliminar Producto">
                 </form>
                 <form method="post" action="modificarProducto.php">
                    <input type="hidden"  name="id" value="' . $_GET["idProducto"].'">
                    <input type="submit" name="btnModificar" value="Modificar Producto">
                 </form>';
        }
        echo '<article class="marco">
            <section class="grid-container">
              <div class="fotoG">
                <img class="fotoGrid" src="../img/fotos/' . $row[0][8] . '" alt="' . $row[0][3] . '">
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
                <a href="'. $row[0][1] .'" class="button btn btn-primary" target="_blank">Ir al producto</a>
              </div>
            </section>
            </article><br />';
        ?>     
    </body>  
</html> 