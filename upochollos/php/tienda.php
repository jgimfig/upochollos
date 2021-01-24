<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <title>UpoChollos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--FUENTE: Open Sans-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <!--ESTILOS PROPIOS DE LOGIN-->
        <link rel="stylesheet" type="text/css" href="../css/estiloLogin.css"> 
        <link rel="stylesheet" type="text/css" href="../css/estiloTienda.css"> 

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECIFICAS DE LA PAGINA DE USUARIO-->
        <script type='text/javascript' src='../js/comprobacionLogin.js'></script>

    </head>
    <body>
        <header></header>
        <div>
            <h2>Gestión de tiendas</h2>
            <form name="ftienda" enctype="multipart/form-data" method="POST">
                <p>Nombre tienda:</p>
                <input type="text" name="ntienda"/>
                <p>Logo:</p>
                <input type="file" name="logo"/></br>
                <input type="submit" value="Crear/Editar"/>
            </form>
        </div>
        <div class="tiendas">
            <table>
                <tbody>
                    <tr>
                        <th>Logo</th>
                        <th>Nombre</th>
                    </tr>
                    <?php
                    $consulta=("select * from tienda");
                    $tiendas= consulta($consulta);        
                    for($i=0;$i<count($tiendas);$i++){
                        echo "<tr>"
                        . "<td><img src='../img/tiendas/".$tiendas[$i][1]."'/></td>"
                        . "<td>".$tiendas[$i][0]."</td>"
                        . "</tr>";
                    }                            
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>


