
/*
 * 
 * ESTE SCRIPT AÑADE INTERACTIVIDAD A LAS CELDAS DEL TABÓN
 * CUANDO EL RATÓN SE SITUA ENCIMA DE UNA CATEGORÍA, SE DUPLICA LA ACCIÓN DE CLIC 
 * DEL TÍTULO QUE CONTIENE UN ENLACE A LA CATEGORÍA
 * 
 * CUANDO EL CURSOR SE SITUA ENCIMA DE UNA CATEGORÍA, MUESTRA EL BOTÓN DE ELIMINAR CATEGORÍA
 * Y LO OCULTA EN CASO CONTRARIO
 * 
 * COMO DEPENDEMOS DE OTRAS PÁGINAS, AL PULSAR SOBRE ALGUNA CATEGORÍA
 * SE MOSTRARÁ UNA NOTIFICACIÓN DE 'CARGANDO...' 
 * 
 */
$(document).ready(function () {
    $(".categoria")
            .find('.fondoCategoria')
            .css({'cursor': 'pointer'})
            .click(function () {
                window.location.href = $(this).parent().find('a').attr('href');
            });

    $("#aniadirCategoria")
            .css({'cursor': 'pointer'})
            .click(function () {
                window.location.href = $(this).parent().parent().find('a').attr('href');
            });

    $('.eliminarCategoria').hide();

    $(".categoria").mouseover(function () {
        $(this).find('.eliminarCategoria').show();
    });

    $(".categoria").mouseout(function () {
        $(this).find('.eliminarCategoria').hide();
    });
    
    $(".categoria").click(function () {
       siiimpleToast.success('Cargando...');
    });
    
});