
/*
 * EN RELACIÓN A LA FLECHA COMÚN A TODO EL PROYETO, AL SER PULSADA
 * TRASÑADARÁ EL SCROLL DEL DOCUMENTO HASTA ARRIBA.
 * 
 * */

$("#subir").ready(function () {
    
    $("#subir").hide();
    
    $(window).scroll(function () {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $("nav").offset().top;
        var elemBottom = elemTop + $("nav").height();
        
        if(elemBottom <= docViewBottom && elemTop >= docViewTop){
            $("#subir").hide();
        }else{
            $("#subir").show();
        }
    });
    
    $("#subir").click(function(){
        $('header').animatescroll();
    });
});