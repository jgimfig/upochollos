//HACE GIRAR LA RUEDA DENTADA DE LA PAGINA DE AJUSTES DE USUARIO
$(document).ready(function () {


    $("#ajustes figure img").mouseover(
            function ()
            {
                $("#ajustes figure img").rotate({angle: 0, animateTo: 180, easing: $.easing.easeInOutExpo});
            }
    );


});