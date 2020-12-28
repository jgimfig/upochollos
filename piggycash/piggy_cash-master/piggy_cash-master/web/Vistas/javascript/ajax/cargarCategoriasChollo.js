//MEDIANTE AJAX, SE HARA UNA LLAMADA A LA ACCIÓN "CargarCategoriasAction".
//LA RESPUESTA SERÁ UTILIZADA PARA EL COMBOBOX DE CREAR CHOLLO

$("#selectorCategorias").ready(function () {


    $.ajax({
        url: "cargarCategoriasAction",

        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error ' + textStatus);
            alert(errorThrown);
            alert(XMLHttpRequest.responseText);
        },
        success: function (respuesta) {

            $("#selectorCategorias").empty();

            $("#selectorCategorias").append("<option value='SIN-CATEGORIA' selected>SIN CATEGORÍA</option>");

            var categorias = respuesta.split(",");

            for (var i = 0; i < categorias.length; i++)
            {
                categorias[i] = categorias[i].trim();

                if (categorias[i] !== "")
                {
                    var nombreCategoria = categorias[i].split("_")[0];

                    $("#selectorCategorias").append("<option value='" + nombreCategoria + "'>" + nombreCategoria + "</option>");
                }
            }
        }
    });
});

//MEDIANTE AJAX, SE HARA UNA LLAMADA A LA ACCIÓN "cargarTiendasAction".
//LA RESPUESTA SERÁ UTILIZADA PARA EL COMBOBOX DE CREAR CHOLLO
$("#selectorTiendas").ready(function () {
    $.ajax({
        url: "cargarTiendasAction",

        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error ' + textStatus);
            alert(errorThrown);
            alert(XMLHttpRequest.responseText);
        },
        success: function (respuesta) {

            $("#selectorTiendas").empty();

            $("#selectorTiendas").append("<option value='SIN-TIENDA' selected>SIN TIENDA</option>");

            var Tiendas = respuesta.split(";");

            for (var i = 0; i < Tiendas.length; i++)
            {
                Tiendas[i] = Tiendas[i].trim();

                if (Tiendas[i] !== "")
                {
                    var nombreTienda = Tiendas[i].split(",")[0];

                    $("#selectorTiendas").append("<option value='" + nombreTienda + "'>" + nombreTienda + "</option>");
                }
            }
        }
    });
});

