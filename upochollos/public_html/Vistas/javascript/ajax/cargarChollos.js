//MEDIANTE AJAX, SE HARA UNA LLAMADA A LA ACCION "cargarChollos" PASANDOLO POR GET EL ULTIMO CHOLLO CARGADO.
//UNA VEZ RECIBIDA LA RESPUESTA, SE PROCEDE A ESTRUCTURAR LA INFORMACION EN CODIGO HTML, QUE SERA AÑADIDO AL JSP NTERIOR.
var ultimoCholloCargado = 0;


$("#selector_productos").ready(function () {

    ultimoCholloCargado = 0;
    cargaMasChollos();
});

function cargaMasChollos() {

    $.ajax({
        url: "cargarChollos?ultimoCholloCargado=" + ultimoCholloCargado + "&categoria="+$("#categoriaSeleccionada").val(),

        error: function (XMLHttpRequest, textStatus, errorThrown) {

            alert('Error ' + textStatus);
            alert(errorThrown);
            alert(XMLHttpRequest.responseText);

        },
        success: function (respuesta) {

            var res = respuesta.trim().split(":");

            var chollosCargadosRecibidos = parseInt(res[0] + "");


            if (ultimoCholloCargado === chollosCargadosRecibidos) {
                $("#botonCargar").remove();
            } else {
                ultimoCholloCargado = chollosCargadosRecibidos;

                var productos_codificados = res[1].trim().split("$");

                var contextoAPP = $("#contexto").val();

                $("#botonCargar").remove();

                for (var i = 0; i < productos_codificados.length; i++)
                {
                    var producto = productos_codificados[i].split("_");

                    var nombre = producto[0];
                    var precioDescuento = producto[1];
                    var precioOriginal = producto[2];
                    var imagen = producto[3];
                    var id = producto[4];

                    if (!id.includes("anuncio")) {

                        $("#selector_productos").append
                                (
                                        "<div class='producto' id ='" + id + "'> \n\
                        <figure id ='fig_" + id + "'> \n\
                            <img id='img_" + id + "' src='" + contextoAPP + "/Vistas/imagenes/productos/" + imagen + "' alt=''/> \n\
                        </figure> \n\
                        <div class='datos_producto' id='datos_" + id + "'> \n\
                            <p class='nombre_producto' id ='txt_" + id + "'>" + nombre + "</p> \n\
                            <p class='precio_actual' id='pac_" + id + "'>" + precioDescuento + "€</p> \n\
                            <p class='precio_anterior' id='pan_" + id + "'>" + precioOriginal + "€</p> \n\
                        </div> \n\
                    </div>"

                                        );
                    } else {

                        $("#selector_productos").append
                                (
                                        "<div class='producto' id ='" + id + "'> \n\
                        <figure id ='fig_" + id + "'> \n\
                            <img id='img_" + id + "' src='" + contextoAPP + "/Vistas/imagenes/anuncios/" + imagen + "' alt=''/> \n\
                        </figure> \n\
                        <div class='datos_producto' id='datos_" + id + "'> \n\
                            <p class='nombre_producto' id ='txt_" + id + "'>" + nombre + "</p> \n\
                            <p class='precio_actual' id='pac_" + id + "'>" + precioDescuento + "</p> \n\
                            <p class='precio_actual' id='pan_" + id + "'>" + precioOriginal + "</p> \n\
                        </div> \n\
                    </div>"

                                        );

                    }

                    inicializarProducto(id);
                }

                $("#selector_productos").append(" <button id='botonCargar' class='boton' onclick='cargaMasChollos()'>Cargar más chollos</button>");

            }
        }
    });


}

//SE LE PASA UN ID DE PRODUCTO Y LE PROPORCIONA INTERACTIVIDAD
function inicializarProducto(idProducto) {

    hideDatosProducto(idProducto);

    $('figure, img, #txt_' + idProducto).on('mouseenter', function () {
        var idProducto = event.target.id.split("_")[1];
        hideall();
        showDatosProducto(idProducto);
    });

    if (!idProducto.includes("anuncio")) {

        $("#" + idProducto).click(function (event) {

            let id = event.target.id.split("_")[1];

            if (id !== undefined) {

                var urlProducto = $("#contexto").val() + "/cargarChollo?id=" + id;

                window.location = urlProducto;
            }
        });
    } else {

        $("#" + idProducto + " .precio_actual").css("fontSize", "1.1em");

        var titulo = $("#pac_" + idProducto).text();
        var desc = $("#pan_" + idProducto).text();

        if ((titulo + desc).length > 51)
        {
            var caracteresRestantes = 51 - titulo.length;

            if (caracteresRestantes <= 0) {

                $("#pac_" + idProducto).text(titulo.substring(0, 49) + "...");
                $("#pan_" + idProducto).text("");

            } else {
                $("#pan_" + idProducto).text(desc.substring(0, caracteresRestantes - 3) + "...");
            }

        }

    }
}

 //COLAPSA TODOS LAS TARJETAS DE CHOLLOS
function hideall() {
    var productos = $(".producto");

    for (var i = 0; i < productos.length; i++)
    {
        var productoId = productos[i].id;
        hideDatosProducto(productoId);
    }
}

//SE LE PROPORCIONA UN ID DE UN PRODUCTO Y COLAPSA LA INFORMACION DEL MISMO
function hideDatosProducto(idProducto)
{
    var id = idProducto;

    $("#" + id).find(".datos_producto").find(".precio_actual").hide();
    $("#" + id).find(".datos_producto").find(".precio_anterior").hide();
    $("#" + id).find(".datos_producto").find(".nombre_producto").css({
        "padding-bottom": "1em"
    });

    $("#" + id).find(".datos_producto").css({
        "bottom": "4.55em"
    });

    $("#" + id).css({
        "margin-bottom": "0"
    });
}

//SE LE PASA EL ID DE UN PRODUCTO Y DESPLIEGA SUS DATOS, ESTA FUNCION SE INVOCA AL PASAR EL RATON POR ENCIMA DE UN CHOLLO
function showDatosProducto(idProducto)
{
    var id = idProducto;

    $("#" + id).find(".datos_producto").find(".precio_actual").show();
    $("#" + id).find(".datos_producto").find(".precio_anterior").show();
    $("#" + id).find(".datos_producto").find(".nombre_producto").css({
        "padding-bottom": "0.05em"
    });

    $("#" + id).css({
        "margin-bottom": "-3.5em"
    });

    $("#" + id).find(".datos_producto").css({
        "bottom": "7.95em"
    });

}



