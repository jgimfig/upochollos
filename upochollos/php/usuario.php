<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';

if (getNombreUsuario() == "") {
    header('location: ./principal.php');
}

if(isset($_GET['eliminar'])){
    $query1="delete from comentario where usuario='". getNombreUsuario()."'";
    $query2="delete from puntua where nombre_usuario='". getNombreUsuario()."'";
    $query3="delete from cupon where usuario='". getNombreUsuario()."'";
    $query4="delete from producto where usuario='". getNombreUsuario()."'";
    $query5="delete from usuario where usuario='". getNombreUsuario()."'";
    consulta($query1);
    consulta($query2);
    consulta($query3);
    consulta($query4);
    consulta($query5);
    unset($_SESSION['usuario']);
    unset($_SESSION['tipo']);
    session_destroy();
    header('location: ./principal.php');
}

function compruebaCorreo(){
    if(isset($_POST['actualizaCorreo'])){
        $correo= Trim(filter_input(INPUT_POST,"correo", FILTER_SANITIZE_EMAIL));
        $pass=Trim(filter_input(INPUT_POST,"contrasenya", FILTER_SANITIZE_MAGIC_QUOTES));
        if($correo!="" && $pass!=""){
            if(verificaPass($pass)){
                $query="update usuario set email='".$correo."' where usuario='".getNombreUsuario()."'";  
                consulta($query);
            }else{
                echo "<p class='error'>ERROR: Contraseña no válida</p>";                
            }
        }else{
            echo "<p class='error'>ERROR: Algún campo está vacío</p>";
        }
    }
}

function cambioPass(){
    if(isset($_POST['actualizaContrasenya'])){
        $pass= Trim(filter_input(INPUT_POST,"contrasenya", FILTER_SANITIZE_MAGIC_QUOTES));
        $npass=Trim(filter_input(INPUT_POST,"ncontrasenya", FILTER_SANITIZE_MAGIC_QUOTES));
        $rpass=Trim(filter_input(INPUT_POST,"rcontrasenya", FILTER_SANITIZE_MAGIC_QUOTES));
        if($pass!="" && $npass!="" && $rpass!=""){
            if(verificaPass($pass)){
                if($npass==$rpass){
                    $hash = password_hash($npass, PASSWORD_DEFAULT);
                    $query="update usuario set hash='".$hash."' where usuario='".getNombreUsuario()."'";  
                    consulta($query);
                }else{
                    echo "<p class='error'>ERROR: La nueva contraseña no coincide al repetirla</p>";
                }
            }else{
                echo "<p class='error'>ERROR: Contraseña no válida</p>";                
            }
        }else{
            echo "<p class='error'>ERROR: Algún campo está vacío</p>";
        }
    }
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

        <!--ESTILOS PROPIOS DEL PERFIL-->
        <link rel="stylesheet" type="text/css" href="../css/estiloPerfil.css">
        <link href="../css/estiloPagina.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloUsuario.css" rel="stylesheet" type="text/css"/>
        <?php include './libreriasJS.php'; ?>
        <script src="../js/usuario.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $("#divCupones").click(function () {
                    $("#btnProducto").css({backgroundColor: ''});
                    $("#btnCupones").css({backgroundColor: 'orange'});
                    $("#producto").hide();
                    $("#cupon").show();
                });
                $("#divChollo").click(function () {
                    $("#btnProducto").css({backgroundColor: 'orange'});
                    $("#btnCupones").css({backgroundColor: ''});
                    $("#producto").show();
                    $("#cupon").hide();
                });
                $("#divCupones").click();
            });
        </script>
    </head>
    <body>
        <?php
        include 'libreriasJS.php';
        include 'header.php';
        ?>
        <main>

            <div id="top">
                <h1>Configuración</h1>
                <form name="eliminar" method="get" action="#" onsubmit="return elimina()">
                    <input id="eliminar" type="submit" name="eliminar" value="Eliminar cuenta"/>
                </form>
            </div>
            </br>
            <div id="forms">
                <div id="foto">
                    <?php
                    if (isset($_POST['subir'])) {
                        if ($_FILES['foto']['error'] == 0) {
                            $query="update usuario set foto='".$_FILES['foto']['name']."' where usuario='". getNombreUsuario()."'";
                            $tmp=$_FILES['foto']['tmp_name'];
                            move_uploaded_file($tmp, "../img/usuarios/".$_FILES['foto']['name']);
                            consulta($query);
                        } else {
                            echo "<p class='error'>ERROR: ERROR AL SUBIR LA FOTO</p>";
                        }
                    }
                    ?>
                    <p>Foto de perfil</p>
                    <form name="fperil" method="POST" enctype="multipart/form-data"  onsubmit="return validacionFoto()">
                        <input type="file" name="foto" id="inputFoto"/></br></br>
                        <?php
                        $foto = consulta("select foto from usuario where usuario='" . $_SESSION['usuario'] . "'")[0][0];
                        echo "<img src='../img/usuarios/" . $foto . "'/>"
                        ?>
                        </br></br>
                        <input id="enviar" type="submit" name="subir" value="Subir foto"/>
                    </form>
                    </br>
                </div>
                <div id="correo">
                    <?php compruebaCorreo(); ?>
                    <p>Correo eletrónico</p>
                    <form method="POST" name="fCorreo">
                        <label for="correo">Nuevo correo electrónico</label></br>
                        <input class="input" type="text" name="correo"/></br>
                        <label for="contrasenya">Contraseña</label></br>
                        <input class="input" type="password" name="contrasenya"/></br></br>
                        <input id="enviar" type="submit" name="actualizaCorreo"/>
                    </form>
                </div>
                <div id="contrasenya">
                    <?php cambioPass(); ?>
                    <p>Cambiar contraseña</p>
                    <form method="POST" name="fpass">
                        <label for="correo">Contraseña actual</label></br>
                        <input class="input" type="password" name="contrasenya"/></br>
                        <label for="ncontrasenýa">Nueva contraseña</label></br>
                        <input class="input" type="password" name="ncontrasenya"/></br>
                        <label for="rcontrasenýa">Repetir contraseña</label></br>
                        <input class="input" type="password" name="rcontrasenya"/></br></br>
                        <input id="enviar" type="submit" name="actualizaContrasenya"/>
                    </form>
                    </br>
                </div>

            </div>
        </main>
<?php include 'footer.php'; ?>
    </body>