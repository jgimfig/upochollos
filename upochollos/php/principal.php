<?php
// FUNCIONES COMUNES A TODO EL PROYECTO
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <!--ESTILOS PROPIOS DE COMUNIDAD-->
        <link rel="stylesheet" type="text/css" href="../css/estiloPrincipal.css">
        <link rel="stylesheet" type="text/css" href="../css/estiloPaginacion.css">
        <link rel="stylesheet" type="text/css" href="../css/estiloPagina.css">
        <link href="../css/estiloTab.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estiloPPrincipal.css" rel="stylesheet" type="text/css"/>
        <!--INCLUSIÓN DE LIBRERIAS JS COMUNES A TODO EL PROYECTO-->
        <?php include './libreriasJS.php'; ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->

        <script>
            $(document).ready(function () {
                load_data();
                function load_data(page)
                {
                    $.ajax({
                        url: "pagination.php",
                        method: "POST",
                        data: {page: page},
                        success: function (data) {
                            $('#pagination_data').html(data);
                        }
                    })
                }
                function load_Cupones(page)
                {
                    $.ajax({
                        url: "paginationCupones.php",
                        method: "POST",
                        data: {page: page},
                        success: function (data) {
                            $('#paginationCupones_data').html(data);
                        }
                    })
                }
                $(document).on('click', '.pagination_link', function () {
                    var page = $(this).attr("id");
                    load_data(page);
                    load_Cupones(page);
                });
                document.getElementById("defaultOpen").click();
            });
            function openPage(pageName, elmnt, color) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tab");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].style.backgroundColor = "";
                }
                document.getElementById(pageName).style.display = "block";
                elmnt.style.backgroundColor = color;
            }
        </script>
    </head>
    <body>

        <?php
        //INCLUIMOS EL HEADER y NAV CON INTERACCIÓN COMÚN A TODA LA PAGINA
        include './header.php';
        ?>

        <div class="grid">
            <?php
            include './aside.php';
            ?>
            <div class="btnChollo">
                <button class="tablink" onclick="openPage('chollo', this, 'orange')" id="defaultOpen">Chollos</button>
            </div>
            <div class="btnCupon">
                <button class="tablink" onclick="openPage('cupon', this, 'orange')">Cupones</button>
            </div>
            <div class="nothing">
                
            </div>
            <div class="tabcontent chollo tab" id="chollo">
                <div class="table-responsive" id="pagination_data"></div>
            </div>
            <div class="tabcontent cupon tab" id="cupon">
                <div class="table-responsive" id="paginationCupones_data"></div> 
            </div>
        </div>
        <?php
        //INCLUIMOS EL FOOTER
        include './footer.php';
        ?>
    </body>
</html>