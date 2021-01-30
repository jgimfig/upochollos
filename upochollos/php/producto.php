<?php
// INLCUIMOS LAS FUNCIONES PHP COMUNES A TODO EL PROYECTO
include_once 'funciones.php';
session_start();
$_SESSION["idProducto"] = $_GET["idProducto"];
if (!isset($_GET["idProducto"])) {
    header('location: ./principal.php');
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
        <link href="../css/estiloComentario.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloPerfil.css" rel="stylesheet" type="text/css"/>
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include 'libreriasJS.php'; ?>
        <script src="../js/comentario.js" type="text/javascript"></script>
        <!--FUNCIONES E INTERACCIONES JS ESPECÍFICAS-->
        <script type='text/javascript' src='../js/comprobacionProducto.js'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script>
            $(document).ready(function () {
                listComment();
                $("#submitButton").click(function () {
                    $("#comment-message").css('display', 'none');
                    var str = $("#frm-comment").serialize();

                    $.ajax({
                        url: "comment-add.php",
                        data: str,
                        type: 'post',
                        success: function (response)
                        {
                            var result = eval('(' + response + ')');
                            if (response)
                            {
                                $("#comment-message").css('display', 'inline-block');
                                $("#name").val("");
                                $("#comment").val("");
                                $("#commentId").val("");
                                listComment();
                            } else
                            {
                                alert("Failed to add comments !");
                                return false;
                            }
                        }
                    });
                });
            });

        </script>
    </head>


    <body>
        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include 'header.php';
        ?>
        <?php
        $row = getProducto($_GET["idProducto"]);
        if (getUsuarioProducto($_GET["idProducto"]) == getNombreUsuario() || getAdministrador()) {
            echo '
                 ';
        }
        ?>
        <div class="gridC">
            <div class="btnChollo" id="divChollo">
                <form method="post" action="crud.php">
                    <input type="hidden" name="id" value="<?php echo $_GET["idProducto"]; ?>">
                    <button class="tablink" id="btnProducto" name="btnBorrar" value="Eliminar Producto">Borrar Producto</button>
                 </form>
            </div>
            <div class="btnCupon" id="divCupones">
                <form method="post" action="modificarProducto.php">
                    <input type="hidden"  name="id" value="<?php echo $_GET["idProducto"]; ?>">
                    <button class="tablink" id="btnCupones" name="btnModificar" value="Modificar Producto">Modificar Producto</button>
                 </form>
            </div>
        </div>
        <?php
//        echo '<article class="marco">
//            <section class="grid-container">
//              <div class="fotoG">
//                <img class="fotoGrid" src="../img/fotos/' . $row[0][8] . '" alt="' . $row[0][3] . '">
//              </div>
//              <div class="titulo">
//               <strong>' . $row[0][3] . '</strong>
//              </div>
//              <div class="precio">
//                <span>
//                    <span>' . $row[0][6] . '</span>
//                    <span>' . $row[0][2] . '</span>
//                    <span>' . $row[0][11] . '</span>
//                </span>
//              </div>
//              <div class="descripcion">
//                <div>
//                    <p>' . $row[0][7] . '</p>
//                </div>
//              </div>
//              <div class="autor">
//                <span>
//                    <i class="fas fa-user-edit"></i>
//                    <p>' . $row[0][9] . '</p>
//                </span>
//              </div>
//              <div class="boton">
//                <a href="' . $row[0][1] . '" class="button btn btn-primary" target="_blank">Ir al producto</a>
//              </div>
//            </section>
//            </article><br />';
        echo '<section class="grid-container">
              <div class="fotoG">
                <img class="fotoGrid" src="../img/fotos/' . $row[0][8] . '" alt="' . $row[0][3] . '">
              </div>
              <div class="titulo">
               <strong>' . $row[0][3] . '</strong>
              </div>
              <div class="categoria">
              <i class="fas fa-tag"></i>
               <span>' . $row[0][10] . '</span>
              </div>
              <div class="precioAntes">
               <span>' . $row[0][6] . '</span>
              </div>
              <div class="precioAhora">
                    <span>' . $row[0][2] . '</span>
              </div>
              <div class="tienda">
              <i class="fas fa-store"></i>
               <span>' . $row[0][11] . '</span>
              </div>
              <div class="descripcion">
                <div>
                    <p>' . $row[0][7] . '</p>
                </div>
              </div>
              <div class="autor">
                <span>
                    <i class="fas fa-user-edit"></i>
                    <span>' . $row[0][9] . '</span>
                </span>
              </div>
              <div class="button">
                <a href="' . $row[0][1] . '" class="button btn btn-primary" target="_blank">Ir al producto</a>
              </div>
            </section>';
        ?>

        <div class="comment-form-container">
            <form id="frm-comment">
                <div class="input-row">
                    <input type="hidden" name="comment_id" id="commentId" placeholder="Name" />
                    <input class="input-field" type="hidden" name="name" id="name" value=<?php echo $row[0][9]; ?> />
                </div>
                <div class="input-row">
                    <textarea class="input-field" type="text" name="comment" id="comment" placeholder="Añadir Comentario">  </textarea>
                </div>
                <div>
                    <input type="button" class="btn-submit" id="submitButton" value="Publicar" />
                    <div id="comment-message">Comentario Añadido correctamente!</div>
                </div>

            </form>
        </div>
        <div id="output"></div>
    </body>  
</html> 