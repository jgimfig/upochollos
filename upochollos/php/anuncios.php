<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
if (!getAdministrador())
    header('location: ./principal.php');

if(isset($_GET["eliminarP"])){
    $query="delete from patrocinador where CIF='".$_GET['neliminar']."'";
    $f=consulta($query);
    if(!consulta($query))
        echo "<script>alert('No se puede eliminar ya que hay un anuncios asociados a dicho patrocinador');</script>";
}

if(isset($_GET["eliminarA"])){
    $query="delete from anuncio where ID='".$_GET['neliminar']."'";
    if(!consulta($query))
        echo "<script>alert('ERROR DE BASE DE DATOS');</script>";
}

if(isset($_GET['crearP'])){
    $cif=filter_input(INPUT_GET,'cif',FILTER_SANITIZE_MAGIC_QUOTES);
    $cif= trim($cif);
    $npatrocinador=filter_input(INPUT_GET,'npatrocinador',FILTER_SANITIZE_MAGIC_QUOTES);
    $npatrocinador= trim($npatrocinador);
    $query="select count(1) from patrocinador where cif='".$cif."'";
    if($cif!="" && $npatrocinador!=""){        
        if(consulta($query)[0][0]>0){ //Si ya existe ese patrocinador actualizamos los campos
            $actualiza="update patrocinador set nombre='".$npatrocinador."' where cif='".$cif."'";
            consulta($actualiza);
        }else{      //Si no existe el patrocinador lo creamos
            $insertar="insert into patrocinador values('".$cif."','".$npatrocinador."')";
            consulta($insertar);
        }
    }else
        echo "<script> alert('ERROR: El cif y el nombre deben de estar rellenos');</script>";
} 

if(isset($_POST['crearA'])){
    $titulo=filter_input(INPUT_POST,'titulo',FILTER_SANITIZE_MAGIC_QUOTES);
    $fecha_inicio=filter_input(INPUT_POST,'fechaInicio',FILTER_SANITIZE_MAGIC_QUOTES);
    $fecha_fin=filter_input(INPUT_POST,'fechaFin',FILTER_SANITIZE_MAGIC_QUOTES);
    $descripcion=filter_input(INPUT_POST,'descripcion',FILTER_SANITIZE_MAGIC_QUOTES);
    $cif_patrocinador=filter_input(INPUT_POST,'cifPatrocinador',FILTER_SANITIZE_MAGIC_QUOTES);
    $cuantia=filter_input(INPUT_POST,'cuantia',FILTER_SANITIZE_MAGIC_QUOTES);
    if($cif_patrocinador!="" && $titulo!="" && $fecha_inicio!="" && $fecha_fin!="" && $descripcion!="" && $cuantia!="" && $_FILES['multimedia']['error']==0){       
        if($_POST['editar']!=""){    //Si ya existe ese anuncio actualizamos los campos
            $actualiza="update anuncio set titulo='".$titulo."',fecha_inicio='".$fecha_inicio."',cif_patrocinador='".$cif_patrocinador."',fecha_fin='".$fecha_fin."',descripcion='".$descripcion."',contenido_multimedia='".$_FILES['multimedia']['name']."',cuantia='".$cuantia."' where id='".$_POST['editar']."'";
            if(!consulta($actualiza)){
                echo "<script> alert('ERROR: El cif no corresponde con ningún patrocinador existente');</script>";
            }
        }else{      //Si no existe el anuncio lo creamos
            $insertar="insert into anuncio (titulo,fecha_inicio,cif_patrocinador,fecha_fin,descripcion,contenido_multimedia,cuantia) values('".$titulo."','".$fecha_inicio."','".$cif_patrocinador."','".$fecha_fin."','".$descripcion."','".$_FILES['multimedia']['name']."','".$cuantia."')";
            if(!consulta($insertar)){
                echo "<script> alert('ERROR: El cif no corresponde con ningún patrocinador existente');</script>";
            }
        }
    }else
        echo "<script> alert('ERROR: Todos los campos deben estar rellenos');</script>";
}

function agregaImagen($nombre){
    $tmp=$_FILES['multimedia']['tmp_name'];
    move_uploaded_file($tmp, "../img/anuncios/".$_FILES['multimedia']['name']);
}

function muestraPatrocinadores() {
    $consulta = ("select * from patrocinador");
    $patrocinadores = consulta($consulta);
    for ($i = 0; $i < count($patrocinadores); $i++) {
        echo "<tr>"
        . "<td>".$patrocinadores[$i][0]."</td>"
        . "<td>" . $patrocinadores[$i][1] . "</td>"
        . "<td><button class='enviar' onclick=editarPatrocinador(this)>Editar</button></td>";
        ?>
        <form action="anuncios.php" method="GET" >
            <?php
            echo "<input name='neliminar' type='hidden' value=" . $patrocinadores[$i][0] . ">";
            echo "<td><input class='enviar' name='eliminarP' type='submit' value='Eliminar'/></td>";
            ?></form><?php
        echo "</tr>";
    }
}

