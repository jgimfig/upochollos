//MEDIANTE AJAX, SE HARA UNA LLAMADA A LA ACCIÓN "cargarTiendasAction".
//UNA VEZ RECIBIDA LA RESPUESTA, SE PROCEDE A ESTRUCTURAR LA INFORMACION EN CODIGO HTML, QUE SERÁ AÑADIDO A chollo.jsp
$("#tiendas").ready(function () {


    $.ajax({
        url: "cargarTiendasAction",

        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error ' + textStatus);
            alert(errorThrown);
            alert(XMLHttpRequest.responseText);
        },
        success: function (respuesta) {

            let tiendas =  respuesta.trim().split(";");
             var contextoAPP = $("#contexto").val();
            
            for (var i = 0; i < tiendas.length; i++)
            {
                var datosTienda = tiendas[i].trim().split(",");
                var nombreTienda = datosTienda[0].trim();
                var imagenTienda = datosTienda[1].trim();
                
                $("#tiendas").append("\n\
                    <button class='tienda' id='tienda"+nombreTienda+"'>\n\
                        <img src='"+contextoAPP+"/Vistas/imagenes/tiendas/"+imagenTienda+"' alt='Logo de "+nombreTienda+"'/>\n\
                    </button>");
                                
            }

        }
    });


});