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
        <!-- Font awesome -->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <!-- RateYO! -->
        <script src="https://prrashi.github.io/rateYo/bower_components/jquery-rateyo/min/jquery.rateyo.min.js"></script>
        <link rel="stylesheet" type="text/css" href="jquery.rateyo.min.css">
        <style>
            @import url("https://prrashi.github.io/rateYo/bower_components/jquery-rateyo/min/jquery.rateyo.min.css");
        </style>
        <script>
            $(document).ready(function () {
                listComment();
                $('#starForm').hide();
                $("#rateYo").rateYo({
                    spacing: "5px",
                    starWidth: "30px",
                    numStars: 5,
                    minValue: 0,
                    maxValue: 5,
                    halfStar: true,
                    multiColor: {
                        "startColor": "#FF0000", //RED
                        "endColor": "#ffcc00"  //GREEN
                    }
                });
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

                function rateProducto() {
//                    document.getElementById("starForm").submit();
                    alert("ddd");
                }
                $("#rateYo").rateYo().on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
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
            echo '<div class="gridC">
            <div class="btnChollo" id="divChollo">
                <form method="post" action="crud.php">
                    <input type="hidden" name="id" value="' . $_GET["idProducto"] . '">
                    <button class="tablink" id="btnProducto" name="btnBorrar" value="Eliminar Producto">Borrar Producto</button>
                </form>
            </div>
            <div class="btnCupon" id="divCupones">
                <form method="post" action="modificarProducto.php">
                    <input type="hidden"  name="id" value="' . $_GET["idProducto"] . '">
                    <button class="tablink" id="btnCupones" name="btnModificar" value="Modificar Producto">Modificar Producto</button>
                </form>
            </div>
        </div>';
        }
        ?>

        <?php
        echo '<section class="grid-container2">
              <div class="fotoG">
                <img class="fotoGrid" src="../img/fotos/' . $row[0][8] . '" alt="' . $row[0][3] . '">
              </div>
              <div class="titulo" onclick="rateProducto();">
               <strong>' . $row[0][3] . '</strong>
              </div>';

        echo '<form action="add_rate.php" method="post">
                <div id="rateYo" class= "rating" data-rateyo-rating="' . getPuntuaciones($_GET["idProducto"]) . '" onclick="rateProducto()"></div>
                <input type="hidden" name="rating">
                <input type="submit" id="starForm">
              </form>';

        echo '</div> 
              <div class="ct">
              <i class="fas fa-tag"></i>
                <span>' . $row[0][10] . '</span>
                    <span>&emsp;&emsp;</span>
                <i class="fas fa-store"></i>
                <span>' . $row[0][11] . '</span>
              </div>
              <div class="precioAntes">
               <span>' . $row[0][2] . '</span>
              </div>
              <div class="precioAhora">
                    <span>' . $row[0][6] . '</span>
              </div>

              <div class="descripcion">
                <div>
                    <p>' . $row[0][7] . '</p>
                </div>
              </div>
              <div class="fechas">
                    <p> <b>Fecha inicio</b>: ' . $row[0][4] . '</p>
                    <p> <b>Fecha fin</b>: ' . $row[0][5] . '</p>     
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
        if (getNombreUsuario() != "") {
            echo '<div class="comment-form-container">
            <form id="frm-comment">
                <div class="input-row">
                    <input type="hidden" name="comment_id" id="commentId" placeholder="Name" />
                    <input class="input-field" type="hidden" name="name" id="name" value="' . $row[0][9] . '"/>
                </div>
                <div class="input-row">
                    <textarea class="input-field" type="text" name="comment" id="comment" placeholder="Añadir Comentario"></textarea>
                </div>
                <div>
                    <input type="button" class="btn-submit" id="submitButton" value="Publicar" />
                    <div id="comment-message">Comentario Añadido correctamente!</div>
                </div>
            </form>
        </div>';
        }
        ?>
        <div id="output"></div>
    </body>  
</html> 