function muestraAnuncios() {
    $consulta = ("select * from anuncio");
    $anuncios = consulta($consulta);
    for ($i = 0; $i < count($anuncios); $i++) {
        echo "<tr>"
        . "<td style='visibility: hidden;'>" . $anuncios[$i][0] . "</td>"
        . "<td>" . $anuncios[$i][3] . "</td>"
        . "<td>" . $anuncios[$i][1] . "</td>"
        . "<td>" . $anuncios[$i][2] . "</td>"
        . "<td>" . $anuncios[$i][4] . "</td>"
        . "<td>" . $anuncios[$i][5] . "</td>"
        . "<td>" . $anuncios[$i][7] . "</td>"
        . "<td><img src='../img/anuncios/ ".$anuncios[$i][6]."'/></td>"
        . "<td><button class='enviar' onclick=editarAnuncio(this)>Editar</button></td>";
        ?>
        <form action="anuncios.php" method="GET" >
            <?php
            echo "<input name='neliminar' type='hidden' value=" . $anuncios[$i][0] . ">";
            echo "<td><input class='enviar' name='eliminarA' type='submit' value='Eliminar'/></td>";
            ?></form><?php
        echo "</tr>";
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

        <!--ESTILOS PROPIOS DE LOGIN-->
        <link rel="stylesheet" type="text/css" href="../css/estiloAnuncios.css">
        <link rel="stylesheet" type="text/css" href="../css/estiloPagina.css">

        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php
        include 'libreriasJS.php';
        include 'header.php';        
        ?>

        <!--FUNCIONES E INTERACCIONES JS ESPECIFICAS DE LA PAGINA DE USUARIO-->
        <script type='text/javascript' src='../js/comprobacionLogin.js'></script>
        <script type='text/javascript' src='../js/anuncios.js'></script>

    </head>
    <body>
        <main>
            <div id="patrocinadores">
                <div id="crear">
                    <h2>Gestión de patrocinadores</h2>
                    <form name="fpatrocinadores" method="GET" action="anuncios.php">
                        <p>CIF:</p>
                        <input class="input" type="text" name="cif" id="cif"/>
                        <input type="reset" class="enviar" class="restablece" onclick="habilita(this)"/>
                        <p>Nombre:</p>
                        <input  class="input" type="text" name="npatrocinador" id="npatrocinador"/></br>
                        <input class="enviar" id="crear" name="crearP" type="submit" value="Crear/Editar" onclick="habilita(this)"/>
                    </form>
                </div>
                <div id="mostrar">
                    <table>
                        <tbody id="tablaPatrocinadores">
                            <tr>
                                <th>CIF</th>
                                <th>Nombre</th>
                                <th></th>
                                <th></th>
                            </tr>                           
                            <?php muestraPatrocinadores(); 
                            ?>
                        </tbody>
                    </table>                    
                </div>
            </div>
            <div id="anuncios">
                 <h2>Gestión de anuncios</h2>
                    <form name="fanuncios" enctype="multipart/form-data" method="POST" action="anuncios.php">
                        <p>CIF patrocinador:</p>
                        <input class="input" type="text" name="cifPatrocinador" id="cifPatrocinador"/>
                        <p>Título:</p>
                        <input  class="input" type="text" name="titulo" id="titulo"/>
                        <p>Fecha inicio:</p>
                        <input type="date" class="input" id="fechaInicio" name="fechaInicio" value=<?php echo "'" . date('Y-m-d', strtotime("+1 week")) . "'"; ?> min=<?php echo "'" . date('Y-m-d') . "'"; ?>><br/><br/>
                        <p>Fecha fin:</p>
                        <input type="date" class="input" id="fechaFin" name="fechaFin"><br/><br/>
                        <p>Descripción:</p>
                        <textarea  class="input" type="text" name="descripcion" id="descripcion"/></textarea>
                        <p>Cuantía:</p>
                        <input  class="input" type="text" name="cuantia" id="cuantia"/>€</br></br>
                        <input type="file" name="multimedia"/>
                        </br>                        
                        <input type="hidden" name="editar" id="editar" value=""/>                      
                        <input class="enviar" id="crear" name="crearA" type="submit" value="Crear/Editar"/></br>                        
                    </form>
                 <button class="enviar" class="restablece" id="cancelar" onclick="cancelar(this)" style="visibility: hidden;">Cancelar Edición</button>
                 </br></br>
                    <table id="tablaAnuncios">
                        <tbody>
                            <tr>
                                <th></th>
                                <th>CIF Patrocinador</th>
                                <th>Título</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Descripción</th>
                                <th>Cuantía</th>
                                <th>Contenido multimedia</th>
                                <th></th>
                                <th></th>
                            </tr>                           
                            <?php muestraAnuncios();?>
                        </tbody>
                    </table>
            </div>
        </main>        
        <?php include 'footer.php'; ?>
    </body>
</html>