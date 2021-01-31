<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (!getAdministrador())
    header('location: ./principal.php');

if(isset($_GET['eliminar'])){
    $query="delete from tienda where nombre='".$_GET['ntienda']."'";
    if(!consulta($query))
        echo "<script>alert('No se puede eliminar ya que hay un producto asociado a dicha tienda');</script>";
}

if(isset($_POST['crear'])){
    $nombre=filter_input(INPUT_POST,'ntienda',FILTER_SANITIZE_MAGIC_QUOTES);
    $query="select count(1) from tienda where nombre='".$nombre."'";
    if($nombre!="" && $_FILES['logo']['error']==0){        
        if(consulta($query)[0][0]>0){ //Si ya existe esa tienda actualizamos el logo
            $actualiza="update tienda set logo='".$_FILES['logo']['name']."' where nombre='".$nombre."'";
            consulta($actualiza);
            agregaImagen($nombre);
        }else{      //Si no existe la tienda la creamos e insertamos el logo
            $insertar="insert into tienda values('".$nombre."','".$_FILES['logo']['name']."')";
            consulta($insertar);
            agregaImagen($nombre);
        }
    }else
        echo "<script> alert('ERROR: El nombre y el logo deben de estar rellenos');</script>";
}    
    
function agregaImagen($nombre){
    $tmp=$_FILES['logo']['tmp_name'];
    move_uploaded_file($tmp, "../img/tiendas/".$_FILES['logo']['name']);
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

        <!--ESTILOS PROPIOS DE LOGIN-->
        <link rel="stylesheet" type="text/css" href="../css/estiloTienda.css">
        <link rel="stylesheet" type="text/css" href="../css/estiloPagina.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; include 'header.php'; ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECIFICAS DE LA PAGINA DE USUARIO-->
        <script type='text/javascript' src='../js/comprobacionLogin.js'></script>
        <script type='text/javascript' src='../js/tienda.js'></script>

    </head>
    <body>
        <main>
            <div id="gestion">
                <h2>Gestión de tiendas</h2>
                <form name="ftienda" enctype="multipart/form-data" method="POST" action="tienda.php">
                    <p>Nombre tienda:</p>
                    <input class="input" type="text" name="ntienda" id="ntienda"/>
                    <span id="new"><input type="reset" class="enviar" onclick="habilita()"/></span>
                    <p>Logo:</p>
                    <input type="file" name="logo"/></br></br>
                    <input class="enviar" id="crear" name="crear" type="submit" value="Crear/Editar" onclick="habilita()"/>
                </form>
            </div>
            <div id="tiendas">
                <table>
                    <tbody id="tablaTiendas">
                        <tr>
                            <th>Logo</th>
                            <th>Nombre</th>
                            <th></th>
                            <th></th>
                        </tr>
                    
                        <?php
                        $consulta = ("select * from tienda");
                        $tiendas = consulta($consulta);
                        for ($i = 0; $i < count($tiendas); $i++) {
                            echo "<tr>"
                            . "<td><img src='../img/tiendas/" . $tiendas[$i][1] . "'/></td>"
                            . "<td>" . $tiendas[$i][0] . "</td>"
                            . "<td><button class='enviar' onclick=editar(this)>Editar</button></td>";
                            ?>
                            <form action="tienda.php" method="GET" >
                            <?php
                            echo "<input name='ntienda' type='hidden' value=".$tiendas[$i][0].">";
                            echo "<td><input class='enviar' name='eliminar' type='submit' value='Eliminar'/></td>";?></form><?php 
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
                    <?php
//INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
</html>


