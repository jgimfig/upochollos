//MEDIANTE AJAX, SE HARA UNA LLAMADA A LA ACCIÓN "CargarCategoriasAction".
//UNA VEZ RECIBIDA LA RESPUESTA, SE PROCEDE A ESTRUCTURAR LA INFORMACION EN CODIGO HTML, QUE SERÁ AÑADIDO AL index.jsp
$("#selector_categorias").ready(function () {


    $.ajax({
        url: "cargarCategoriasAction",

        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error ' + textStatus);
            alert(errorThrown);
            alert(XMLHttpRequest.responseText);
        },
        success: function (respuesta) {

            var categorias = respuesta.split(",");

            for (var i = 0; i < categorias.length; i++)
            {

                categorias[i] = categorias[i].trim();

                if (categorias[i] !== "")
                {
                    var nombreCategoria = categorias[i].split("_")[0];
                    $("#categorias").append("<button class='categoria' id='" + categorias[i] + "'>" + nombreCategoria + "</button>");
                }
            }

            $(".categoria").ready(function () {
                var categorias = $(".categoria");
                for (var i = 0; i < categorias.length; i++)
                {
                    animarCategoria(categorias[i]);
                }
            });

        }
    });
});

//AÑADE EL COLOR A LAS DIFERENTES CATEGORIAS EN FUNCION DE LO ALMACENADO EN LA BASE DE DATOS
function animarCategoria(categoria)
{

    var id = categoria.id;

    var colors = id.split("_");
    var backgroundColor = "#" + colors[1];
    var borderColor = "#" + colors[2];

    $("#" + id).css({"background-color": backgroundColor, "border-color": borderColor});

    $("#" + id).hover(function (event) {
        let id = event.target.id;
        let colors = id.split("_");
        let borderColor = "#" + colors[2];

        $("#" + id).css({"background-color": borderColor, "border-color": borderColor, "color": "white"});
    });

    $("#" + id).mouseleave(function (event) {
        let id = event.target.id;
        let colors = id.split("_");
        let backgroundColor = "#" + colors[1];
        let borderColor = "#" + colors[2];

        $("#" + id).css({"background-color": backgroundColor, "border-color": borderColor, "color": "black"});
    });

    $("#" + id).click(function (event) {

        let id = event.target.id.split("_")[0].trim();

        if (id !== undefined) {

            var urlProducto = $("#contexto").val() + "?categoria=" + id;

            window.location = urlProducto;

        }

    });


}